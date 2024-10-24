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
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nis' => 'required|exists:siswas,nis',
                'password' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse(null, $validator->errors()->first());
            }

            $siswa = Siswa::where('nis', $request->nis)->first();

            if (!Hash::check($request->password, $siswa->password)) {
                return $this->errorResponse(null, 'Password tidak sesuai');
            }

            $session = auth('siswas')->login($siswa);
            return $this->successResponse($siswa, 'Login Berhasil');
        }

        return view('pages.auth.login');
    }

    public function logout()
    {
        auth('siswas')->logout();
        return redirect()->route('login');
    }
}
