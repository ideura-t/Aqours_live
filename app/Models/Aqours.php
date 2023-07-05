<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aqours extends Model
{
    use HasFactory;

    protected $fillable = ['live_title', 'venue', 'day', 'date', 'memo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'aqours_song');
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'aqours_song')->withTimestamps();
    }
}
