<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CouponClaimedMail;

class CouponClaimController extends Controller
{
    public function index()
    {
        $claimedCoupons = Coupon::where('claim_status', 'Claimed')
            ->latest('claimed_at')
            ->take(20)
            ->get();

        return view('ticket.coupon', [
            'coupon' => null,
            'claimedCoupons' => $claimedCoupons,
            'verifyError' => null,
        ])->with('pageTitle', "Coupon's");
    }

    public function verify(Request $request)
{
    $request->validate([
        'unique_code' => 'required|string|size:8',
    ]);

    $code = strtoupper(trim($request->unique_code));

    $claimedCoupons = Coupon::where('claim_status', 'Claimed')
        ->latest('claimed_at')
        ->take(20)
        ->get();

    $coupon = Coupon::where('unique_code', $code)->first();

    if (!$coupon) {
        return back()
            ->withErrors([
                'unique_code' => 'Coupon code not found.',
            ])
            ->withInput();
    }

    if ($coupon->claim_status === 'Claimed') {
        return view('ticket.coupon', [
            'coupon' => $coupon,
            'claimedCoupons' => $claimedCoupons,
            'verifyError' => 'This coupon has already been claimed.',
            'pageTitle' => 'Verify Coupons',
        ]);
    }

    if ($coupon->coupon_status !== 'Active') {
        return view('ticket.coupon', [
            'coupon' => $coupon,
            'claimedCoupons' => $claimedCoupons,
            'verifyError' => 'This coupon is inactive.',
            'pageTitle' => 'Verify Coupons',
        ]);
    }

    if ($coupon->selling_status !== 'Sold') {
        return view('ticket.coupon', [
            'coupon' => $coupon,
            'claimedCoupons' => $claimedCoupons,
            'verifyError' => 'This coupon is not yet tagged as sold.',
            'pageTitle' => 'Verify Coupons',
        ]);
    }

    return view('ticket.coupon', [
        'coupon' => $coupon,
        'claimedCoupons' => $claimedCoupons,
        'verifyError' => null,
        'pageTitle' => 'Verify Coupons',
    ])->with('success', 'Coupon verified successfully.');
}

    public function claim(Request $request)
    {
        $request->validate([
            'coupon_id' => 'required|exists:coupons,id',
        ]);

        $coupon = Coupon::findOrFail($request->coupon_id);

        if (!$coupon->unique_code) {
            return back()->withErrors([
                'unique_code' => 'This reward does not require a coupon code.',
            ]);
        }

        if ($coupon->claim_status === 'Claimed') {
            return back()->withErrors([
                'unique_code' => 'This coupon has already been claimed and cannot be used again.',
            ]);
        }

        if ($coupon->coupon_status !== 'Active') {
            return back()->withErrors([
                'unique_code' => 'This coupon is inactive.',
            ]);
        }

        if ($coupon->selling_status !== 'Sold') {
            return back()->withErrors([
                'unique_code' => 'This coupon is not yet tagged as sold.',
            ]);
        }

        if (!$coupon->buyer_name || !$coupon->buyer_email || !$coupon->buyer_contact || !$coupon->buyer_address) {
            return back()->withErrors([
                'unique_code' => 'This coupon has no registered buyer details yet.',
            ]);
        }

        $coupon->update([
            'claim_status' => 'Claimed',
            'claimed_at' => now(),
        ]);

        Mail::to($coupon->buyer_email)->send(
            new CouponClaimedMail($coupon->fresh(), $coupon->buyer_name)
        );

        return redirect()
            ->route('tickets.coupon')
            ->with('success', 'Coupon claimed successfully.');
    }
}
