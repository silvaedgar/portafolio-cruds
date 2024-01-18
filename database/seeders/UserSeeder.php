<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        $users = [['Admin', ['Admin']], ['DataTableSS', [2]], ['DataTable', [3]], ['Paginate', [4]], ['API', [5]], ['EditDTSS', [6]], ['EditDT', [7]], ['EditPaginate', [8]], ['EditAPI', [9]], ['DeleteDTSS', [10]], ['DeleteDT', [11]], ['DeletePaginate', [12]], ['DeleteAPI', [13]]];

        foreach ($users as $user) {
            \App\Models\User::create([
                'name' => $user[0],
                'email' => strtolower($user[0]) . "@portafolio.com",
                'password' => bcrypt('12345678'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ])->assignRole($user[1]);
        }

        DB::commit();
    }
}
