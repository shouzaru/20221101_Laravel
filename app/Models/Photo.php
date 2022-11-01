<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table = "photos"; 
    protected $fillable = ['path','date']; 

    public function Players()
    {
        return $this->belongsToMany('App\Models\Player')->withTimestamps();
    }
}
