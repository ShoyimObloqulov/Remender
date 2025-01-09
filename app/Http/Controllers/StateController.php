<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\States;
class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if_forbidden('states.index');
        $states = States::all();
        return view('states.index',compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        abort_if_forbidden('states.create');
        return view('states.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if_forbidden('states.store');
        $this->validate($request,[
            'name' => 'required|unique:states',
        ]);


        $state = States::create([
            'name' => $request->get('name'),
        ]);

        return redirect()->route('states.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if_forbidden('states.edit');
        $state = States::find($id);
        return view('states.edit',compact('state'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if_forbidden('states.update');
        $this->validate($request,[
            'name' => 'required|unique:states',
        ]);

        $state = States::find($id);
        $state->name = $request->get('name');
        $state->save();

        return redirect()->route('states.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if_forbidden('states.destroy');
        $state = States::find($id);
        $state->delete();
        return redirect()->route('states.index');
    }
}
