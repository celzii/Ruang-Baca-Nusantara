<?php
// app/Http/Controllers/ReportController.php
namespace App\Http\Controllers;

use App\Models\Loan;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\User;  // Menambahkan model User

class ReportController extends Controller
{
    // Menampilkan laporan grafik
    public function index()
    {
        $chart = new Chart;

        // Ambil data jumlah buku yang dipinjam per bulan
        $loansPerMonth = Loan::selectRaw('MONTH(loan_date) as month, count(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Menambahkan data ke grafik
        $chart->labels($loansPerMonth->pluck('month')->toArray());
        $chart->dataset('Loans', 'line', $loansPerMonth->pluck('total')->toArray());

        return view('reports.index', compact('chart'));
    }

    public function topBooks()
    {
        $topBooks = Loan::select('book_id', \DB::raw('count(*) as total'))
            ->groupBy('book_id')
            ->orderByDesc('total')
            ->take(10) // Ambil 10 buku paling populer
            ->get();

        $books = Book::find($topBooks->pluck('book_id')->toArray()); // Ambil data buku berdasarkan ID

        return view('admin.reports.top_books', compact('books', 'topBooks'));
    }

    public function lateReturns()
    {
        $lateReturns = Loan::where('status', 'overdue')
            ->select('user_id', \DB::raw('count(*) as late_count'))
            ->groupBy('user_id')
            ->orderByDesc('late_count')
            ->take(10) // Ambil 10 pengguna dengan keterlambatan terbanyak
            ->get();

        $users = User::find($lateReturns->pluck('user_id')->toArray()); // Ambil data pengguna berdasarkan ID

        return view('admin.reports.late_returns', compact('lateReturns', 'users'));
    }
}
