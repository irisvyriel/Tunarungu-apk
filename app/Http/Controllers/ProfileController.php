<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;

class ProfileController extends Controller
{
    use ApiResponder;

    public function index()
    {
        return view('pages.profile.index');
    }
}
