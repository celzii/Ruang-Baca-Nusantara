<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Menampilkan daftar pemesanan
    public function index()
    {
        $reservations = Reservation::with('user', 'book')->get();
        return view('mahasiswa.reservations.index', compact('reservations'));
    }

    // Membuat pemesanan buku
    public function create(Book $book)
    {
        return view('mahasiswa.reservations.create', compact('book'));
    }

    // Menyimpan pemesanan buku
    public function store(Request $request, Book $book)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        if ($book->quantity > 0) {
            return redirect()->back()->with('error', 'Book is available, no need for reservation');
        }

        // Menyimpan pemesanan
        Reservation::create([
            'user_id' => $validated['user_id'],
            'book_id' => $book->id,
            'reservation_date' => now(),
            'expiry_date' => now()->addDays(7), // Set expiry date
            'status' => 'pending',
        ]);

        return redirect()->route('mahasiswa.reservations.index')->with('success', 'Book reserved successfully');
    }

    // Membatalkan pemesanan
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('mahasiswa.reservations.index')->with('success', 'Reservation canceled successfully');
    }
}
