<?php
// app/Http/Controllers/Mahasiswa/DashboardController.php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the dashboard for the mahasiswa with their paid fines.
     */
    public function index()
    {
        // Retrieve paid fines for the currently authenticated user
        $fines = Fine::where('paid', true)
            ->where('user_id', auth()->id()) // Ensures only the authenticated user's fines are retrieved
            ->get();

        // Pass fines data to the view
        return view('mahasiswa.dashboard', compact('fines'));
    }
}
