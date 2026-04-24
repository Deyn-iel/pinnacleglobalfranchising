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
        $coupons = Coupon::latest()->get();

        $rewardTypes = [
            ['name' => 'Franchise Discount Voucher - Flat Rate', 'amount' => 0, 'requires_code' => true],
            ['name' => '1 Free Ambaristo Drink', 'amount' => 0, 'requires_code' => true],
            ['name' => '1 Bangus Sardines Ricebowl', 'amount' => 0, 'requires_code' => true],
            ['name' => 'Free Shuttle to Nearest Store', 'amount' => 0, 'requires_code' => false],
            ['name' => 'Free Kit', 'amount' => 0, 'requires_code' => false],
            ['name' => 'Isabela Coffee', 'amount' => 0, 'requires_code' => false],
        ];

        return view('admin.coupon.index', compact('coupons', 'rewardTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'claimable_item' => 'required|string|max:255',
            'coupon_status' => 'required|string|in:Active,Inactive',
            'requires_code' => 'required|boolean',
        ]);

        $validated['booklet_serial_number'] = $this->generateBookletSerialNumber();

        $validated['unique_code'] = $validated['requires_code']
            ? $this->generateUniqueCouponCode()
            : null;

        $validated['selling_status'] = 'For Selling';
        $validated['claim_status'] = 'Unclaimed';

        $validated['buyer_name'] = null;
        $validated['buyer_address'] = null;
        $validated['buyer_email'] = null;
        $validated['buyer_contact'] = null;
        $validated['mode_of_payment'] = null;
        $validated['payment_reference'] = null;

        $validated['sold_at'] = null;
        $validated['claimed_at'] = null;

        Coupon::create($validated);

        return back()->with('success', 'Coupon generated successfully.');
    }

    public function tagSold($id)
    {
        $coupon = Coupon::findOrFail($id);

        if ($coupon->selling_status === 'Sold') {
            return back()->with('success', 'Coupon is already tagged as sold.');
        }

        $coupon->update([
            'selling_status' => 'Sold',
            'sold_at' => now(),
        ]);

        return back()->with('success', 'Coupon tagged as sold.');
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
}