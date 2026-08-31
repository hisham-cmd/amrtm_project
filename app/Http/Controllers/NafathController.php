<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NafathController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function verify(Request $request)
    {
        return back();
    }

    public function wait()
    {
        return view('auth.login');
    }

    public function callback(Request $request)
    {
        return redirect('/');
    }
}
