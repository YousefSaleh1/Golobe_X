<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'policies'
    ];

    public function flight(){
        return $this->belongsTo(Flight::class);
    }
}
