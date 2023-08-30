<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dan;

class DanSeeder extends Seeder
{
    public function run(): void
    {
        Dan::create(['naziv_dana'=>'Ponedeljak']);
        Dan::create(['naziv_dana'=>'Utorak']);
        Dan::create(['naziv_dana'=>'Sreda']);
        Dan::create(['naziv_dana'=>'Cetvrtak']);
        Dan::create(['naziv_dana'=>'Petak']);
    }
}
