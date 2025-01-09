<?php

namespace App\Http\Controllers;

use App\Mail\RemenderSendMessage;
use App\Models\Remender;
use App\Models\RemenderHasEmail;
use App\Models\RemenderHasPhone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RemenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if_forbidden('remenders.index');
        $remenders = Remender::orderBy('id', 'DESC')->get();

        if (!auth()->user()->hasRole('Super Admin')) {
            $remenders = Remender::where('users_id', '=', auth()->user()->id)->get();
        }

        return view('pages.remenders.index', compact('remenders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if_forbidden('remenders.create');
        return view('pages.remenders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if_forbidden('remenders.store');
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
            'organization' => 'required'
        ]);

        $remender = Remender::create([
            'users_id' => auth()->user()->id,
            'name' => $request->name,
            'date' => $request->date,
            'desc' => $request->organization
        ]);

        if ($request->get('phone')) {
            foreach ($request->get('phone') as $p) {
                RemenderHasPhone::create([
                    'remender_id' => $remender->id,
                    'phone' => $p
                ]);
            }
        }
        
        if($request->get('mail')){
            foreach ($request->get('mail') as $p) {
                RemenderHasEmail::create([
                    'remender_id' => $remender->id,
                    'email' => $p
                ]);
            }
        }
        
        message_set("Напоминание добавлено", 'success', 2);

        return redirect()->route('remenders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if_forbidden('remenders.edit');
        $remender = Remender::find($id);
        return view('pages.remenders.edit', compact('remender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        abort_if_forbidden('remenders.update');
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
            'organization' => 'required'
        ]);
        
        //dd($request);

        RemenderHasPhone::where('remender_id', $id)->delete();
        RemenderHasEmail::where('remender_id', $id)->delete();

        $remender = Remender::find($id);
        $remender->users_id = auth()->user()->id;
        $remender->name = $request->name;
        $remender->date = $request->date;
        $remender->desc = $request->organization;
        $remender->save();

        if ($request->get('phone')) {
            foreach ($request->get('phone') as $p) {
                RemenderHasPhone::create([
                    'remender_id' => $remender->id,
                    'phone' => $p
                ]);
            }
        }
        
        if($request->get('mail')){
            foreach ($request->get('mail') as $p) {
                RemenderHasEmail::create([
                    'remender_id' => $remender->id,
                    'email' => $p
                ]);
            }
        }

        message_set("Напоминание отредактировано", 'info', 2);

        return redirect()->route('remenders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if_forbidden('remenders.destroy');
        RemenderHasPhone::where('remender_id', $id)->delete();
        RemenderHasEmail::where('remender_id', $id)->delete();

        Remender::find($id)->delete();
        message_set("Напоминание удалено.", 'success', 2);
        return redirect()->route('remenders.index');
    }

    public function SendMessage(string $id)
    {
        abort_if_forbidden('remenders.sendmessage');

        $remender = Remender::find($id);

        $email = User::find($remender->users_id)->email;
        $subject = new RemenderSendMessage();
        $subject->message = $remender->name;
        $subject->organization = $remender->desc;
        $subject->data = $remender;

        $email = RemenderHasEmail::where('remender_id',$id)->get();
        foreach ($email as $e) {
            Mail::to($e->email)->send($subject);
        }

        $phone = RemenderHasPhone::where('remender_id',$id)->get();

        foreach ($phone as $p) {
            sendSMS($p,$remender);
        }

        message_set("Напоминание отправлено", 'success', 2);
        return redirect()->route('remenders.index');
    }
}
