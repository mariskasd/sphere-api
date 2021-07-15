<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\River;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        River::query()->insert([
            'name' => 'Sungai Brantas'
        ]);
        River::query()->insert([
            'name' => 'Sungai Kalisari'
        ]);
        River::query()->insert([
            'name' => 'Sungai Metro'
        ]);
        River::query()->insert([
            'name' => 'Kali Amprong'
        ]);
        River::query()->insert([
            'name' => 'Kali Buring'
        ]);
        River::query()->insert([
            'name' => 'Kali Watu'
        ]);
        River::query()->insert([
            'name' => 'Kali Kutuk'
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
