<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dan;

class DanSeeder extends Seeder
{
    public function run(): void
    {
        Dan::create(['naziv_dana'=>'ponedeljak']);
        Dan::create(['naziv_dana'=>'utorak']);
        Dan::create(['naziv_dana'=>'sreda']);
        Dan::create(['naziv_dana'=>'cetvrtak']);
        Dan::create(['naziv_dana'=>'petak']);
    }
}
