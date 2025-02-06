<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all()->sortByDesc('id');
        return view('admin.roles.index', compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rol = new Role();

        $rol->name = $request->name;
        // $rol->guard_name = 'web';
        // $rol->empresa_id = Auth::user()->empresa_id;

        $rol->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Se registró el rol satisfactoriamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.show', compact('role'));
    }

    public function asignar_roles($id)
    {
        $role = Role::findOrFail($id);
        $permisos = Permission::all()->groupBy(function ($permiso) {
            if (stripos($permiso->name, 'config') !== false) {
                return 'Configuración';
            } elseif (stripos($permiso->name, 'rol') !== false) {
                return 'Roles';
            } elseif (stripos($permiso->name, 'usu') !== false) {
                return 'Usuarios';
            } elseif (stripos($permiso->name, 'cliente') !== false) {
                return 'Clientes';
            } elseif (stripos($permiso->name, 'presta') !== false) {
                return 'Prestamos';
            } elseif (stripos($permiso->name, 'pagos') !== false) {
                return 'Pagos';
            } elseif (stripos($permiso->name, 'notifi') !== false) {
                return 'Notificaciones';
            } elseif (stripos($permiso->name, 'backup') !== false) {
                return 'Backups';
            }
        });

        return view('admin.roles.asignar', compact('role', 'permisos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $rol = Role::findOrFail($id);

        $rol->name = $request->name;

        $rol->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Se Actualizó el rol satisfactoriamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Se Eliminó el rol satisfactoriamente.')
            ->with('icono', 'success');
    }

    public function update_asignar(Request $request, $id)
    {
        // $datos = request()->all();
        // return response()->json($datos);

        $role = Role::findOrFail($id);
        $role->permissions()->sync($request->input('permisos'));
        return redirect()->back()
            ->with('mensaje', 'Se Actualizó los permisos al rol satisfactoriamente.')
            ->with('icono', 'success');
    }
}
