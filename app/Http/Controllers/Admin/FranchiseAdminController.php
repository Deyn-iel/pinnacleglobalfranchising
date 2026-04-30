<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\FranchiseApplication;
use App\Models\FranchiseReservation;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\FranchiseStatusUpdate;
use Illuminate\Validation\Rule;

class FranchiseAdminController extends Controller
{
    private function discoveryPresentationManifestPath(): string
    {
        return 'discovery-presentation/manifest.json';
    }

    private function redirectToWorkflow(FranchiseApplication $app, string $message)
    {
        return redirect()
            ->route('admin.application', ['open_workflow' => $app->id])
            ->with('success', $message);
    }

    private function sendStatusEmail(FranchiseApplication $app, string $subject, string $message): void
    {
        try {
            Mail::to($app->email)->send(new FranchiseStatusUpdate($app, $subject, $message));
        } catch (\Throwable $exception) {
            Log::warning('Franchise status email failed.', [
                'application_id' => $app->id,
                'email' => $app->email,
                'subject' => $subject,
                'error' => $exception->getMessage(),
            ]);
        }
    }

    private function discoveryPresentation(): ?array
    {
        $disk = Storage::disk('public');
        $manifestPath = $this->discoveryPresentationManifestPath();

        if (!$disk->exists($manifestPath)) {
            return null;
        }

        $manifest = json_decode($disk->get($manifestPath), true);

        if (!is_array($manifest) || !isset($manifest['path']) || !$disk->exists($manifest['path'])) {
            return null;
        }

        $url = asset('storage/' . $manifest['path']);

        return [
            'name' => $manifest['name'] ?? basename($manifest['path']),
            'path' => $manifest['path'],
            'url' => $url,
            'viewer_url' => 'https://view.officeapps.live.com/op/embed.aspx?src=' . urlencode(url($url)),
            'updated_at' => $manifest['updated_at'] ?? null,
        ];
    }

    public function index(Request $request)
{
    $query = FranchiseApplication::query();

    // SEARCH
    if ($request->search) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('personal_full_name', 'like', "%{$search}%")
              ->orWhere('brand', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('personal_contact', 'like', "%{$search}%")
              ->orWhere('proposal_location', 'like', "%{$search}%");
        });
    }

    if ($request->brand && $request->brand != 'All') {
        $query->where('brand', $request->brand);
    }

    // STATUS FILTER
    if ($request->status && $request->status != 'All') {
        $query->where('status', $request->status);
    }

    // SORT
    if ($request->sort == 'oldest') {
        $query->oldest();
    } else {
        $query->latest();
    }

    $applications = $query->with(['coupon', 'franchiseReservation'])->paginate(10)->withQueryString();
    $discoveryPresentation = $this->discoveryPresentation();
    $availableCoupons = Coupon::where('selling_status', '!=', 'Sold')
        ->where('coupon_status', 'Active')
        ->whereNotNull('unique_code')
        ->orderBy('id')
        ->get();
    $applicationReservations = FranchiseApplication::with('franchiseReservation')
        ->whereNotNull('franchise_reservation_id')
        ->latest('updated_at')
        ->take(15)
        ->get();

    return view('admin.application', compact('applications', 'discoveryPresentation', 'availableCoupons', 'applicationReservations'));
}

    public function show($id)
    {
        $application = FranchiseApplication::findOrFail($id);

        return view('admin.applications.show', compact('application'));
    }

    public function downloadPdf($id)
    {
        $application = FranchiseApplication::findOrFail($id);

        // Temporary safety net. Real fix is the lightweight PDF view below.
        ini_set('memory_limit', '1024M');

        $pdf = Pdf::loadView('admin.applications.pdf', [
            'application' => $application,
            'pdfMode' => true,
        ])
            ->setPaper('a4', 'portrait')
            ->setOption([
                'dpi' => 72,
                'defaultFont' => 'DejaVu Sans',
            ]);

        return $pdf->download('franchise-application-' . $application->id . '.pdf');
    }

    public function print($id)
    {
        $application = FranchiseApplication::findOrFail($id);

        return view('admin.applications.pdf', [
            'application' => $application,
            'pdfMode' => false,
        ]);
    }

    public function destroy($id)
    {
        $app = FranchiseApplication::findOrFail($id);

        if ($app->personal_photo) {
            Storage::disk('public')->delete($app->personal_photo);
        }

        if ($app->government_id) {
            Storage::disk('public')->delete($app->government_id);
        }

        $app->delete();

        return redirect()->route('admin.application')
            ->with('success', 'Application deleted successfully!');
    }

        public function modal($id)
{
    $application = \App\Models\FranchiseApplication::findOrFail($id);

    return view('admin.applications.details-modal-content', compact('application'));
}


public function accept($id)
{
    $app = FranchiseApplication::findOrFail($id);

    $app->update([
        'status' => 'Review in Progress'
    ]);

    $this->sendStatusEmail(
        $app,
        'Application Under Review',
        "Your application has been viewed and is now under review. Please wait for further progress. Please expect a call from the Franchise Team."
    );

    return back()->with('success', 'Application moved to Review in Progress.');
}



public function schedule(Request $request, $id)
{
    $request->validate([
        'appointment_date' => 'required|date',
        'appointment_time' => 'required',
        'meeting_type' => 'required|string',
        'meeting_link' => 'nullable|url',
    ]);

    $app = FranchiseApplication::findOrFail($id);

    $app->update([
        'status' => 'Appointment Scheduled',
        'appointment_date' => $request->appointment_date,
        'appointment_time' => $request->appointment_time,
        'meeting_type' => $request->meeting_type,
        'meeting_link' => $request->meeting_link,
    ]);

    $this->sendStatusEmail(
        $app,
        'Franchise Discovery Meeting Schedule',
        "Your appointment has been scheduled:

        Date: {$app->appointment_date}
        Time: {$app->appointment_time}
        Type: {$app->meeting_type}
        Link: {$app->meeting_link}

        Please be available on time."
    );

return back()->with('success', 'Appointment Scheduled Successfully.');
}

public function startDiscovery(Request $request, $id)
{
    $app = FranchiseApplication::findOrFail($id);

    $app->update([
        'status' => 'Discovery Meeting'
    ]);

    $this->sendStatusEmail(
        $app,
        'Discovery Meeting Started',
        "Your application is now in Discovery Meeting stage.\n\nOur team is now processing your business presentation and next steps."
    );

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Discovery Meeting Started.',
            'status' => $app->status,
        ]);
    }

    return back()->with('success', 'Discovery Meeting Started.');
}

public function doneDiscovery(Request $request, $id)
{
    $app = FranchiseApplication::findOrFail($id);

    $app->update([
        'status' => 'Discovery Session Completed',
        'discovery_done_at' => now()
    ]);

    $this->sendStatusEmail(
        $app,
        'Discovery Session Completed',
        "Thank you for attending the discovery session.\n\nOur team will contact you soon for the next process."
    );

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Discovery Session Completed.',
            'status' => $app->status,
        ]);
    }

    return $this->redirectToWorkflow($app, 'Discovery Session Completed. Continue to the next step.');
}

public function uploadDiscoverySlides(Request $request)
{
    $request->validate([
        'presentation' => 'required|file|mimes:ppt,pptx|max:51200',
    ], [
        'presentation.required' => 'Please choose a PowerPoint file.',
        'presentation.mimes' => 'The discovery presentation must be a PPT or PPTX file.',
    ]);

    $disk = Storage::disk('public');

    $currentPresentation = $this->discoveryPresentation();
    if ($currentPresentation) {
        $disk->delete($currentPresentation['path']);
    }

    $file = $request->file('presentation');
    $path = $file->store('discovery-presentation', 'public');

    $disk->put($this->discoveryPresentationManifestPath(), json_encode([
        'name' => $file->getClientOriginalName(),
        'path' => $path,
        'updated_at' => now()->toIso8601String(),
    ], JSON_PRETTY_PRINT));

    return back()->with('success', 'Discovery presentation uploaded successfully.');
}

public function discoverySlidesJson()
{
    return response()->json([
        'presentation' => $this->discoveryPresentation(),
    ]);
}

public function chooseVoucherOption(Request $request, $id)
{
    $app = FranchiseApplication::findOrFail($id);

    $validated = $request->validate([
        'voucher_option' => ['required', Rule::in(['yes', 'no'])],
    ]);

    $wantsCoupon = $validated['voucher_option'] === 'yes';

    $app->update([
        'voucher_option' => $validated['voucher_option'],
        'status' => $wantsCoupon ? 'Voucher/Coupon Option' : 'Franchise Reservation Registration',
    ]);

    return $this->redirectToWorkflow($app, $wantsCoupon
        ? 'Applicant moved to coupon selection and registration.'
        : 'Applicant moved to franchise reservation registration.');
}

public function registerCoupon(Request $request, $id)
{
    $app = FranchiseApplication::findOrFail($id);

    $validated = $request->validate([
        'coupon_id' => ['required', 'exists:coupons,id'],
        'buyer_name' => ['required', 'string', 'max:255'],
        'buyer_email' => ['required', 'email', 'max:255'],
        'buyer_contact' => ['required', 'string', 'max:255'],
        'buyer_address' => ['required', 'string', 'max:1000'],
        'amount' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
        'mode_of_payment' => ['nullable', 'string', 'max:255'],
    ]);

    $coupon = Coupon::whereKey($validated['coupon_id'])
        ->where('selling_status', '!=', 'Sold')
        ->firstOrFail();

    $coupon->update([
        'buyer_name' => $validated['buyer_name'],
        'buyer_email' => $validated['buyer_email'],
        'buyer_contact' => $validated['buyer_contact'],
        'buyer_address' => $validated['buyer_address'],
        'amount' => $validated['amount'] ?? 0,
        'mode_of_payment' => $validated['mode_of_payment'] ?? null,
        'payment_reference' => null,
        'selling_status' => 'Sold',
        'sold_at' => now(),
    ]);

    $app->update([
        'voucher_option' => 'yes',
        'coupon_id' => $coupon->id,
        'status' => 'Franchise Reservation Registration',
    ]);

    return $this->redirectToWorkflow($app, 'Coupon registered. Applicant can proceed to franchise reservation registration.');
}

public function registerFranchisee(Request $request, $id)
{
    $app = FranchiseApplication::findOrFail($id);

    $request->validate([
        'franchisee_name' => ['required', 'string', 'max:255'],
        'franchisee_email' => ['nullable', 'email', 'max:255'],
        'franchisee_contact' => ['required', 'string', 'max:255'],
        'franchisee_address' => ['required', 'string', 'max:1000'],
    ]);

    $app->update([
        'personal_full_name' => $request->franchisee_name,
        'email' => $request->franchisee_email ?: $app->email,
        'personal_contact' => $request->franchisee_contact,
        'personal_address' => $request->franchisee_address,
        'franchisee_registered_at' => now(),
        'status' => 'Franchisee Registered',
    ]);

    return $this->redirectToWorkflow($app, 'Franchisee details registered. Generate and print the acknowledgement agreement next.');
}

public function printAcknowledgement($id)
{
    $app = FranchiseApplication::with('coupon')->findOrFail($id);

    $app->update([
        'agreement_printed_at' => now(),
        'status' => 'Printed',
    ]);

    return view('admin.applications.client-acknowledgement', [
        'application' => $app,
    ]);
}

public function proceedToPayment($id)
{
    $app = FranchiseApplication::findOrFail($id);

    $app->update([
        'status' => 'Pending Payment',
    ]);

    return $this->redirectToWorkflow($app, 'Application moved to Pending Payment.');
}

public function recordPayment(Request $request, $id)
{
    $app = FranchiseApplication::findOrFail($id);

    $validated = $request->validate([
        'payment_reference_no' => ['required', 'string', 'max:255'],
        'sales_invoice_no' => ['required', 'string', 'max:255'],
    ]);

    $app->update([
        'payment_reference_no' => $validated['payment_reference_no'],
        'sales_invoice_no' => $validated['sales_invoice_no'],
        'payment_confirmed_at' => now(),
        'status' => 'Paid (Confirmed)',
    ]);

    return $this->redirectToWorkflow($app, 'Payment confirmed. You may now proceed with franchise reservation registration.');
}

public function storeReservation(Request $request, $id)
{
    $app = FranchiseApplication::findOrFail($id);

    $packageLabels = [
        'kiosk' => 'Kiosk - 150k',
        'inline_cafe' => 'In-Line Cafe',
        'small' => 'Small - 45sqm to 74sqm - 350k',
        'medium' => 'Medium - 75sqm to 100sqm - 500k',
        'large' => 'Large - 100sqm and up - 750k',
        'sitdown' => 'Sit-Down Cafe - 150k',
        'foodtruck' => 'Food Truck - 150k',
        'flexible' => 'Flexible Package - Coupon / Flat Rate 350k',
    ];

    $packagePrices = [
        'kiosk' => 150000,
        'inline_cafe' => null,
        'small' => 350000,
        'medium' => 500000,
        'large' => 750000,
        'sitdown' => 150000,
        'foodtruck' => 150000,
        'flexible' => 350000,
    ];

    $validated = $request->validate([
        'date' => ['required', 'date'],
        'name' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string', 'max:1000'],
        'contact' => ['required', 'string', 'max:50'],
        'email' => ['nullable', 'email', 'max:255'],
        'package' => ['required', 'array', 'min:1'],
        'package.*' => ['required', 'string', Rule::in(array_keys($packageLabels))],
        'package_count' => ['nullable', 'array'],
        'package_count.*' => ['nullable', 'integer', 'min:0'],
        'location' => ['nullable', 'string', 'max:255'],
        'location_tba' => ['nullable'],
        'payment_mode' => ['required', Rule::in(['Cash', 'GCash', 'Bank Deposit', 'Bank Transfer', 'Check'])],
        'check_no' => ['nullable', 'required_if:payment_mode,Check', 'string', 'max:100'],
        'signature' => ['required', 'string', 'max:255'],
        'signature_date' => ['required', 'date'],
        'official_receipt_no' => ['nullable', 'string', 'max:100'],
        'receipt_issued_by' => ['nullable', 'string', 'max:255'],
        'receipt_issued_date' => ['nullable', 'date'],
        'reviewed_by' => ['nullable', 'string', 'max:255'],
        'reviewed_date' => ['nullable', 'date'],
        'endorsed_by' => ['nullable', 'string', 'max:255'],
        'endorsed_date' => ['nullable', 'date'],
    ]);

    $cleanCounts = [];
    $packagesForSaving = [];

    foreach ($validated['package'] as $packageKey) {
        $count = (int) ($request->input("package_count.$packageKey") ?? 0);

        if ($count < 1) {
            return back()
                ->withErrors(["package_count.$packageKey" => 'Number of franchise availed is required for each selected package.'])
                ->withInput();
        }

        $cleanCounts[$packageKey] = $count;
        $packagesForSaving[] = [
            'key' => $packageKey,
            'label' => $packageLabels[$packageKey],
            'price' => $packagePrices[$packageKey],
            'count' => $count,
        ];
    }

    $computedTotal = array_sum($cleanCounts);
    $computedReservationFee = $computedTotal * 25000;

    $reservation = FranchiseReservation::create([
        'reservation_date' => $validated['date'],
        'name' => $validated['name'],
        'address' => $validated['address'],
        'contact' => $validated['contact'],
        'email' => $validated['email'] ?? null,
        'packages' => $packagesForSaving,
        'package_counts' => $cleanCounts,
        'location' => $validated['location'] ?? null,
        'location_tba' => $request->boolean('location_tba'),
        'total' => $computedTotal,
        'fee' => $computedReservationFee,
        'payment_mode' => $validated['payment_mode'],
        'check_no' => $validated['check_no'] ?? null,
        'payee' => 'Pinnacle Global Franchising Group Inc.',
        'bank' => 'RCBC 7591-149-263',
        'signature' => $validated['signature'],
        'signature_date' => $validated['signature_date'],
        'official_receipt_no' => $validated['official_receipt_no'] ?? null,
        'receipt_issued_by' => $validated['receipt_issued_by'] ?? null,
        'receipt_issued_date' => $validated['receipt_issued_date'] ?? null,
        'reviewed_by' => $validated['reviewed_by'] ?? null,
        'reviewed_date' => $validated['reviewed_date'] ?? null,
        'endorsed_by' => $validated['endorsed_by'] ?? null,
        'endorsed_date' => $validated['endorsed_date'] ?? null,
        'created_by' => Auth::id(),
    ]);

    $app->update([
        'franchise_reservation_id' => $reservation->id,
        'status' => 'Franchise Reservation Registered',
    ]);

    return $this->redirectToWorkflow($app, 'Franchise reservation registered from admin application.');
}

public function decline($id)
{
    $app = FranchiseApplication::findOrFail($id);

    $app->update([
        'status' => 'Declined'
    ]);

    $this->sendStatusEmail(
        $app,
        'Franchise Application Update',
        "Thank you for your interest.\n\nAfter careful review, we regret to inform you that your application will not proceed at this time."
    );

    return back()->with('success', 'Application Declined.');
}

public function reschedule(Request $request, $id)
{
    $request->validate([
        'appointment_date' => 'required|date',
        'appointment_time' => 'required'
    ]);

    $app = FranchiseApplication::findOrFail($id);

    $app->update([
        'appointment_date' => $request->appointment_date,
        'appointment_time' => $request->appointment_time,
        'meeting_type' => $request->meeting_type,
        'meeting_link' => $request->meeting_link,
        'status' => 'Appointment Scheduled'
    ]);

    $this->sendStatusEmail(
        $app,
        'Appointment Rescheduled',
        "Your meeting has been rescheduled.

Date: {$app->appointment_date}
Time: {$app->appointment_time}
Type: {$app->meeting_type}
Link: {$app->meeting_link}"
    );

    return back()->with('success', 'Appointment Rescheduled Successfully.');
}
}
