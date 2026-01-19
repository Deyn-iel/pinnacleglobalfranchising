<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FranchiseApplication;
use Illuminate\Support\Facades\Storage;

class FranchiseAdminController extends Controller
{
    /**
     * Redirect index → dashboard
     */
    public function index()
    {
        return redirect()->route('admin.application');
    }

    /**
     * Show single application
     */
    public function show($id)
    {
        $application = FranchiseApplication::findOrFail($id);

        return view('admin.applications.show', compact('application'));
    }

    /**
     * Delete application
     */
    public function destroy($id)
    {
        $app = FranchiseApplication::findOrFail($id);

        // delete uploaded files
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
}
