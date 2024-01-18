<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function SavePermission($name) {
        return \Spatie\Permission\Models\Permission::create(['name' => $name, 'guard_name' => 'web']);
    }

    public function SaveRole($name, $permissions) {
        $role = \Spatie\Permission\Models\Role::create(['name' => $name, 'guard_name' => 'web']);
        return $role->syncPermissions($permissions);
    }

    public function run()
    {
        DB::beginTransaction();
        $permisosConfig = config('permissions');
        $permisos = [];
        $roleAdmin = \Spatie\Permission\Models\Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        foreach ($permisosConfig as $key => $value) {
            // si es el arreglo son los permisos a utilizar lo agrega a los permisos
            if (gettype($value) != 'array') {
                if  (substr($key,0,4) == "role") {
                        for ($i = 0; $i < count($permisos); $i++) {
                            $this->SavePermission($permisos[$i]);
                        }
                        $this->SaveRole($value,$permisos);
                        $permisos = [];
                    }
                }
            else
            {
                    foreach ($value as $key => $value1) {
                        $permisos[] = $value1;
                        $permisosAdmin[] = $value1;
                    }
            }


        // ojo el guard_name da error con web tiene que ser Web
        }
        $roleAdmin->syncPermissions($permisosAdmin);

        $otherRoles = [['EditDTSS',[1,2]],['EditDT',[4,5]], ['EditPaginate',[7,8]], ['EditAPI',[10,11]],['DeleteDTSS',[3]], ['DeleteDT',[6]], ['DeletePaginate',[9]],['DeleteAPI',[12]]];

        foreach ($otherRoles as $rol) {
            $this->SaveRole($rol[0],$rol[1]);
        }
        DB::commit();
    }
}