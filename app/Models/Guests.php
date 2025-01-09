<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guests extends Model
{
    use HasFactory;
    protected $fillable=['name','states_id','number_of_guests','goal','start_time','end_time','file'];


    public function StateName(string $state_id)
    {
        $state = States::find($state_id);
        return $state->name;
    }

    public function GuestsStatus(string $id)
    {
        $guest = Guests::find($id);
        $start_time = $guest->start_time;
        $end_time = $guest->end_time;
        $dataTimeToday = Carbon::today()->format('m/d/Y');
        $status = [];
        if ($dataTimeToday < $start_time) {
            $status = [
                'status' => 0,
                'message'=> "Kutilmoqda"
            ];
        }else if($dataTimeToday >= $start_time && $dataTimeToday <= $end_time){
            $status = [
                'status' => 1,
                'message'=> "Kelingan"
            ];
        }else{
            $status = [
                'status' => 2,
                'message'=> "Amalga oshirilgan"
            ];;
        }

        return json_encode($status);
    }
}
