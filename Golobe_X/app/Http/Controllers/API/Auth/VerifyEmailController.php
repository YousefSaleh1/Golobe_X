<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class VerifyEmailController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }


    public function sendMail(){
        Mail::to(auth()->user())->send(new EmailVerification(auth()->user()));
        $generate = URL::temporarySignedRoute('verify-email' , now()->addMinute(30) , ['email' => auth()->user()->email]);
        return response()->json([
            'message'  =>  'Email verification link send on your email',
            'url'      =>  $generate
        ]);
    }

    public function verify(Request $request){
        if(!$request->user()->email_verified_at){
            $request->user()->forceFill([
                'email_verified_at'  => now()
            ])->save();
        }

        return response()->json([
            'message' => 'Email verified'
        ]);
    }

}
