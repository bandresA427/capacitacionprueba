<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
            'cedula' => ['required','integer'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'question_1' => ['required','string','max:255'],
            'answer_1' => ['required','string','max:255'],
            'question_2' => ['required','string','max:255'],
            'answer_2' => ['required','string','max:255'],
        ]);

        $user = User::create([
            'cedula'=> $request->cedula,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'question_1' => $request->question_1,
            'answer_1' => $request->answer_1,
            'question_2' => $request->question_2,
            'answer_2' => $request->answer_2,
       
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
