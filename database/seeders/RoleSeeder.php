<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin', 'Dtss', 'Dtclient', 'Paginate', 'Api'];
        // $roles = [['Admin', ['Admin']], ['Indices', ['indices.nacimientos', 'indices.defunciones', 'indices.matrimonios']], ['Nacimientos', ['nacimientos.crear', 'nacimientos.modificar', 'nacimientos.eliminar']], ['Defunciones', ['defunciones.crear', 'defunciones.modificar', 'defunciones.eliminar']], ['Funcionarios', ['funcionarios.crear', 'funcionarios.modificar', 'funcionarios.eliminar']]];

        for ($i = 0; $i < count($roles); $i++) {
            echo $i;
            \Spatie\Permission\Models\Role::create(['name' => $roles[$i], 'guard_name' => 'web']);
            echo 'EJECUTADO';
        }
    }
}
