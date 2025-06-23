<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nacionalidad' => 'in:V,E',
            'cedula' => 'required|min:6',
            'name' => 'required|min:4',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'usertype' => 'required|in:admin,user,instructor',
            'status' => '',
        ]);

        $user = new User();
        $user->nacionalidad = $request->input('nacionalidad')->default('V');
        $user->cedula = $request->input('cedula');
        $user->name = $request->input('name');
        $user->direccion = $request->input('direccion');
        $user->telefono = $request->input('telefono');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->usertype = $request->input('usertype');
        $user->status = $request->input('status');
        $user->save();

        
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');

    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->usertype = $request->usertype;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    
    public function destroy(User $user)
    {
       
  
        $user->delete();

        return redirect()->route('users.index');
    }

}
