<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    public function logout(Request $request){
        $emailCookie=Cookie::forget("userEmail");
        $rememberCookie=Cookie::forget('rememberToken');

        return redirect("/customerLogin")->withCookies([$emailCookie,$rememberCookie]);

    }

    //Get Login Page
    public function customerLogin(Request $request){
        if($request->cookie('userEmail') && $request->cookie('rememberToken') ){
            $email=$request->cookie('userEmail');
            $rememberToken=$request->cookie('rememberToken');
            return redirect("/");
        }
        return view('Login');
    }

    //Submit Login Form
    public function getCustomerLoggedIn(Request $request){
        $email=$request->post('email');
        $password=$request->post('password');
        $errorList=[];

        $customer=Customer::where("email",$email)->first();
        if($customer){
            if (Hash::check($password, $customer["password"])){
                $token=$customer->rememberToken;
                $email=$customer->email;
                $emailCookie = Cookie::make("userEmail",$email);
                $tokenCookie = Cookie::make("rememberToken",$token);
                return redirect("/customerLogin")->withCookies([$emailCookie,$tokenCookie]);
            }else{
                array_push($errorList,"Credentials don't match");
                return view("Login",["errorList"=>$errorList]);
            }
        }else{
            array_push($errorList,"Email Doesn't Exist");
            return view("Login",["errorList"=>$errorList]);
        }
    }

    //Get Registration Page
    public function customerRegistration(Request $request){
        return view('Register');
    }

    //Submit Registration Form
    public function getCustomerRegistered(Request $request){
        $fullname=$request->post('fullName');
        $email=$request->post('email');
        $password=$request->post('password');
        $repeatPassword=$request->post('repeatPassword');
        $errorList=[];
        $existingCustomer=  Customer::where("email",$email)->first();
        if($existingCustomer){
            array_push($errorList,"Email already exists");
        }
        else if(!($password == $repeatPassword)){
            array_push($errorList,"Password don't match");
        }
        else{
            $token=fake()->regexify('[A-Za-z0-9]{20}');
            $customer=new Customer;
            $customer->name=$fullname;
            $customer->email=$email;
            $customer->password=bcrypt($password);
            $customer->rememberToken=$token;
            $customer->save();
            $emailCookie = Cookie::make("userEmail",$email);
            $tokenCookie = Cookie::make("rememberToken",$token);
            return redirect("/customerLogin")->withCookies([$emailCookie,$tokenCookie]);
        }
        return view('Register',["errorList"=>$errorList]);
    }
}
