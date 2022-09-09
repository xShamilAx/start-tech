<?php

namespace App\Http\Controllers;

use App\Models\PermissionModel;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = Validator::make($request->all(), [
            'email' => 'required_without:phone_no',
            'phone_no' => 'required_without:email',
            'password' => 'required'
        ]);
        if ($loginData->fails()) {
            return response()->json([
                'meta' => [
                    'status' => 'false',
                    'status_message' => 'Validation errors found.',
                    'errors' => $loginData->messages()
                ],
            ], 200);
        }

        $credentials = request(['email', 'password']);
        $credentials2 = request(['phone_no', 'password']);
        if (!auth()->attempt($credentials)) {
            if (!auth()->attempt($credentials2)) {
                return response()->json([
                    'meta' => [
                        'status' => 'false',
                        'status_message' => 'Invalid Phone no, Email or Password'
                    ],
                ], 200);
            }
        }


        if (auth()->attempt($credentials) || auth()->attempt($credentials2)) {
            $tokenResult = auth()->user()->createToken('Token Name')->accessToken;
            return response()->json([
                'meta' => [
                    'status' => 'true',
                    'status_message' => 'Successfully logged in'
                ],
                'authentication_data' => [
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                ],
                'user_data' => [
                    'user_id' => auth()->user()->id,
                    'first_name' => auth()->user()->first_name,
                    'last_name' => auth()->user()->last_name,
                    'role' => auth()->user()->roles,
                    'email' => auth()->user()->email,
                    'phone_no' => auth()->user()->phone_no,
                ],
            ], 200);
        } else {
            return response()->json([
                'meta' => [
                    'status' => 'false',
                    'status_message' => "Wrong Password"
                ],
            ], 200);
        }
    }

    public function register(Request $request)
    {
        $loginData = Validator::make($request->all(), [
            'user_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'required|unique:users,phone_no',
            'password' => 'required',
        ]);

        if ($loginData->fails()) {
            return response()->json([
                'meta' => [
                    'status' => 'false',
                    'status_message' => 'Validation errors found.',
                    'errors' => $loginData->messages()
                ],
            ], 200);
        }

        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);

        $user = new UserModel();
        $user->username = $request['user_name'];
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone_no = $request['phone_no'];
        $user->password = Hash::make($request['password']);
        $user->status = 1;

        $userid = 0;
        if (isset(auth()->user()->id))
            $userid = auth()->user()->id;
        $user->created_by = $userid;
        $user->updated_by = $userid;
        // $user->branch_id = BranchesModel::getBranchID();

        $user->save();
        $user->assignRole([0 => "User"]);

        return response($user, 200);

    }

}
