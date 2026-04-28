<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FranchiseApplication;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FranchiseStatusUpdate;

class FranchiseAdminController extends Controller
{
    private function discoveryPresentationManifestPath(): string
    {
        return 'discovery-presentation/manifest.json';
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

        $url = $disk->url($manifest['path']);

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
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('personal_contact', 'like', "%{$search}%")
              ->orWhere('proposal_location', 'like', "%{$search}%");
        });
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

    $applications = $query->paginate(10)->withQueryString();
    $discoveryPresentation = $this->discoveryPresentation();

    return view('admin.application', compact('applications', 'discoveryPresentation'));
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

        $pdf = Pdf::loadView('admin.applications.pdf', compact('application'))
            ->setPaper('a4', 'portrait')
            ->setOption([
                'dpi' => 72,
                'defaultFont' => 'DejaVu Sans',
            ]);

        return $pdf->download('franchise-application-' . $application->id . '.pdf');
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

    Mail::to($app->email)->send(
        new FranchiseStatusUpdate(
            $app,
            'Application Under Review',
            "Your application has been viewed and is now under review. Please wait for further progress. Please expect a call from the Kape-Ilokano Franchise Team."
        )
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

    Mail::to($app->email)->send(
    new FranchiseStatusUpdate(
        $app,
        'Franchise Discovery Meeting Schedule',
        "Your appointment has been scheduled:

        Date: {$app->appointment_date}
        Time: {$app->appointment_time}
        Type: {$app->meeting_type}
        Link: {$app->meeting_link}

        Please be available on time."
    )
);

return back()->with('success', 'Appointment Scheduled Successfully.');
}

public function startDiscovery(Request $request, $id)
{
    $app = FranchiseApplication::findOrFail($id);

    $app->update([
        'status' => 'Discovery Meeting'
    ]);

    Mail::to($app->email)->send(
    new FranchiseStatusUpdate(
        $app,
        'Discovery Meeting Started',
        "Your application is now in Discovery Meeting stage.\n\nOur team is now processing your business presentation and next steps."
    )
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
        'status' => 'Discovery Session Done',
        'discovery_done_at' => now()
    ]);

    Mail::to($app->email)->send(
    new FranchiseStatusUpdate(
        $app,
        'Discovery Session Completed',
        "Thank you for attending the discovery session.\n\nOur team will contact you soon for the next process."
    )
);

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Discovery Session Completed.',
            'status' => $app->status,
        ]);
    }

    return back()->with('success', 'Discovery Session Completed.');
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

public function closeDeal($id)
{
    $app = FranchiseApplication::findOrFail($id);

    $app->update([
        'status' => 'Closed Deal'
    ]);

    Mail::to($app->email)->send(
    new FranchiseStatusUpdate(
        $app,
        'Congratulations! Franchise Approved',
        "Congratulations!\n\nYour franchise application has been successfully approved.\n\nOur team will contact you for onboarding and next requirements."
    )
);

    return back()->with('success', 'Application marked as Closed Deal.');
}

public function decline($id)
{
    $app = FranchiseApplication::findOrFail($id);

    $app->update([
        'status' => 'Declined'
    ]);

    Mail::to($app->email)->send(
    new FranchiseStatusUpdate(
        $app,
        'Franchise Application Update',
        "Thank you for your interest.\n\nAfter careful review, we regret to inform you that your application will not proceed at this time."
    )
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

    Mail::to($app->email)->send(
        new FranchiseStatusUpdate(
            $app,
            'Appointment Rescheduled',
            "Your meeting has been rescheduled.

Date: {$app->appointment_date}
Time: {$app->appointment_time}
Type: {$app->meeting_type}
Link: {$app->meeting_link}"
        )
    );

    return back()->with('success', 'Appointment Rescheduled Successfully.');
}
}
