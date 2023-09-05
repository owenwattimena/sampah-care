<?php

namespace App\Http\Controllers;

use App\Helpers\AlertFormatter;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function masuk()
    {
        return view('auth.masuk');
    }

    public function prosesMasuk(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        try {
            if(\Auth::guard('admin')->attempt($credentials)){
                return redirect()->intended();
            }
            return redirect()->back()->with(AlertFormatter::danger("Username atau password salah."));

        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Error . " . $e->getMessage()));
        }
    }
}
