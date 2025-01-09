<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemenderHasPhone extends Model
{
    use HasFactory;
    protected $fillable = ['remender_id','phone'];
}
