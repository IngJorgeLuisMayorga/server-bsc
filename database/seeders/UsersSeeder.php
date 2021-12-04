<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        error_log('[SEEDING] ... Start ');
            User::factory()->count(20)->create();
        error_log('[SEEDING] [USERS] -> DONE ');
    }
}
