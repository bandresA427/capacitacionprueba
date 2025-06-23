<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Password;

class PasswordController extends Controller
{
    public function reset(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
    ]);

    $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->save();
    });

    if ($status === Password::PASSWORD_RESET) {
        return response()->json(['message' => 'Tu contraseña ha sido restablecida correctamente.']);
    } else {
        return response()->json(['error' => $status], 400);
    }
}
public function email(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $status = Password::sendResetLink(
        $request->only('email'),
        function ($user, $token) {
            // Enviar el correo electrónico de restablecimiento de contraseña
            Mail::to($user)->send(new PasswordResetEmail($user, $token));
        }
    );

    if ($status === Password::RESET_LINK_SENT) {
        return back()->with('status', '¡Se ha enviado un correo electrónico con un enlace para restablecer tu contraseña!');
    } else {
        return back()->withErrors(['email' => 'No se encontró una dirección de correo electrónico asociada con esa cuenta.']);
    }
}

}