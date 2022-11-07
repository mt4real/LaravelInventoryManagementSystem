<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['role_name'=>"ADMIN",'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
             ['role_name'=>"SUPER ADMIN",'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
         ]);
    }
}
