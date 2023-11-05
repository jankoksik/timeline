<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'start_date' => Carbon::class,
        'end_date' => Carbon::class,
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\EventType');
    }

}
