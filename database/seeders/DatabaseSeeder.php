<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\River;
use App\Models\Report_River;
use App\Models\User;
use App\Models\RiverHeight;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $river[0] = River::query()->create([
            'name' => 'Sungai Brantas'
        ]);
        $river[1] = River::query()->create([
            'name' => 'Sungai Kalisari'
        ]);
        $river[2] = River::query()->create([
            'name' => 'Sungai Metro'
        ]);
        $river[3] = River::query()->create([
            'name' => 'Kali Amprong'
        ]);
        $river[4] = River::query()->create([
            'name' => 'Kali Buring'
        ]);
        $river[5] = River::query()->create([
            'name' => 'Kali Watu'
        ]);
        $river[6] = River::query()->create([
            'name' => 'Kali Kutuk'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river[0]->id,
            'height' => '100',
            'status' => 'Aman'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river[1]->id,
            'height' => '100',
            'status' => 'Aman'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river[2]->id,
            'height' => '100',
            'status' => 'Aman'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river[3]->id,
            'height' => '100',
            'status' => 'Aman'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river[4]->id,
            'height' => '100',
            'status' => 'Aman'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river[5]->id,
            'height' => '100',
            'status' => 'Aman'
        ]);

        RiverHeight::query()->create([
            'river_id' => $river[6]->id,
            'height' => '100',
            'status' => 'Aman'
        ]);

        $patroli[0] = User::query()->create([
            'name' => 'Andi Putra',
            'email' => 'andi@sphere.com',
            'password' =>  Hash::make('123456'),
            'phone' => '081222333444',
            'type' => 'patroli'
        ]);

        $patroli[1] = User::query()->create([
            'name' => 'Didi Putra',
            'email' => 'didi@sphere.com',
            'password' => Hash::make('123456'),
            'phone' => '081222333444',
            'type' => 'patroli'
        ]);

        User::query()->create([
            'name' => 'Dino Putra',
            'email' => 'dino@sphere.com',
            'password' => Hash::make('123456'),
            'phone' => '081111444555',
            'type' => 'teknisi'
        ]);

        User::query()->create([
            'name' => 'Dimas Putra',
            'email' => 'dimas@sphere.com',
            'password' => Hash::make('123456'),
            'phone' => '081333444555',
            'type' => 'teknisi'
        ]);

        User::query()->create([
            'name' => 'Sinta Putri',
            'email' => 'sinta@sphere.com',
            'password' => Hash::make('123456'),
            'phone' => '081444555666',
            'type' => 'admin'
        ]);

        User::query()->create([
            'name' => 'Dinda Putri',
            'email' => 'dinda@sphere.com',
            'password' => Hash::make('123456'),
            'phone' => '081111444555',
            'type' => 'user'
        ]);

        Report_River::query()->create([
            'rivers_id' => 1,
            'user_id' => 1,
            'task_date' => Carbon::parse('20-6-2022')->format('m-d-Y')
        ]);

        // for ($i = 20; $i <= 30; $i++) {
        //     $userid = $patroli[0]->id;
        //     if($i % 2 == 1){
        //         $userid = $patroli[1]->id;
        //     }
        //     for ($a = 0; $a < 7; $a++) {
        //         Report_River::query()->create([
        //             'rivers_id' => $river[$a]->id,
        //             'user_id' => $userid,
        //             'task_date' => Carbon::parse('6-' . $i .'-2022')->format('d-m-Y')
        //         ]);
        //     }
        // }



        // \App\Models\User::factory(10)->create();
    }
}
