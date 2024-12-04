<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\LoanOverdueNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;



class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::with('user', 'book')->get(); // Menampilkan peminjaman buku
        return view('mahasiswa.loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Logic untuk peminjaman buku
            $book = Book::findOrFail($request->book_id);
            $loan = Loan::create([
                'user_id' => $request->user_id,
                'book_id' => $book->id,
                'loan_date' => now(),
                'due_date' => now()->addDays(14),
            ]);

            return redirect()->route('mahasiswa.loans.index')->with('success', 'Book borrowed successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Book not found');
        } catch (QueryException $e) {
            return back()->with('error', 'Database error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Mengembalikan buku dengan perhitungan denda
    public function returnBook(Loan $loan)
    {
        $dueDate = $loan->due_date;
        $returnDate = now();
        $fine = $this->calculateFine($dueDate, $returnDate);

        // Update status peminjaman dan denda
        $loan->update([
            'status' => 'returned',
            'return_date' => $returnDate,
            'fine' => $fine,
        ]);

        // Kembalikan stok buku
        $loan->book->increment('quantity');

        // Kirim notifikasi jika ada denda
        if ($fine > 0) {
            $loan->user->notify(new LoanOverdueNotification($loan));
        }

        return redirect()->route('mahasiswa.loans.index')->with('success', 'Book returned successfully');
    }

    // Fungsi untuk menghitung denda
    private function calculateFine($dueDate, $returnDate)
    {
        $lateDays = $returnDate->diffInDays($dueDate);

        if ($lateDays > 0) {
            return $lateDays * 500; // Denda 500 per hari
        }

        return 0;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
