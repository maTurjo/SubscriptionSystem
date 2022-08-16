<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{


    public function index(Request $req){

        $res=new Response("True");
        // $res
        return $res->withCookie(cookie()->forever("last","TURJO"));;
        // dd(Hash::check("123456789",$user['password']));
        // return view("welcome");
    }

    //
}
