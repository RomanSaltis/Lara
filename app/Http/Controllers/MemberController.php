<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Reservoir;
use Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    $members = Member::all();
       $members = Member::orderBy('surname')->orderBy('name')->get();
       $waters = Reservoir::all();
       return view('member.index', ['members' => $members, 'waters' => $waters]);

    }
    public function indexSpecifics(Request $request)
    {
        $order = $request->order;
        $filter = $request->filter;
        $members = Member::all();

        if($order != 0){
            $members = $members->sortBy($order);
                        
        }
        if($filter != 0){
               $members = $members->where('reservoir_id','=',$filter); 
            }
    //    $members = Member::orderBy('surname')->orderBy('name')->get();
       $waters = Reservoir::all();
       return view('member.index', ['members' => $members, 'waters' => $waters]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $reservoirs = Reservoir::all();
       return view('member.create', ['reservoirs' => $reservoirs]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $request->member_experience = str_replace(',', '.', $request->member_experience);
       //var_dump($request->member_experience);
       $request->member_experience = floatval($request->member_experience);
    //    var_dump($request->member_experience);
    //    die;
    //    dd($request->member_experience);
       $request->member_registered = str_replace(',', '.', $request->member_registered);
       $request->member_name =  ucwords(strtolower($request->member_name));
       $request->member_surname =  ucwords(strtolower($request->member_surname));

        $validator = Validator::make($request->all(),
            [
                'member_name' => ['required', 'min:2', 'max:30'],
                'member_surname' => ['required', 'min:2', 'max:30'],
                'member_live' => ['required', 'min:2', 'max:30'],
                'member_experience' => ['required',  'min:0.00', 'max:99.99'],
                'member_registered' => ['required',  'min:0', 'max:99'],
                
            ],
            [
                'member_name.required' => 'Vardas privalomas',
                'member_name.min' => 'Vardas per trumpas',
                'member_name.max' => 'Vardas per ilgas',

                'member_surname.required' => 'Pavardė privaloma',
                'member_surname.min' => 'Pavardė per trumpa',
                'member_surname.max' => 'Pavardė per ilga',

                'member_live.required' => 'Laukas "Miestas kuriame gyvena" privalomas',
                'member_live.min' => 'Lauko "Miestas kuriame gyvena" reikšmė per trumpa',
                'member_live.max' => 'Lauko "Miestas kuriame gyvena" reikšmė per ilga',

                'member_experience.required' => 'Laukas "Patirtis " privalomas',
                'member_experience.numeric' => 'Laukas "Patirtis" turi būti užpildytas skaičiais',
                'member_experience.min' => 'Lauko "Patirtis " reikšmė per maža',
                'member_experience.max' => 'Lauko "Patirtis " reikšmė per didelė',

                'member_registered.required' => 'Laukas "Klube registruotas" privalomas',
                'member_registered.numeric' => 'Laukas "Klube registruotas" turi būti užpildytas skaičiais',
                'member_registered.min' => 'Lauko "Klube registruotas" reikšmė per maža',
                'member_registered.max' => 'Lauko "Klube registruotas" reikšmė per didelė',


            ]
        );
    if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
    }     



       $member = new Member;
       $member->name = $request->member_name;
       $member->surname = $request->member_surname;
       $member->live = $request->member_live;
       $member->experience = $request->member_experience;
       $member->registered = $request->member_registered;
       $member->reservoir_id = $request->reservoir_id;
       $member->save();
       return redirect()->route('member.index')->with('success_message', 'Sekmingai įrašytas.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
       $reservoirs = Reservoir::all();
       return view('member.edit', ['member' => $member, 'reservoirs' => $reservoirs]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {

      $request->member_experience = str_replace(',', '.', $request->member_experience);
// dd( $request->member_experience);
        $validator = Validator::make($request->all(),
            [
                'member_name' => ['required', 'min:2', 'max:30'],
                'member_surname' => ['required', 'min:2', 'max:30'],
                'member_live' => ['required', 'min:2', 'max:30'],
                'member_experience' => ['required', 'numeric', 'min:0', 'max:99'],
                'member_registered' => ['required', 'numeric', 'min:0', 'max:99'],
                
            ],
            [
                'member_name.required' => 'Vardas privalomas',
                'member_name.min' => 'Vardas per trumpas',
                'member_name.max' => 'Vardas per ilgas',

                'member_surname.required' => 'Pavardė privaloma',
                'member_surname.min' => 'Pavardė per trumpa',
                'member_surname.max' => 'Pavardė per ilga',

                'member_live.required' => 'Laukas "Miestas kuriame gyvena" privalomas',
                'member_live.min' => 'Lauko "Miestas kuriame gyvena" reikšmė per trumpa',
                'member_live.max' => 'Lauko "Miestas kuriame gyvena" reikšmė per ilga',

                'member_experience.required' => 'Laukas "Patirtis " privalomas',
                'member_experience.numeric' => 'Laukas "Patirtis" turi būti užpildytas skaičiais',
                'member_experience.min' => 'Lauko "Patirtis " reikšmė per maža',
                'member_experience.max' => 'Lauko "Patirtis " reikšmė per didelė',

                'member_registered.required' => 'Laukas "Klube registruotas" privalomas',
                'member_registered.numeric' => 'Laukas "Klube registruotas" turi būti užpildytas skaičiais',
                'member_registered.min' => 'Lauko "Klube registruotas" reikšmė per maža',
                'member_registered.max' => 'Lauko "Klube registruotas" reikšmė per didelė',


            ]
        );
    if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
    }     



       $member->name = $request->member_name;
       $member->surname = $request->member_surname;
       $member->live = $request->member_live;
       $member->experience = $request->member_experience;
       $member->registered = $request->member_registered;
       $member->reservoir_id = $request->reservoir_id;
       $member->save();
       return redirect()->route('member.index')->with('success_message', 'Sėkmingai pakeistas.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
       $member->delete();
       return redirect()->route('member.index')->with('success_message', 'Sekmingai ištrintas.');

    }
}
