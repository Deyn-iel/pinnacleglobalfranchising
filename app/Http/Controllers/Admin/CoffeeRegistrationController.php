<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoffeeRegistration;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CoffeeRegistrationConfirmed;

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

        $selected = $request->filled('selected')
            ? CoffeeRegistration::find($request->selected)
            : $regs->first();

        // ✅ MATCH sa filename mo:
        // resources/views/admin/user-registration/registration.blade.php
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
  ]);

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

  // ✅ check completion
  $complete = $reg->request_approval_path
            && $reg->travel_order_path
            && $reg->registration_ticket_path;

  // ✅ kapag complete na ngayon pa lang, set completed + email once
  if ($complete && !$reg->completed_at) {
    $reg->status = 'Confirmed';      // if may Confirmed ka
    $reg->completed_at = now();
    $reg->save();

    Notification::route('mail', $reg->email)
      ->notify(new CoffeeRegistrationConfirmed($reg));
  }

  return back()->with('success', 'Documents updated.');
}

}
