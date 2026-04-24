<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CoffeeRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoffeeRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $event = $this->event();
        $sessions = $this->sessions();
        $rates = $this->rates();

        $myReg = CoffeeRegistration::where('user_id', Auth::id())
            ->latest()
            ->first();

        return view('user-dashboard.registration.registration', [
            'event' => $event,
            'sessions' => $sessions,
            'rates' => $rates,
            'myReg' => $myReg,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if (!$user) abort(403, 'Unauthorized');

        $existingPending = CoffeeRegistration::where('user_id', $user->id)
            ->where('status', 'Pending')
            ->exists();

        if ($existingPending) {
            // mas bagay 'error' kaysa 'success'
            return back()->with('error', 'You already have a pending application.');
        }

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:80'],
            'last_name'  => ['required', 'string', 'max:80'],
            'email'      => ['required', 'email', 'max:120'],
            'phone'      => ['nullable', 'string', 'max:40'],

            'session_key' => ['required', 'in:0,1,2'],
            'rate_key'    => ['required', 'in:0,1,2,3'],

            'payment_method' => ['nullable', 'string', 'max:60'],
            'reference_no'   => ['nullable', 'string', 'max:120'],
            'notes'          => ['nullable', 'string', 'max:2000'],
        ]);

        $event = $this->event();
        $sessions = $this->sessions();
        $rates = $this->rates();

        $session = $sessions[(int) $data['session_key']];
        $rate    = $rates[(int) $data['rate_key']];

        CoffeeRegistration::create([
            'user_id' => $user->id,

            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'phone'      => $data['phone'] ?? null,

            'event_name'       => $event['name'],
            'event_date_range' => $event['date_range'],
            'event_venue'      => $event['venue'],

            'session_title'    => $session['title'],
            'session_speaker'  => $session['speaker'],
            'session_datetime' => $session['datetime'],

            'rate_type'   => $rate['type'],
            'rate_amount' => $rate['amount'],

            'payment_method' => $data['payment_method'] ?? null,
            'reference_no'   => $data['reference_no'] ?? null,
            'notes'          => $data['notes'] ?? null,

            'status' => 'Pending',
        ]);

        return back()->with('success', 'Submitted! Waiting for admin approval.');
    }

    private function event(): array
    {
        return [
            'name'       => 'WOFEX Drinks + Bakes — Coffee Track',
            'date_range' => 'Feb. 25–27, 2026',
            'venue'      => 'World Trade Center, Pasay City',
        ];
    }

    private function sessions(): array
    {
        return [
            [
                'title'    => 'How to Design a Café Menu That Maximizes Profitability & Sustainability',
                'speaker'  => 'Ernest Martin',
                'datetime' => 'Feb 27, 2026 · 10:30 AM – 12:30 PM',
            ],
            [
                'title'    => 'Setting Up an Efficient Café Layout: Location, Design & Flow',
                'speaker'  => 'Robert Francisco',
                'datetime' => 'Feb 27, 2026 · 1:00 PM – 3:00 PM',
            ],
            [
                'title'    => 'Café Partnerships: Collaborate with Local Bakers, Roasters, & Influencers',
                'speaker'  => 'Dave Dexter Dource',
                'datetime' => 'Feb 27, 2026 · 3:30 PM – 5:30 PM',
            ],
        ];
    }

    private function rates(): array
    {
        return [
            ['type' => 'Per Topic', 'amount' => 2000.00],
            ['type' => 'Per Track', 'amount' => 5000.00],
            ['type' => 'Bakes & Cakes (2 days)', 'amount' => 8000.00],
            ['type' => 'Drinks, Bakes, & Coffee (3 days)', 'amount' => 10500.00],
        ];
    }
}
