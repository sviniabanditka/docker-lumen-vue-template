<?php

namespace App\Core\Common\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function test(Request $request) {
        return response()->json(['action' => 'test', 'data' => Auth::check()]);
    }
}
