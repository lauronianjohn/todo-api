<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    // /**
    //  * Handle an authentication attempt.
    //  *
    //  */
    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->error('', 'Credentials do not match', 401);
        }

        return $this->success([
            'user' => new UserResource($user),
            'token' => $user->createToken('Api Token of '.$user->name)->plainTextToken
        ]);
    }

    public function logout()
    {
        Auth::guard('sanctum')->user()->currentAccessToken()->delete();

        return $this->success('', 'You have successfully been logged out and your token has been deleted');
    }

    public function validateToken()
    {
        if(Auth::guard('sanctum')->check())
        {
            return $this->success([
                'validate' => true,
            ]);
        }
        return $this->error('', 'Unauthenticated', 401);
    }
}
