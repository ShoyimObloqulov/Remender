<?php

namespace App\Models;
use Carbon\Carbon;

use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Remender extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','date','users_id','desc'];

    protected $dates = ['deleted_at'];

    public function RemenderTimeCompare($date): bool {
        $todayDate = new Carbon(now()->format('m/d/Y H:i'));
        $carbon = new Carbon($date);
        $carbon->format('m/d/Y H:i');
        return $todayDate->gt($carbon);
    }

    public function reminders(){
        $today = Carbon::today();
        $twoDaysAhead = Carbon::today()->addDays(2);
        $fourDaysAhead = Carbon::today()->addDays(4);

        return Remender::where(function($query) use ($today, $twoDaysAhead, $fourDaysAhead) {
            $query->whereDate('date', $today)
                ->orWhereDate('date', $twoDaysAhead)
                ->orWhereDate('date', $fourDaysAhead);
        })->get();
    }

    public function email()
    {
        return $this->hasMany(RemenderHasEmail::class,'remender_id','id');
    }

    public function phone()
    {
        return $this->hasMany(RemenderHasPhone::class,'remender_id','id');
    }

    public function RemenderEmail(string $id){
        return User::find($id)->email;
    }
}
