<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\Loan;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Membayar denda
    public function payFine(Loan $loan)
    {
        $fine = Fine::create([
            'loan_id' => $loan->id,
            'amount' => $loan->fine,
            'paid' => true,
        ]);

        // Update status pinjaman menjadi selesai
        $loan->update(['status' => 'paid']);

        return redirect()->route('mahasiswa.loans.index')->with('success', 'Fine paid successfully');
    }
}
