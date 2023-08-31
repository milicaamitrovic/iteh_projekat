<?php

namespace App\Http\Controllers;

use App\Models\RasporedNastave;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RasporedNastaveResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDF;

class RasporedNastaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rasporedNastave= RasporedNastave::all();
        return RasporedNastaveResource::collection($rasporedNastave);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'naziv_rasporeda' => 'required|string|max:255',
            'datum_od' => 'required|date',
            'datum_do' => 'required|date|after:datum_od',
            'grupa_za_nastavu_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['Greska pri validaciji!', $validator->errors()]);
        }

        $adminUser = User::where('ime', 'admin')->first();

        $rasporedNastave = RasporedNastave::create([
            'naziv_rasporeda' => $request->naziv_rasporeda,
            'datum_od' => $request->datum_od,
            'datum_do' => $request->datum_do,
            'grupa_za_nastavu_id' => $request->grupa_za_nastavu_id,
            'korisnik_id' => $adminUser->id,
        ]);

        return response()->json(['Raspored nastave je dodat!', new RasporedNastaveResource($rasporedNastave)]);
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $raspored = RasporedNastave::find($id);

        if ($raspored) {

           return new RasporedNastaveResource($raspored);

        } else {

           return response()->json('Raspored sa trazenim id-jem ne postoji.');

        }
   }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RasporedNastave $rasporedNastave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $raspored = RasporedNastave::find($id);

        if (is_null($raspored)) {

           return response()->json('Raspored koji zelite da azurirate ne postoji!');
        }

        $validator = Validator::make($request->all(), [
            'naziv_rasporeda' => 'required|string|max:255',
            'datum_od' => 'required|date',
            'datum_do' => 'required|date|after:datum_od',
            'grupa_za_nastavu_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['Greska pri azuriranju rasporeda za nastavu!', $validator->errors()]);
        }

        $raspored->naziv_rasporeda = $request->naziv_rasporeda;
        
        $raspored->save();

        return response()->json(['Raspored nastave je azuriran!', new RasporedNastaveResource($raspored)]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rasporedNastave = RasporedNastave::find($id);
        if ($rasporedNastave) {
            $rasporedNastave->delete();
            return response()->json(['Uspesno ste obrisali raspored nastave!', new RasporedNastaveResource($rasporedNastave)]);
        }
        else {
            return response()->json('Raspored nastave koji zelite da obrisete ne postoji!');
        } 
    }

    public function searchByNazivRasporeda(Request $request)
    {
        $nazivRasporeda = $request->input('naziv_rasporeda');

        $raspored = RasporedNastave::where('naziv_rasporeda', $nazivRasporeda)->first();

        if ($raspored) {
            return new RasporedNastaveResource($raspored);
        } else {
            return response()->json('Raspored sa ovim nazivom ne postoji.');
        }
    }

    public function generatePdf($id)
    {
        $raspored = RasporedNastave::find($id);

        if (is_null($raspored)) {

            return response()->json('Raspored sa trazenim id-jem ne postoji!');
        }

        $html = view('raspored_pdf', compact('raspored'));
        $pdf = PDF::loadHTML($html);

        $pdfFileName = $raspored->naziv_rasporeda . '.pdf';
        return $pdf->download($pdfFileName);
    }
    
}
