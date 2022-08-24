<?php

namespace App\Http\Controllers;

use App\Models\ActivatedProduct;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{

    public function toHomepage(Request $req):View{

        $userEmail=$req->cookie('userEmail');
        if(isset($userEmail)){

            $user=Customer::where("email",$userEmail)->first();
            $activatedProducts=ActivatedProduct::where("customer_id",$user->id)->get();
            // dd($activatedProducts->product);
            return view('RegisterProduct',["ActivatedProductsList"=>$activatedProducts]);

        }

        return view('RegisterProduct');
    }
    //
}
