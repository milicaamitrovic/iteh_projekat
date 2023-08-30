<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\DrzavniPrazniciResource;

class DrzavniPrazniciController extends Controller
{
    public function vratiDrzavnePraznike()
    {
        $drzavni_praznici = Http::get('https://date.nager.at/api/v3/PublicHolidays/2023/RS');

        $data = $drzavni_praznici->json();
        return DrzavniPrazniciResource::collection($data);
    }
}
