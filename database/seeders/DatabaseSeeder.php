<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\River;
use App\Models\RiverHeight;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $river1 = River::query()->create([
            'name' => 'Sungai Brantas'
        ]);
        $river2 = River::query()->create([
            'name' => 'Sungai Kalisari'
        ]);
        $river3 = River::query()->create([
            'name' => 'Sungai Metro'
        ]);
        $river4 = River::query()->create([
            'name' => 'Kali Amprong'
        ]);
        $river5 = River::query()->create([
            'name' => 'Kali Buring'
        ]);
        $river6 = River::query()->create([
            'name' => 'Kali Watu'
        ]);
        $river7 = River::query()->create([
            'name' => 'Kali Kutuk'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river1->id,
            'height' => '100',
            'status' => 'Aman'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river2->id,
            'height' => '100',
            'status' => 'Aman'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river3->id,
            'height' => '100',
            'status' => 'Aman'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river4->id,
            'height' => '100',
            'status' => 'Aman'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river5->id,
            'height' => '100',
            'status' => 'Aman'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river6->id,
            'height' => '100',
            'status' => 'Aman'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river7->id,
            'height' => '100',
            'status' => 'Aman'
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
