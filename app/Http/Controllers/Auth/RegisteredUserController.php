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
use App\Models\Sumberdana;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Get SKPD list for dropdown
        $skpdList = Sumberdana::select('kd_skpd', 'nm_skpd')
            ->distinct()
            ->whereNotNull('kd_skpd')
            ->orderBy('nm_skpd')
            ->get();

        return view('auth.register', compact('skpdList'));
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'skpd' => ['nullable', 'string', 'max:100'], // Change from 'unit' to 'skpd'
            'nip' => ['nullable', 'string', 'max:50'], // Add NIP if needed
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'skpd' => $request->skpd, // Change from 'unit' to 'skpd'
            'nip' => $request->nip, // Add NIP if you have this column
            'role' => 'user',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
