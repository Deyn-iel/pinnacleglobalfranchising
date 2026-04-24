<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoffeeRegistration;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Notification;
// use App\Notifications\CoffeeRegistrationConfirmed;
use App\Models\UserNotification; 

class CoffeeRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $q = CoffeeRegistration::query()->latest();

        if ($request->filled('search')) {
            $s = $request->search;
            $q->where(function ($qq) use ($s) {
                $qq->where('first_name', 'like', "%{$s}%")
                   ->orWhere('last_name', 'like', "%{$s}%")
                   ->orWhere('email', 'like', "%{$s}%")
                   ->orWhere('session_title', 'like', "%{$s}%");
            });
        }

        if ($request->filled('status')) {
            $q->where('status', $request->status);
        }
$regs = $q->paginate(10)->withQueryString();

$selected = null;

if ($request->filled('selected')) {
    $selected = CoffeeRegistration::find($request->selected);
}

if (!$selected) {
    $selected = $regs->first(); 
}

return view('admin.headoffice-portals.hr.registration', compact('regs', 'selected'));

    }

    public function update(Request $request, CoffeeRegistration $reg)
    {
        $data = $request->validate([
            'status' => ['required', 'in:Pending,Approved,Rejected'],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $reg->update($data);

        return redirect()
            ->route('admin.coffee-registrations.index', ['selected' => $reg->id])
            ->with('success', 'Updated successfully.');
    }
    
public function destroy(CoffeeRegistration $registration)
{
    $registration->delete();

    return redirect()
        ->route('admin.coffee-registrations.index')
        ->with('success', 'Registration deleted successfully.');
}

public function uploadDocuments(Request $request, CoffeeRegistration $reg)
{
    $request->validate([
        'request_approval'    => ['nullable','file','mimes:pdf,jpg,jpeg,png','max:5120'],
        'travel_order'        => ['nullable','file','mimes:pdf,jpg,jpeg,png','max:5120'],
        'registration_ticket' => ['nullable','file','mimes:pdf,jpg,jpeg,png','max:5120'],
    ], [
        'request_approval.uploaded'    => 'Request for Approval failed to upload (check file size / PHP upload settings).',
        'travel_order.uploaded'        => 'Travel Order failed to upload (check file size / PHP upload settings).',
        'registration_ticket.uploaded' => 'Registration Ticket failed to upload (check file size / PHP upload settings).',
    ]);

    if (
        !$request->hasFile('request_approval') &&
        !$request->hasFile('travel_order') &&
        !$request->hasFile('registration_ticket')
    ) {
        return back()->withErrors([
            'docs' => 'Walang na-receive na file. Pili ka muna ng file bago i-click ang Upload.'
        ]);
    }

    $folder = "coffee-registrations/{$reg->id}";
    $uploadedNow = []; 

    if ($request->hasFile('request_approval')) {
        if ($reg->request_approval_path) Storage::disk('public')->delete($reg->request_approval_path);
        $reg->request_approval_path = $request->file('request_approval')->store($folder, 'public');
        $uploadedNow[] = 'request_approval_path';
    }

    if ($request->hasFile('travel_order')) {
        if ($reg->travel_order_path) Storage::disk('public')->delete($reg->travel_order_path);
        $reg->travel_order_path = $request->file('travel_order')->store($folder, 'public');
        $uploadedNow[] = 'travel_order_path';
    }

    if ($request->hasFile('registration_ticket')) {
        if ($reg->registration_ticket_path) Storage::disk('public')->delete($reg->registration_ticket_path);
        $reg->registration_ticket_path = $request->file('registration_ticket')->store($folder, 'public');
        $uploadedNow[] = 'registration_ticket_path';
    }

    $reg->save();

    $complete = $reg->request_approval_path && $reg->travel_order_path && $reg->registration_ticket_path;

    if ($complete && !$reg->completed_at) {
        $reg->completed_at = now();
        $reg->save();
    }

    $notifMap = [
        'request_approval_path' => [
            'url_key'  => 'request_approval_url',
            'title'    => 'HR Docs Updated',
            'message'  => 'Request Approval document was uploaded/updated.',
            'type'     => 'info',
        ],
        'travel_order_path' => [
            'url_key'  => 'travel_order_url',
            'title'    => 'HR Docs Updated',
            'message'  => 'Travel Order document was uploaded/updated.',
            'type'     => 'info',
        ],
        'registration_ticket_path' => [
            'url_key'  => 'registration_ticket_url',
            'title'    => 'HR Docs Updated',
            'message'  => 'Registration Ticket was uploaded/updated.',
            'type'     => 'info',
        ],
    ];

    foreach ($uploadedNow as $pathKey) {
        $cfg = $notifMap[$pathKey];

        UserNotification::create([
            'user_id' => $reg->user_id,
            'type' => $cfg['type'],
            'title' => $cfg['title'],
            'message' => $cfg['message'],
            'coffee_registration_id' => $reg->id,
            'meta' => [
                $cfg['url_key'] => Storage::url($reg->{$pathKey}),
            ],
            'read_at' => null,
        ]);
    }

    return redirect()
        ->route('admin.coffee-registrations.index', ['selected' => $reg->id])
        ->with('success', 'Documents uploaded/updated successfully.');
}



}
