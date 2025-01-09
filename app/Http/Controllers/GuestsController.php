<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guests;
use App\Models\States;

class GuestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if_forbidden('guests.index');
        $guests = Guests::all();
        return view('guests.index',compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if_forbidden('guests.create');
        $state = States::all();
        return view('guests.create',compact('state'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if_forbidden('guests.store');
        $this->validate($request,[
            'name' => 'required',
            'states_id' => 'required',
            'number_of_guests' => 'required',
            'goal' => 'required',
            'end_time' => 'required',
            'file'  => 'file|max:4000|mimetypes:application/pdf,application/msword'
        ]);

        $file_name = md5(time()).'.'.$request->file->extension();
        $request->file->move(public_path('guest'),$file_name);
        // dd($request);
        Guests::create([
            'name' => $request->name,
            'states_id' => $request->states_id,
            'number_of_guests' => $request->number_of_guests,
            'goal' => $request->goal,
            'end_time' => $request->end_time,
            'start_time' => $request->start_time,
            'file'  => $file_name
        ]);
        message_set("Remender Yaratildi",'success',2);
        return redirect()->route('guests.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if_forbidden('guests.edit');
        $guest = Guests::find($id);
        $state = States::all();
        return view('guests.edit',compact('guest','state'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if_forbidden('guests.update');
        $this->validate($request,[
            'name' => 'required',
            'states_id' => 'required',
            'number_of_guests' => 'required',
            'goal' => 'required',
            'end_time' => 'required',
            'file'  => 'file|max:4000|mimetypes:application/pdf,application/msword'
        ]);

        $guests = Guests::find($id);

        if($request->file){
            $file_name = md5(time()).'.'.$request->file->extension();
            $request->file->move(public_path('guest'),$file_name);

            $guests->file = $file_name;
        }

        $guests->name = $request->name;
        $guests->states_id = $request->states_id;
        $guests->number_of_guests = $request->number_of_guests;
        $guests->goal = $request->goal;
        $guests->end_time = $request->end_time;
        $guests->save();

        message_set("Remender Taxrirlandi",'success',2);
        return redirect()->route('guests.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if_forbidden('guests.destroy');
        $guest = Guests::find($id);
        $guest->delete();
        message_set("Remender O'chirildi",'warning',2);
        return redirect()->route('guests.index');
    }
}
