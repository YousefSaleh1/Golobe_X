<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ApiResponseTrait;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    use ApiResponseTrait ;

    public function register(UserRequest $request)
    {

        $user = $request->validated();

        $user = User::create([
            'name'  => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
            'phone_number' => $user['phone_number'],
        ]);


        $token = $user->createToken('authToken')->plainTextToken;

        Mail::to($user)->send(new EmailVerification($user));

        return $this->apiResponse(new UserResource($user), $token, 'registered successfully', 200);
    }


    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('authToken')->plainTextToken;

        return $this->apiResponse(new UserResource($user), $token, 'successfully login,welcome!', 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
