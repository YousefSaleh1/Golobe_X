<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkEmailRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Mail\RestPasswordLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class PasswordRestController extends Controller
{
    use ApiResponseTrait;

    public function __construct(){
        $this->middleware('guest');
    }

    public function sendRestEmail(LinkEmailRequest $request){

        $url = URL::temporarySignedRoute('password.reset' , now()->addMinute(30) , ['email' => $request->email]);

        Mail::to($request->email)->send(new RestPasswordLink($url));

        return response()->json([
            'message'   => 'Reset password link sent on your email',
            'url'       => $url
        ]);
    }

    public function reset(ResetPasswordRequest $request){
        $user = User::where( 'email' ,$request->email)->first();

        if(!$user) {
            return $this->customeRespone(null , 'User not Found' , 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message'  =>  'Password reset successfully'
        ] , 200);
    }
}
