<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Mahasiswa\LoanController;
use App\Http\Controllers\Mahasiswa\ReservationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

Route::get('/books', [BookController::class, 'show'])->name('books.show');



Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
});




// Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Route::get('/}', [HomeController::class])->name('layout.home');

// Route login dan register dengan menggunakan Breeze
// Route::get('/login', [AuthenticatedSessionController::class, 'create'])
//     ->name('login');
// Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Route::get('/register', [RegisteredUserController::class, 'create'])
//     ->name('register');
// Route::post('/register', [RegisteredUserController::class, 'store']);

// Group routes for admin with role check
Route::middleware(['role:Admin'])->group(function () {

    // Admin routes
    // Route::get('/admin/dashboard', [AdminController::class, 'index']);


    // Report routes
    Route::get('admin/reports/late-returns', [ReportController::class, 'lateReturns'])->name('admin.reports.lateReturns');
    Route::get('admin/reports/top-books', [ReportController::class, 'topBooks'])->name('admin.reports.topBooks');

    // Book management
    Route::resource('admin/manage-books', BookController::class)->middleware('permission:manage books');

    // User management
    Route::resource('admin/users', UserController::class);
});

// Group routes for mahasiswa (students) with role check
Route::prefix('mahasiswa')->middleware('role:mahasiswa')->group(function () {

    // Reservation routes for students
    Route::resource('reservations', ReservationController::class);

    // Loan routes for students
    Route::resource('loans', LoanController::class);
    Route::post('loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');
});

// Group routes for admin and pegawai (staff) with role check
Route::prefix('admin')->middleware('role:admin,pegawai')->group(function () {
    // Menampilkan dashboard admin
    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');

    // Book management for admin and pegawai
    // Route::resource('books', BookController::class);
});

// Fine payment route
Route::post('pay-fine/{loan}', [PaymentController::class, 'payFine'])->name('pay.fine');

// Home route
Route::get('/', function () {
    return view('layouts.home');
});
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/admin/home', [HomeController::class, 'indexAdmin'])->middleware(['auth', 'verified'])->name('AdminHome');
Route::get('/pegawai/home', [HomeController::class, 'indexPegawai'])->middleware(['auth', 'verified'])->name('PegawaiHome');
Route::get('/mahasiswa/home', [HomeController::class, 'indexMahasiswa'])->middleware(['auth', 'verified'])->name('AdminHome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');




require __DIR__ . '/auth.php';

