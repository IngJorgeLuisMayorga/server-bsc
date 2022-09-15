<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        error_log('[SEEDING] [ORDER] -> Start ');
           Order::factory()->count(10)->create();
        error_log('[SEEDING] [ORDER] -> DONE ');
    }
}
