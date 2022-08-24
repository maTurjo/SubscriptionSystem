<?php

namespace App\Http\Controllers;

use App\Models\ActivatedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductAuthenticatorAPIController extends Controller
{

    public function authenticateProduct(Request $req){

        $RequestData=$req->json()->all();

        $licenseKey=$RequestData["LicenseKey"];
        $verificationStatus=false;
        $foundLicense=ActivatedProduct::where("activation_key",$licenseKey)->first();

        if($foundLicense){
            $verificationStatus=true;
        }
        return response()
                ->json(
                    [
                        "licenseKey"=>$licenseKey,
                        "Verification"=>$verificationStatus,
                        "ProductName"=>$foundLicense->product->product_name,
                        "CustomerName"=>$foundLicense->customer->name
                    ]
                );
    }
    //
}
