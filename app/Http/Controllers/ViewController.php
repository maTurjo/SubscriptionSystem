<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{

    public function toHomepage(Request $req):View{

        return view('RegisterProduct');
    }
    //
}
