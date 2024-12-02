<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Rate;
use DB;

class ProductController extends Controller
{
    public function productPage($product_id)
    {
        $productData = Product::join('brands', 'products.brand_id', '=', 'brands.brand_id')->where('products.status',1)->where('product_id',$product_id)->select('products.*', 'brands.brand_name')->first();
        $brandList = Brand::all();

        $rateData = null ;
        $cartDetails = null ;
        $cartData = null ;

        if(Auth::guard('customer')->check())  
        {
            $cartDetails = Cart::where('product_id' , $product_id)->where('customer_id' , Auth::guard('customer')->user()->id)->get();
            $cartData =  Cart::join('products', 'carts.product_id', '=', 'products.product_id')->where('carts.customer_id' , Auth::guard('customer')->user()->id)->get();
            $rateData =  Rate::where('customer_id',Auth::guard('customer')->user()->id)->where('product_id',$product_id)->select('rate_count')->first();

        }

        return view('customer.product')->with([
            'brandList'  =>   $brandList, 
            'productData'  =>   $productData, 
            'cartDetails'  =>  $cartDetails, 
            'cartData'  =>  $cartData, 
            'rateData'  =>  $rateData,
        ]);
    }

    public function addToCart(Request $request)
    {
        $data = new Cart([
            'product_id' =>$request->product_id,
            'customer_id' => Auth::guard('customer')->user()->id,  
            'storage' =>$request->storage,
            'quantity' =>$request->quantity,
        ]);

        $data->save();
    
        return response()->json([
            'success' => 1,
            'message' => 'Item added to your cart successfully!',
        ]);
        
    }

    public function cart()
    {
        $brandList = Brand::all();
        $cartData =  Cart::join('products', 'carts.product_id', '=', 'products.product_id')->where('carts.customer_id' , Auth::guard('customer')->user()->id)
        ->select('products.*', 'carts.cart_id' ,'carts.customer_id' ,'carts.storage as cartStorage' ,'carts.quantity as cartsQuantity')->get();

        return view('customer.cart')->with([
            'brandList'  =>   $brandList, 
            'cartData'  =>  $cartData, 
        ]);
    }

    public function updateCartSize(Request $request)
    {
        $update = [
            'storage' => $request->selectedStorage,
        ];

        Cart::where('cart_id',$request->cart_id)->update($update);
    
        return response()->json([
            'success' => 1,
            'message' => 'update successfully!',
        ]);

    }
    public function updateQuantity(Request $request)
    {
        $update = [
            'quantity' => $request->quantity,
        ];

        Cart::where('cart_id',$request->cart_id)->update($update);
    
        $totalPrice = Cart::join('products', 'carts.product_id', '=', 'products.product_id')
        ->where('carts.customer_id', Auth::guard('customer')->user()->id)
        ->select(DB::raw('SUM(carts.quantity * products.sell_price) as totalPrice')) // Calculate total price
        ->value('totalPrice'); // Get the final value directly

        return response()->json([
            'success' => 1,
            'message' => 'update successfully!',
            'data' =>  $totalPrice,
        ]);

    }

    public function removeCartRow(Request $request)
    {
        Cart::where('cart_id', $request->cart_id)->delete();

        $totalPrice = Cart::join('products', 'carts.product_id', '=', 'products.product_id')
        ->where('carts.customer_id', Auth::guard('customer')->user()->id)
        ->select(DB::raw('SUM(carts.quantity * products.sell_price) as totalPrice')) // Calculate total price
        ->value('totalPrice'); // Get the final value directly

        return response()->json([
            'success' => 1,
            'message' => 'Delete successfully!',
            'data' =>  $totalPrice,
        ]);
    }


    public function updateRate(Request $request)
    {
        $rateData = [
            'rate_count' => $request->rate_count,
        ];
        
        Rate::updateOrCreate(
            [
                'customer_id' => Auth::guard('customer')->user()->id,
                'product_id' => $request->product_id,
            ], 
            $rateData
        );
        
        return response()->json([
            'success' => 1,
            'message' => 'successfully!',
        ]);
    }
}
