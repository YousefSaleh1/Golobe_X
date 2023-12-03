<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $fillable = [
        'cardNumber',
        'expDate',
        'cvc',
        'nameOnCard',
        'country',
        'securitySave' ,
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
