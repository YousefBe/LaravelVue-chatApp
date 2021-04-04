<?php

namespace Database\Seeders;

use App\Models\ChatRoom;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ChatRoomSeeder::class
        ]);
    }
}