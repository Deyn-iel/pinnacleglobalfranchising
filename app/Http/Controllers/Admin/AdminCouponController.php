<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::whereNotNull('unique_code')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $couponStats = [
            'total' => Coupon::count(),
            'sold' => Coupon::where('selling_status', 'Sold')->count(),
            'claimed' => Coupon::where('claim_status', 'Claimed')->count(),
            'active' => Coupon::where('coupon_status', 'Active')->count(),
        ];

        $rewardTypes = $this->rewardTypes();

        return view('admin.coupon.index', compact('coupons', 'couponStats', 'rewardTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:500',
            'coupon_status' => 'required|string|in:Active,Inactive',
        ]);

        $codedRewards = collect($this->rewardTypes())
            ->where('requires_code', true)
            ->values();

        for ($i = 0; $i < $validated['quantity']; $i++) {
            $reward = $codedRewards->random();

            Coupon::create([
                'booklet_serial_number' => $this->generateBookletSerialNumber(),
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

        return back()->with('success', $validated['quantity'] . ' coupon code(s) generated successfully with random rewards.');
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
