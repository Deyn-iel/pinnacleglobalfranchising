<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FranchiseApplication;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class FranchiseAdminController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.application');
    }

    public function show($id)
    {
        $application = FranchiseApplication::findOrFail($id);

        return view('admin.applications.show', compact('application'));
    }

    public function downloadPdf($id)
    {
        $application = FranchiseApplication::findOrFail($id);

        // Temporary safety net. Real fix is the lightweight PDF view below.
        ini_set('memory_limit', '1024M');

        $pdf = Pdf::loadView('admin.applications.pdf', compact('application'))
            ->setPaper('a4', 'portrait')
            ->setOption([
                'dpi' => 72,
                'defaultFont' => 'DejaVu Sans',
            ]);

        return $pdf->download('franchise-application-' . $application->id . '.pdf');
    }

    public function destroy($id)
    {
        $app = FranchiseApplication::findOrFail($id);

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

        public function modal($id)
{
    $application = \App\Models\FranchiseApplication::findOrFail($id);

    return view('admin.applications.details-modal-content', compact('application'));
}
}