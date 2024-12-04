<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'in:male,female'], // Validasi gender
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        // Menentukan role_id berdasarkan email
        $role_id = 4; // Default ke 'Guest'
    
        if (strpos($request->email, '@student.unhas.ac.id') !== false) {
            $role_id = 3; 
        }
    
        // Membuat user dengan role_id yang ditentukan
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'role_id' => $role_id,
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect()->route('login');
    }
    
}
