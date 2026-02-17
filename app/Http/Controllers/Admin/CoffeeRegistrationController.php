<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoffeeRegistration;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CoffeeRegistrationConfirmed;
use App\Models\UserNotification; // ✅ add this if mag-notify ka (optional)

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

// ✅ FIX: fallback kapag invalid yung ?selected=...
$selected = null;

if ($request->filled('selected')) {
    $selected = CoffeeRegistration::find($request->selected);
}

// kung null pa rin (invalid selected OR walang selected param), fallback sa first item sa page
if (!$selected) {
    $selected = $regs->first(); // could still be null kung 0 records talaga
}

return view('admin.user-registration.registration', compact('regs', 'selected'));

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
        // ✅ kapag na-block ng PHP upload limits, lumalabas madalas ito:
        'request_approval.uploaded'    => 'Request for Approval failed to upload (check file size / PHP upload settings).',
        'travel_order.uploaded'        => 'Travel Order failed to upload (check file size / PHP upload settings).',
        'registration_ticket.uploaded' => 'Registration Ticket failed to upload (check file size / PHP upload settings).',
    ]);

    // ✅ IMPORTANT: kung walang kahit isang file na dumating sa server
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

    if ($request->hasFile('request_approval')) {
        if ($reg->request_approval_path) Storage::disk('public')->delete($reg->request_approval_path);
        $reg->request_approval_path = $request->file('request_approval')->store($folder, 'public');
    }

    if ($request->hasFile('travel_order')) {
        if ($reg->travel_order_path) Storage::disk('public')->delete($reg->travel_order_path);
        $reg->travel_order_path = $request->file('travel_order')->store($folder, 'public');
    }

    if ($request->hasFile('registration_ticket')) {
        if ($reg->registration_ticket_path) Storage::disk('public')->delete($reg->registration_ticket_path);
        $reg->registration_ticket_path = $request->file('registration_ticket')->store($folder, 'public');
    }

    $reg->save();

    // ✅ completion logic
    $complete = $reg->request_approval_path && $reg->travel_order_path && $reg->registration_ticket_path;

    if ($complete && !$reg->completed_at) {
        $reg->completed_at = now();
        $reg->save();
    }

// ✅ create meta URLs para match sa blade keys
$meta = [
    'request_approval_url' => $reg->request_approval_path
        ? Storage::url($reg->request_approval_path)
        : null,

    'travel_order_url' => $reg->travel_order_path
        ? Storage::url($reg->travel_order_path)
        : null,

    'registration_ticket_url' => $reg->registration_ticket_path
        ? Storage::url($reg->registration_ticket_path)
        : null,
];

// tanggalin null values
$meta = array_filter($meta);

// ✅ create notification for the applicant user
UserNotification::create([
    'user_id' => $reg->user_id,                      // IMPORTANT: applicant user
    'type' => $complete ? 'success' : 'info',
    'title' => $complete ? 'HR Docs Complete' : 'HR Docs Updated',
    'message' => $complete
        ? 'All HR documents are uploaded. Please wait for confirmation / final instructions.'
        : 'Some HR documents were uploaded/updated. Please check the attachments.',
    'coffee_registration_id' => $reg->id,
    'meta' => $meta,
    'read_at' => null,                               // para unread siya sa user
]);


    // ✅ better redirect: balik ka sa admin panel mo mismo
    return redirect()
        ->route('admin.coffee-registrations.index', ['selected' => $reg->id])
        ->with('success', 'Documents uploaded/updated successfully.');
}


}
