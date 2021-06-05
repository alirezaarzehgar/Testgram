<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        User::truncate();
        Image::truncate();
        Profile::truncate();

        \App\Models\User::factory(100)->create();

        $this->call([
            ProfileSeeder::class,
            ImageSeeder::class,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
