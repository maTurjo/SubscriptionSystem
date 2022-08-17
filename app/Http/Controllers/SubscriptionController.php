<?php

namespace App\Http\Controllers;

use App\Models\ActivatedProduct;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;


class SubscriptionController extends Controller
{


    //Post method for form submission

    public function registerProduct(Request $req){
        $productKey=$req->post('productKey');
        $email=$req->post('email');
        $LicenseKey=$req->post('LicenseKey');

        $verificationDetails=$this->verifyCredentials($email,$productKey,$LicenseKey);
            return view("ValidatedProduct",
            [
                "isValidated"=>$verificationDetails["isValidated"],
                "errorList"=>$verificationDetails["errorList"]
            ]);

    }

    private function verifyCredentials(string $email,string $productKey,string $licenseKey):array{
        try{
            $errorList=[];
            $activatedProduct=ActivatedProduct::where("activation_key",$licenseKey)->first();

            if(!$activatedProduct){
                array_push($errorList,"License key doesn't exist");
                return ["isValidated"=>false,"errorList"=>$errorList]; //Returns false if product not found with licensekey
            }

            $dbLicenseKey=$activatedProduct["activation_key"];
            $dbProductKey=$activatedProduct["product_id"];
            $userId=$activatedProduct["customer_id"];

            $user=Customer::find($userId);
            if(!$user) {
                array_push($errorList,"User Doesn't Exist");
                return ["isValidated"=>false,"errorList"=>$errorList];  //Returns false if User not found with userId
            }
            $dbEmail=$user["email"];

            if($dbEmail==$email && $dbProductKey==$productKey && $dbLicenseKey== $licenseKey){
                return ["isValidated"=>true,"errorList"=>$errorList];
            }
            else
            {
                array_push($errorList,"Credentials Don't match");
                return ["isValidated"=>false,"errorList"=>$errorList];
            }

        }
        catch(Exception $ex) {
            return ["isValidated"=>false,"errorList"=>$errorList];
        }
    }
    //
}
