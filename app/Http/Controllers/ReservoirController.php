<?php

namespace App\Http\Controllers;

use App\Models\Reservoir;
use Illuminate\Http\Request;
use Validator;

class ReservoirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $reservoirs = Reservoir::all();
       return view('reservoir.index', ['reservoirs' => $reservoirs]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservoir.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->reservoir_area = str_replace(',','.', $request->reservoir_area);
          $request->reservoir_area =  round( $request->reservoir_area * 1000) / 1000;
        
        $validator = Validator::make($request->all(),
            [
                'reservoir_title' => ['required', 'min:2', 'max:30'],
                'reservoir_area' => ['required', 'numeric', 'min:1', 'max:1600'],
                'reservoir_about' => ['required', 'min:2', 'max:10000'],
            ],
            [
                'reservoir_title.required' => 'Vandens telkinio pavadinimas privalomas',
                'reservoir_title.min' => 'Vandens telkinio pavadinimas per trumpas',
                'reservoir_title.max' => 'Vandens telkinio pavadinimas per ilgas',

                'reservoir_area.required' => 'Laukas "Plotas" privalomas',
                'reservoir_area.numeric' => 'Laukas "Plotas" turi būti užpildytas skaičiais',
                'reservoir_area.min' => 'Lauko "Plotas" reikšmė per maža',
                'reservoir_area.max' => 'Lauko "Plotas" reikšmė per didelė',

                'reservoir_about.required' => 'Laukas "Aprašymas" privalomas',
                'reservoir_about.min' => 'Lauko "Aprašymas" reikšmė per trumpa',
                'reservoir_about.max' => 'Lauko "Aprašymas" reikšmė per ilga'
            ]
        );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }



        $reservoir = new Reservoir;
        $reservoir->title = $request->reservoir_title;
        $reservoir->area = $request->reservoir_area;
        $reservoir->about = $request->reservoir_about;
        $reservoir->save();
        return redirect()->route('reservoir.index')->with('success_message', 'Sekmingai įrašytas.');

        

    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function show(Reservoir $reservoir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservoir $reservoir)
    {
        return view('reservoir.edit', ['reservoir' => $reservoir]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservoir $reservoir)
    {

        $request->area = str_replace(',','.', $request->area);

        $validator = Validator::make($request->all(),
            [
                'reservoir_title' => ['required', 'min:2', 'max:30'],
                'reservoir_area' => ['required', 'numeric', 'min:1', 'max:1600'],
                'reservoir_about' => ['required', 'min:2', 'max:10000'],
            ],
            [
                'reservoir_title.required' => 'Vandens telkinio pavadinimas privalomasddddddddddddddddddddddddddddd',
                'reservoir_title.min' => 'Vandens telkinio pavadinimas per trumpas',
                'reservoir_title.max' => 'Vandens telkinio pavadinimas per ilgas',

                'reservoir_area.required' => 'Laukas "Plotas" privalomas',
                'reservoir_area.numeric' => 'Laukas "Plotas" turi būti užpildytas skaičiais',
                'reservoir_area.min' => 'Lauko "Plotas" reikšmė per maža',
                'reservoir_area.max' => 'Lauko "Plotas" reikšmė per didelė',

                'reservoir_about.required' => 'Laukas "Aprašymas" privalomas',
                'reservoir_about.min' => 'Lauko "Aprašymas" reikšmė per trumpa',
                'reservoir_about.max' => 'Lauko "Aprašymas" reikšmė per ilga'
            ]
        );
    if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
    }     


       $reservoir->title = $request->reservoir_title;
       $reservoir->area = $request->reservoir_area;
       $reservoir->about = $request->reservoir_about;
       $reservoir->save();
       return redirect()->route('reservoir.index')->with('success_message', 'Sėkmingai pakeistas.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservoir $reservoir)
    {
       
       if($reservoir->reservoirMembers->count()){
            return redirect()->route('reservoir.index')->with('info_message', ' '.$reservoir->title. " ".'trinti negalima, nes turi narių.');

       }
       $reservoir->delete();
       return redirect()->route('reservoir.index')->with('success_message', ' '.$reservoir->title. " ".'Sekmingai ištrintas.');


    }
}
