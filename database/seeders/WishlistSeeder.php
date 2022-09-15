<?php

namespace Database\Seeders;
use App\Models\Whislist;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        error_log('[SEEDING] ... Start ');
            Whislist::factory()->count(20)->create();
        error_log('[SEEDING] [USERS] -> DONE ');
    }
}
