<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Rate;
use App\Models\Cart;
use DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function getProductList()
    {
        return Product::join('brands', 'products.brand_id', '=', 'brands.brand_id')
                      ->select('products.*', 'brands.brand_name')
                      ->get();
    }

    public function getBrandList()
    {
        return Brand::all();
    }

    public function getCartData($id)
    {
        return Cart::where('carts.customer_id' , $id)->select('carts.cart_id')->get();
    }


    public function getSingleUserData($id)
    {
        return User::where('id', $id )->first();
    }


    public function login(array $credentials)
    {
        if (Auth::guard('customer')->attempt($credentials)) {
            $user = Auth::guard('customer')->user();

            if ($user->status == 0) {
                Auth::guard('customer')->logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();
                return ['success' => false, 'message' => 'Your account is deactivated. Please contact support.'];
            }

            return ['success' => true, 'message' => 'Login successfully.'];
        }

        return ['success' => false, 'message' => 'These credentials do not match our records!'];
    }

    public function logout($role)
    {
        if($role == 'customer' )
        {
            Auth::guard('customer')->logout();
            request()->session()->invalidate();
            //Regenerate session token to prevent session fixation attacks
            request()->session()->regenerateToken();
        }

        return;
    }

    public function register(array $data)
    {
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'contact' => $data['contact'],
            'status' => 1,
            'email' => $data['email'],
            'role' => 0,
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
        ]);
    }

    public function updateUserProfile(array $data, $userId)
    {
        return User::where('id', $userId)->update($data);
    }


    public function getProductData($product_id)
    {
        return Product::join('brands', 'products.brand_id', '=', 'brands.brand_id')->where('products.status',1)->where('product_id',$product_id)->select('products.*', 'brands.brand_name')->first();
    }

    public function getCartDetails($product_id , $customer_id)
    {
        return Cart::where('product_id' , $product_id)->where('customer_id' , $customer_id)->get();
    }
    
    public function getProductCartData($customer_id)
    {
        return Cart::join('products', 'carts.product_id', '=', 'products.product_id')->where('carts.customer_id' , $customer_id)->get();
    }

    public function getRateData($customer_id , $product_id)
    {
        return Rate::where('customer_id',$customer_id)->where('product_id',$product_id)->select('rate_count')->first();
    }

    public function addToCart(array $data)
    {
        $cart = new Cart([
            'product_id' => $data['product_id'],
            'customer_id' => $data['customer_id'],
            'storage' => $data['storage'],
            'quantity' => $data['quantity'],
        ]);
        
        return $cart->save();
    }

    public function getCartAndProductData($customer_id)
    {
        return Cart::join('products', 'carts.product_id', '=', 'products.product_id')->where('carts.customer_id' , $customer_id)
        ->select('products.*', 'carts.cart_id' ,'carts.customer_id' ,'carts.storage as cartStorage' ,'carts.quantity as cartsQuantity')->get();
    }

    public function updateCartSize($cart_id,array $update)
    {
        return Cart::where('cart_id',$cart_id)->update($update);
    }

    public function getTotalPrice($customer_id)
    {
        return  Cart::join('products', 'carts.product_id', '=', 'products.product_id')
        ->where('carts.customer_id', $customer_id)
        ->select(DB::raw('SUM(carts.quantity * products.sell_price) as totalPrice')) 
        ->value('totalPrice'); 
    }

    public function removeCart($cart_id)
    {
        return Cart::where('cart_id', $cart_id)->delete();
    }

    public function updateRate(array $rateData,$customer_id ,$product_id)
    {
        return  Rate::updateOrCreate(
            [
                'customer_id' =>$customer_id,
                'product_id' => $product_id,
            ], 
            $rateData
        );
    }

   

}
