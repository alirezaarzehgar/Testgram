<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profilePath = 'public/profiles';

        $images = Storage::allFiles($profilePath);

        $profiles = Profile::all();

        foreach ($profiles as $profile) {
            $profile->image()->create(['url' => Arr::random($images)]);
        }
    }
}
