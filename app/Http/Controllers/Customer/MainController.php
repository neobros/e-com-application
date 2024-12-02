<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Cart;

class MainController extends Controller
{
    public function home()
    {
         $cartData = null ;

        if(Auth::guard('customer')->check())  
        {
            $cartData =  Cart::where('carts.customer_id' , Auth::guard('customer')->user()->id)->select('carts.cart_id')->get();
        }

        $productList = Product::join('brands', 'products.brand_id', '=', 'brands.brand_id')->select('products.*', 'brands.brand_name')->get();
        $brandList = Brand::all();

        return view('customer.home')->with([
            'brandList'  =>   $brandList, 
            'productList'  =>   $productList, 
            'cartData'  =>  $cartData, 
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::guard('customer')->attempt($credentials)) {

            $user = Auth::guard('customer')->user();
            if ($user->status == 0) {
                Auth::guard('customer')->logout();
                request()->session()->invalidate();
                //Regenerate session token to prevent session fixation attacks
                request()->session()->regenerateToken();
                return response()->json(['success' => false, 'message' => 'Your account is deactivated. Please contact support.'], 401); 

            }
            return response()->json(['success' => true, 'message' => 'Login successfully.'], 200);
        }

        return response()->json(['success' => false, 'message' => 'These credentials do not match our records!'], 401);
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        request()->session()->invalidate();
        //Regenerate session token to prevent session fixation attacks
        request()->session()->regenerateToken();

        return redirect('/')->with('message', 'Successfully logged out');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string',
            'contact' => 'required|digits_between:9,10',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $customer = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'contact' => $request->contact,
            'contact' => $request->contact,
            'status' =>1,
            'email' => $request->email,
            'role' => 0,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
    
        //check Auth
        Auth::guard('customer')->login($customer);
        return response()->json(['success' => true, 'message' => 'Registered successfully.'], 200);
    }

    public function profile ()
    {
        $cartData =  Cart::where('carts.customer_id' , Auth::guard('customer')->user()->id)->select('carts.cart_id')->get();
        $brandList = Brand::all();
        $userData = User::where('id', Auth::guard('customer')->user()->id )->first();
        return view('customer.profile')->with([
            'userData'  =>  $userData, 
            'brandList'  => $brandList, 
            'cartData'  =>  $cartData, 
        ]);
    }

    public function updateAccountDetails(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'contact' => 'required|digits_between:9,10',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $update = [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'contact' => $request->contact,
            'address' => $request->address,
        ];
        User::where('id', Auth::guard('customer')->user()->id )->update($update);

        return response()->json(['success' => true, 'message' => 'Details Change Successfully..'], 200);
    }


    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed', 
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::guard('customer')->user(); 

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Current password is incorrect.'], 401);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password); 
        $user->save(); 

        return response()->json(['success' => true, 'message' => 'Password changed successfully.'], 200);
    }

    public function about()
    {
        $cartData = null ;

        if(Auth::guard('customer')->check())  
        {
            $cartData =  Cart::where('carts.customer_id' , Auth::guard('customer')->user()->id)->select('carts.cart_id')->get();
        }

        $brandList = Brand::all();

        return view('customer.about')->with([
            'brandList'  =>   $brandList, 
            'cartData'  =>  $cartData, 
        ]);
    }


    public function contact()
    {
        $cartData = null ;

        if(Auth::guard('customer')->check())  
        {
            $cartData =  Cart::where('carts.customer_id' , Auth::guard('customer')->user()->id)->select('carts.cart_id')->get();
        }

        $brandList = Brand::all();

        return view('customer.contact')->with([
            'brandList'  =>   $brandList, 
            'cartData'  =>  $cartData, 
        ]);
    }

  
}
