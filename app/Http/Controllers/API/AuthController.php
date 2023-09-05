<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = \Validator::make($request->input(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error($validator->errors()->first(), data: $validator->errors()->all(), code: 422);
        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];
        try {
            if (auth()->attempt($validator->getData())) {
                $user = auth()->user();

                $token = $user->createToken('user_token')->plainTextToken;
                return JsonFormatter::success(
                    [
                        'user' => $user,
                        'token' => $token
                    ],
                    message: "Login berhasil"
                );
            } else {
                return JsonFormatter::error("Unauthorised", code: 401);
            }
        } catch (\Exception $e) {
            return JsonFormatter::error("Login Gagal . " . $e->getMessage(), code: 401);
        }
    }
    public function register(Request $request)
    {
        $validator = \Validator::make($request->input(), [
            'nik' => 'required|unique:users,nik',
            'nama' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error($validator->errors()->first(), data: $validator->errors()->all(), code: 422);
        }

        $data = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password
        ];


        $user = User::create($data);

        if ($user) {

            return JsonFormatter::success(
                [
                    'user' => $user,
                ],
                message: "Pendaftaran berhasil."
            );
        } else {
            return JsonFormatter::error("Pendaftaran gagal", code: 400);
        }
    }
}
