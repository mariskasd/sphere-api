<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPasswordRequest;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
 
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->validated();

        $user = User::query()
            ->where('email', $request->email)
            ->first();
        if ($user) {
            if (Auth::attempt($request->only('email', 'password'))) {
                Auth::login($user);

                return [
                    "isError" => false,
                    'user' => $user,
                    'token' => $user->createToken('token-auth')->plainTextToken
                ];
            } else {
                return response()->json(["isError" => true,"message" => "Invalid email or password"],200);
            }
        } else {
            return response()->json(["isError" => true,"message" => "Invalid email or password"],200);
        }
 
    }
 
    public function register(RegisterRequest $request)
    {
        $request->validated();
 
        $user = new User;
        $user->name = $request->name;
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if($save){
            return response()->json(["isError" => false,"message" => "Sukses Register"] ,200);
        } else {
            return response()->json(["isError" => true,"message" => "Gagal Register"],400);
        }
    }

    public function getProfile()
    {
       return Auth::user();
    }

    public function editProfile(EditProfileRequest $request)
    {
        $request->validated();

        $user = User::query()->where('id',Auth::user()->id)->first();

        $user->update($request->all());

        return $user;
    }

    public function editPassword(EditPasswordRequest $request)
    {
        $request->validated();

        $user = User::query()->where('id',Auth::user()->id)->first();

        if(Hash::check($request->password_old,$user->password)){
            $password = Hash::make($request->password);
            $user->update(["password" => $password]);
            return response()->json(["isError" => false,"message" => "Sukses Ubah Kata Sandi"],200);
        }else{
            return response()->json(["isError" => true,"message" => "Kata Sandi Lama Salah"],200);
        }

        return $user;
    }
 
    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json(["isError" => false,"message" => "Logout Success"],200);
    }

}