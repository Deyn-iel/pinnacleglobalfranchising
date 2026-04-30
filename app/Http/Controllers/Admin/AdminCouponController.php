<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminCouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::whereNotNull('unique_code')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $booklets = Coupon::whereNotNull('booklet_serial_number')
            ->whereNotNull('unique_code')
            ->orderByDesc('booklet_serial_number')
            ->orderBy('id')
            ->get()
            ->groupBy('booklet_serial_number');

        $couponStats = [
            'total' => Coupon::count(),
            'sold' => Coupon::where('selling_status', 'Sold')->count(),
            'claimed' => Coupon::where('claim_status', 'Claimed')->count(),
            'active' => Coupon::where('coupon_status', 'Active')->count(),
        ];

        $rewardTypes = $this->rewardTypes();

        return view('admin.coupon.index', compact('coupons', 'couponStats', 'rewardTypes', 'booklets'));
    }

    public function store(Request $request)
    {
        $codedRewards = collect($this->rewardTypes())
            ->where('requires_code', true)
            ->values();

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:500',
            'claimable_item' => ['required', 'string', Rule::in($codedRewards->pluck('name')->all())],
            'coupon_status' => 'required|string|in:Active,Inactive',
        ]);

        $reward = $codedRewards->firstWhere('name', $validated['claimable_item']);
        $bookletSerialNumber = $this->generateBookletSerialNumber();

        for ($i = 0; $i < $validated['quantity']; $i++) {
            Coupon::create([
                'booklet_serial_number' => $bookletSerialNumber,
                'unique_code' => $this->generateUniqueCouponCode(),
                'claimable_item' => $reward['name'],
                'amount' => $reward['amount'] ?? 0,
                'coupon_status' => $validated['coupon_status'],
                'requires_code' => true,
                'selling_status' => 'For Selling',
                'claim_status' => 'Unclaimed',
                'buyer_name' => null,
                'buyer_address' => null,
                'buyer_email' => null,
                'buyer_contact' => null,
                'mode_of_payment' => null,
                'payment_reference' => null,
                'sold_at' => null,
                'claimed_at' => null,
            ]);
        }

        return back()->with('success', $validated['quantity'] . ' coupon code(s) generated successfully in booklet ' . $bookletSerialNumber . ' for ' . $reward['name'] . '.');
    }

    public function tagSold(Request $request, $id)
    {
        $validated = $request->validate([
            'buyer_name' => 'required|string|max:255',
            'amount' => 'nullable|numeric|min:0|max:99999999.99',
            'buyer_address' => 'required|string|max:1000',
            'buyer_email' => 'required|email|max:255',
            'buyer_contact' => 'required|string|max:255',
            'mode_of_payment' => 'nullable|string|max:255',
            'payment_reference' => 'nullable|string|max:255',
        ]);

        $coupon = Coupon::findOrFail($id);

        if ($coupon->selling_status === 'Sold') {
            return back()->with('success', 'Coupon is already tagged as sold.');
        }

        $validated['amount'] = $validated['amount'] ?? 0;

        $coupon->update($validated + [
            'selling_status' => 'Sold',
            'sold_at' => now(),
        ]);

        return back()->with('success', 'Coupon assigned to buyer and tagged as sold.');
    }

    public function bookletPdf(string $booklet)
    {
        $coupons = Coupon::where('booklet_serial_number', $booklet)
            ->whereNotNull('unique_code')
            ->orderBy('id')
            ->get();

        abort_if($coupons->isEmpty(), 404);

        $pdf = Pdf::loadView('admin.coupon.booklet-pdf', [
            'booklet' => $booklet,
            'coupons' => $coupons,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('coupon-booklet-' . $booklet . '.pdf');
    }

    private function generateBookletSerialNumber(): string
    {
        $latestCoupon = Coupon::whereNotNull('booklet_serial_number')
            ->latest('id')
            ->first();

        if (!$latestCoupon || !$latestCoupon->booklet_serial_number) {
            return 'BK-00001';
        }

        if (preg_match('/BK-(\d+)/', $latestCoupon->booklet_serial_number, $matches)) {
            $nextNumber = ((int) $matches[1]) + 1;
            return 'BK-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        }

        return 'BK-00001';
    }

    private function generateUniqueCouponCode(): string
    {
        do {
            $letters = strtoupper(Str::random(4));
            $numbers = (string) random_int(1000, 9999);

            $raw = str_shuffle($letters . $numbers);
            $code = substr($raw, 0, 8);
        } while (Coupon::where('unique_code', $code)->exists());

        return $code;
    }

    private function rewardTypes(): array
    {
        return [
            ['name' => 'Franchise Discount Voucher - Flat Rate', 'amount' => 0, 'requires_code' => true],
            ['name' => '1 Free Ambaristo Drink', 'amount' => 0, 'requires_code' => true],
            ['name' => '1 Bangus Sardines Ricebowl', 'amount' => 0, 'requires_code' => true],
            ['name' => 'Free Shuttle to Nearest Store', 'amount' => 0, 'requires_code' => false],
            ['name' => 'Free Kit', 'amount' => 0, 'requires_code' => false],
            ['name' => 'Isabela Coffee', 'amount' => 0, 'requires_code' => false],
        ];
    }
}
