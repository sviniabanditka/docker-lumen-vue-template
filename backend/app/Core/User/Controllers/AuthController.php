<?php

namespace App\Core\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Core\Common\Controllers\Controller;
use App\Core\User\Models\User;
use App\Core\User\Resources\UserResource;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //validate request
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);
        if($validator->fails()){
            return response()->error($validator->errors(), 'Validation errors', 422);
        }

        //create user
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        //generate token & response
        $data = [
            'token' => $user->createToken('PMS-User-Token')->accessToken,
            'user' => new UserResource($user),
        ];
        return response()->success($data, 'Account created successfully!');
    }

    public function login(Request $request)
    {
        //validate request
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:8'
        ]);
        if($validator->fails()){
            return response()->error($validator->errors(), 'Validation errors', 422);
        }

        //verify credentials
        $user = User::query()
            ->where('email', $request->input('email'))
            ->orWhere('username', $request->input('email'))
            ->first();
        if (!$user) {
            return response()->error([], 'User not found!', 502);
        }
        if (!Hash::check($request->input('password'), $user->password)) {
            return response()->error([], 'Wrong password!', 502);
        }

        //generate token & response
        $data = [
            'token' => $user->createToken('API Token')->accessToken,
            'user' => new UserResource($user),
        ];
        return response()->success($data, 'Login successfully!');
    }
}
