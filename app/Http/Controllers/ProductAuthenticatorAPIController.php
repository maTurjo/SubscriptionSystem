<?php

namespace App\Http\Controllers;

use App\Models\ActivatedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductAuthenticatorAPIController extends Controller
{

    public function authenticateProduct(Request $req){

        $verificationStatus=false;
        $RequestData=$req->json()->all();
        if(!isset($RequestData["LicenseKey"])) return response()->json(["errorMessage"=>"error","Verification"=>$verificationStatus]);

        $licenseKey=$RequestData["LicenseKey"];
        $foundLicense=ActivatedProduct::where("activation_key",$licenseKey)->first();
        if($foundLicense){
            $verificationStatus=true;
            return response()
                    ->json(
                        [
                            "licenseKey"=>$licenseKey,
                            "Verification"=>$verificationStatus,
                            "ProductName"=>$foundLicense->product->product_name,
                            "CustomerName"=>$foundLicense->customer->name,
                            "ActivationAllowed"=>$foundLicense->activation_allowed,
                            "ActivationDone"=>$foundLicense->activation_done,
                        ]
                    );
        }else{
            return response()
                    ->json(
                        [
                            "licenseKey"=>$licenseKey,
                            "Verification"=>$verificationStatus,
                            "ProductName"=>"",
                            "CustomerName"=>""
                        ]
                    );

        }
    }
    //
}
