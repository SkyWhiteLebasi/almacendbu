<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Almacen']);
        $role3 = Role::create(['name' => 'Nutricion']);

        $permission = Permission::create(['name' => 'home'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'user.index'])->assignRole($role1);
        $permission = Permission::create(['name' => 'user.create'])->assignRole($role1);
        $permission = Permission::create(['name' => 'user.edit'])->assignRole($role1);
        $permission = Permission::create(['name' => 'user.destroy'])->assignRole($role1);
        

        $permission = Permission::create(['name' => 'producto.pdf'])->syncRoles([$role1, $role2,$role3]);
        $permission = Permission::create(['name' => 'producto.import-excel'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'producto.index'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'producto.create'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'producto.store'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'producto.edit'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'producto.update'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'producto.destroy'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'pedido.index'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'pedido.create'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'pedido.import-excel'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'pedido.pdf'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'pedido.edit'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'pedido.destroy'])->syncRoles([$role1, $role3]);

        $permission = Permission::create(['name' => 'semana.index'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'semana.create'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'semana.destroy'])->syncRoles([$role1, $role3]);

        $permission = Permission::create(['name' => 'entrada.import-excel'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'entrada.pdf'])->syncRoles([$role1, $role2, $role3]);
        $permission = Permission::create(['name' => 'entrada.index'])->syncRoles([$role1, $role2, $role3]);;
        $permission = Permission::create(['name' => 'entrada.create'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'entrada.edit'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'entrada.show'])->syncRoles([$role1, $role2,$role3]);
        $permission = Permission::create(['name' => 'entrada.destroy'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'salida.import-excel-alm'])->syncRoles([$role1, $role2]);
        // $permission = Permission::create(['name' => 'salida.import-excel'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'salida.pdf'])->syncRoles([$role1, $role2, $role3]);
        // $permission = Permission::create(['name' => 'salida.pdf_nutricion'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'salida.nutricion'])->syncRoles([$role1,$role2]);
        // $permission = Permission::create(['name' => 'salida.salidadiaria'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'salida.index'])->syncRoles([$role1, $role2, $role3]);;
        $permission = Permission::create(['name' => 'salida.create'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'salida.editdos'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'salida.edit'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'salida.show'])->syncRoles([$role1, $role2,$role3]);
        $permission = Permission::create(['name' => 'salida.destroy'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'salidanutricion.index'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'salidanutricion.create'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'salidanutricion.edit'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'salidanutricion.import-excel'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'salidanutricion.destroy'])->syncRoles([$role1, $role3]);
        // $permission = Permission::create(['name' => 'salidanutricion.destroy'])->syncRoles([$role1, $role3]);
        $permission = Permission::create(['name' => 'salidanutricion.pdf_nutricion'])->syncRoles([$role1, $role3]);


        $permission = Permission::create(['name' => 'medida.index'])->syncRoles([$role1, $role2,$role3]);
        $permission = Permission::create(['name' => 'medida.create'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'medida.destroy'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'categoria.index'])->syncRoles([$role1, $role2,$role3]);
        $permission = Permission::create(['name' => 'categoria.create'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'categoria.destroy'])->syncRoles([$role1, $role2]);
        
        $permission = Permission::create(['name' => 'kardex'])->syncRoles([$role1, $role2, $role3]);   
    
    }
}
