<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponder;

    public function login(Request $request)
    {
        if (auth('siswas')->check()) {
            return redirect()->route('home');
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nis' => 'required|exists:siswas,nis',
                'password' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Validasi Gagal');
            }

            $siswa = Siswa::where('nis', $request->nis)->first();

            if (!Hash::check($request->password, $siswa->password)) {
                return $this->errorResponse(null, 'Password tidak sesuai');
            }

            $login = auth('siswas')->login($siswa);
            return $this->successResponse($login, 'Login Berhasil');
        }

        return view('pages.auth.login');
    }

    public function logout()
    {
        auth('siswas')->logout();
        return redirect()->route('login');
    }
}
