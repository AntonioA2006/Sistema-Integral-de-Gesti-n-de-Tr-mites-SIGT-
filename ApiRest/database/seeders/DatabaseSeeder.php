<?php

namespace Database\Seeders;

use App\Models\Requisito;
use App\Models\Role;
use App\Models\Section;
use App\Models\TipoDeTramite;
use App\Models\Tramite;
use App\Models\User;
use App\Models\UserManagement;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $role = Role::factory()->create([
            'id' =>  1,
            'role_name' =>"without-role"
        ]);
        $section = Section::factory()->create([
            'id' => 1,
            'section_name' => 'without-section',
            'roles_id' => 1
        ]);

        Role::factory(20)->create();
        Section::factory(200)->create();
        UserManagement::factory(30)->create();
        TipoDeTramite::factory(40)->create();
        Requisito::factory(40)->create();

        Tramite::factory(20)->create();



    }
}
