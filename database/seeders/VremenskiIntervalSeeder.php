<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VremenskiInterval;

class VremenskiIntervalSeeder extends Seeder
{
    public function run(): void
    {
        VremenskiInterval::create(['interval'=>'08:15-10:00']);
        VremenskiInterval::create(['interval'=>'10:15-12:00']);
        VremenskiInterval::create(['interval'=>'12:15-14:00']);
        VremenskiInterval::create(['interval'=>'14:15-16:00']);
        VremenskiInterval::create(['interval'=>'16:15-18:00']);
    }
}
