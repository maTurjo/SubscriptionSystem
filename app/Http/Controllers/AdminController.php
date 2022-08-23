<?php

namespace App\Http\Controllers;

use App\Models\ActivatedProduct;
use App\Models\Customer;
use App\Models\Product;
use DateTime;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    //GET
    public function addProduct(Request $req){
        return view ("addNewProduct");
    }
    //Register New Product Type POST
    public function addNewProductType(Request $req){
        try{

            $productName=$req->post("productName");
            $product=new Product();
            $isProductExists=Product::where("product_name",$productName)->first();

            if(isset($isProductExists)){

                return view ("addNewProduct",
                [
                    "errorMessage"=>"Product Already Exists",

                ]);
            }
            $product->product_name=$productName;
            $product->save();
            return view ("addNewProduct",
            [
                "SuccessMessage"=>"Product Added Successfully",
                "productId"=>$product->id,
                "ProductName"=>$product->product_name,
            ]);
        }
        catch(Exception $err){
            return view ("addNewProduct",
            [
                "errorMessage"=>"Something Went Wrong",

            ]);
        }
    }

    public function index(Request $req){
        return view("admin");
    }
    //
    public function addProductLicense(Request $req){
        $customers=Customer::all();
        $products=Product::all();
        return view("addProductLicense-admin",['products'=>$products,"users"=>$customers]);
    }

    public function generateProductLicense(Request $req){
        // dd($req->post());
        $productId=$req->post("productId");
        $userId=$req->post("userId");
        $activationAllowed=$req->post("activation");
        $licenseKey=Str::random(20);

        $existingActivatedProduct=ActivatedProduct::where(["product_id"=>$productId,"customer_id"=>$userId])->first();
        if(isset($existingActivatedProduct)){
            $customers=Customer::all();
            $products=Product::all();
            return view("addProductLicense-admin",
            [
                'products'=>$products,
                "users"=>$customers,
                "errorList"=>["Product Already Registered for user"]
            ]);
        }

        $activatedProduct= new ActivatedProduct();

        //Activating Product START
        $activatedProduct->product_id=$productId;
        $activatedProduct->is_activated=true;
        $activatedProduct->activation_allowed=$activationAllowed;
        $activatedProduct->activation_key=$licenseKey;
        $activatedProduct->expiry_date_time=date("Y-m-d H:i:s",strtotime('+1 year'));
        $activatedProduct->customer_id=$userId;
        $activatedProduct->activation_done=true;
        $activatedProduct->save();
        //Activating Product END

        $customer=Customer::find($userId)->first();
        $product=Product::find($productId)->first();



        return view("addProductLicense-admin",
                    [
                        "generatedData"=>true,
                        "customerName"=>$customer->name,
                        "productName"=>$product->product_name,
                        "LicenseKey"=>$licenseKey
                    ]);
    }
}
