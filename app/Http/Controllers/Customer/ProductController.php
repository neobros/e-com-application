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
use App\Repositories\UserRepositoryInterface;

class ProductController extends Controller
{
    protected $userRepository;

    // Inject UserRepository
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function productPage($product_id)
    {   
        $productData = $this->userRepository->getProductData($product_id);
        $brandList = $this->userRepository->getBrandList();

        $rateData = null ;
        $cartDetails = null ;
        $cartData = null ;

        if(Auth::guard('customer')->check())  
        {
            $cartDetails = $this->userRepository->getCartDetails($product_id , Auth::guard('customer')->user()->id);
            $cartData =  $this->userRepository->getProductCartData($product_id , Auth::guard('customer')->user()->id);
            $rateData =  $this->userRepository->getRateData(Auth::guard('customer')->user()->id , $product_id);
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
        
        $data = [
            'product_id' => $request->product_id,
            'customer_id' => Auth::guard('customer')->user()->id,
            'storage' => $request->storage,
            'quantity' => $request->quantity,
        ];

        $this->userRepository->addToCart($data);

        return response()->json([
            'success' => 1,
            'message' => 'Item added to your cart successfully!',
        ]);
        
    }

    public function cart()
    {
        $brandList = $this->userRepository->getBrandList();
        $cartData =  $this->userRepository->getCartAndProductData(Auth::guard('customer')->user()->id);

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

        $this->userRepository->updateCartSize($request->cart_id ,$update);
    
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

        $this->userRepository->updateCartSize($request->cart_id ,$update);
        $totalPrice = $this->userRepository->getTotalPrice(Auth::guard('customer')->user()->id);

        return response()->json([
            'success' => 1,
            'message' => 'update successfully!',
            'data' =>  $totalPrice,
        ]);
    }

    public function removeCartRow(Request $request)
    {    
        $this->userRepository->removeCart($request->cart_id);
        $totalPrice = $this->userRepository->getTotalPrice(Auth::guard('customer')->user()->id);

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
        
        $this->userRepository->updateRate( $rateData ,Auth::guard('customer')->user()->id  , $request->product_id );

        return response()->json([
            'success' => 1,
            'message' => 'successfully!',
        ]);
    }
}
