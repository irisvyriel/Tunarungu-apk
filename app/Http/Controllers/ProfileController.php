<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;

class ProfileController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $siswa = auth('siswas')->user();
        return view('pages.profile.index', compact('siswa'));
    }
}
