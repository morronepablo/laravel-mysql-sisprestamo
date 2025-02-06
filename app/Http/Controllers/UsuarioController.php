<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all()->sortByDesc('id');
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::all()->sortByDesc('id');
        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // $datos = request()->all();
        // return response()->json($datos);
        $request->validate([
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $usuario = new User();

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);

        $usuario->save();

        $usuario->assignRole($request->role);

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Se registró el usuario satisfactoriamente.')
            ->with('icono', 'success');
    }

    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function edit(string $id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::all()->sortByDesc('id');
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id, // Ignorar el email actual del usuario
            'password' => 'nullable|confirmed', // Solo validar si la contraseña está presente
        ]);

        $usuario = User::findOrFail($id);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        $usuario->syncRoles($request->role);

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Se actualizó el usuario satisfactoriamente.')
            ->with('icono', 'success');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Se eliminó el usuario satisfactoriamente.')
            ->with('icono', 'success');
    }
}
