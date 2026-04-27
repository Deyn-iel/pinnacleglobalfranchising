<?php

namespace App\Http\Controllers;

use App\Models\FranchiseReservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterFranchiseeController extends Controller
{
    public function index()
    {
        $reservations = FranchiseReservation::latest()->paginate(10);

        return view('admin.headoffice-portals.od.register', compact('reservations'));
    }

    public function store(Request $request)
    {
        $packageLabels = [
            'kiosk' => 'Kiosk - 150k',
            'inline_cafe' => 'In-Line Café',
            'small' => 'Small - 45sqm to 74sqm - 350k',
            'medium' => 'Medium - 75sqm to 100sqm - 500k',
            'large' => 'Large - 100sqm and up - 750k',
            'sitdown' => 'Sit-Down Café - 150k',
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

        $allowedPackages = array_keys($packageLabels);

        $validated = $request->validate([
            'date' => ['required', 'date'],

            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:1000'],
            'contact' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],

            'package' => ['required', 'array', 'min:1'],
            'package.*' => ['required', 'string', Rule::in($allowedPackages)],

            'package_count' => ['nullable', 'array'],
            'package_count.*' => ['nullable', 'integer', 'min:0'],

            'location' => ['nullable', 'string', 'max:255'],
            'location_tba' => ['nullable'],

            'fee' => ['nullable'],
            'payment_mode' => [
                'required',
                Rule::in([
                    'Cash',
                    'GCash',
                    'Bank Deposit',
                    'Bank Transfer',
                    'Check',
                ]),
            ],
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
        ], [
            'date.required' => 'Required ang reservation date.',
            'name.required' => 'Required ang full name.',
            'address.required' => 'Required ang residential address.',
            'contact.required' => 'Required ang contact number.',
            'package.required' => 'Pumili ng kahit isang franchise package.',
            'payment_mode.required' => 'Required ang mode of payment.',
            'check_no.required_if' => 'Required ang check number kapag Check ang mode of payment.',
            'signature.required' => 'Required ang franchisee signature/name.',
            'signature_date.required' => 'Required ang signature date.',
        ]);

        $selectedPackages = $request->input('package', []);
        $packageCounts = $request->input('package_count', []);

        $cleanCounts = [];
        $packagesForSaving = [];

        foreach ($selectedPackages as $packageKey) {
            $count = isset($packageCounts[$packageKey])
                ? (int) $packageCounts[$packageKey]
                : 0;

            if ($count < 1) {
                return back()
                    ->withErrors([
                        "package_count.$packageKey" => 'Required ang Number of Franchise Availed para sa selected package.',
                    ])
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

        $reservationFeePerFranchise = 25000;
        $computedReservationFee = $computedTotal * $reservationFeePerFranchise;

        FranchiseReservation::create([
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

        return redirect()
            ->route('admin.portals.od.register-franchise')
            ->with('success', 'Franchise reservation saved successfully! Ready for print/PDF.');
    }

    public function print(FranchiseReservation $reservation)
    {
        return view('admin.headoffice-portals.od.franchise-reservation-print', [
            'reservation' => $reservation,
            'pdfMode' => false,
        ]);
    }

    public function pdf(FranchiseReservation $reservation)
    {
        $pdf = Pdf::loadView('admin.headoffice-portals.od.franchise-reservation-print', [
            'reservation' => $reservation,
            'pdfMode' => true,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('ANNEX-A-Franchise-Reservation-' . $reservation->id . '.pdf');
    }
}