<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::create([
            'type' => 'Weekday',
            'harga' => 50000,
        ]);

        Ticket::create([
            'type' => 'Weekend',
            'harga' => 75000,
        ]);
    }
}
