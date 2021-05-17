<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calls extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'user', 'client', 'clientType', 'date', 'duration', 'typeOfCall', 'externalCallScore'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
