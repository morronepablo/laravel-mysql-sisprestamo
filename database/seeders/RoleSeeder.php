<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Administrador']);

        // Rutas para configuraciones
        Permission::create(['name' => 'admin.configuracion.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.configuracion.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.configuracion.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.configuracion.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.configuracion.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.configuracion.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.configuracion.destroy'])->syncRoles([$admin]);

        // Rutas para roles
        Permission::create(['name' => 'admin.roles.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.asignar_roles'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.update_asignar'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.destroy'])->syncRoles([$admin]);

        // Rutas para usuarios
        Permission::create(['name' => 'admin.usuarios.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.destroy'])->syncRoles([$admin]);

        // Rutas para clientes
        Permission::create(['name' => 'admin.clientes.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.clientes.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.clientes.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.clientes.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.clientes.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.clientes.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.clientes.destroy'])->syncRoles([$admin]);

        // Rutas para prestamos
        Permission::create(['name' => 'admin.prestamos.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.prestamos.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.prestamos.cliente.obtenerCliente'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.prestamos.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.prestamos.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.prestamos.contratos'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.prestamos.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.prestamos.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.prestamos.destroy'])->syncRoles([$admin]);

        // Rutas para pagos
        Permission::create(['name' => 'admin.pagos.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.pagos.cargar_prestamo_cliente'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.pagos.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.pagos.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.pagos.comprobantedepago'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.pagos.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.pagos.destroy'])->syncRoles([$admin]);

        // Rutas para notificaciones
        Permission::create(['name' => 'admin.notificaciones.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.notificaciones.notificar'])->syncRoles([$admin]);

        // Rutas para backups
        Permission::create(['name' => 'admin.backups.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.backups.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.backups.descargar'])->syncRoles([$admin]);
    }
}
