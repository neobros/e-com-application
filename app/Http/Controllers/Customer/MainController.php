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
use App\Repositories\UserRepositoryInterface;

class MainController extends Controller
{
    protected $userRepository;

    // Inject UserRepository
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function home()
    {  
        $cartData = null ;
        if(Auth::guard('customer')->check())  
        {
            $cartData = $this->userRepository->getCartData(Auth::guard('customer')->user()->id);
        }

        $productList = $this->userRepository->getProductList();
        $brandList = $this->userRepository->getBrandList();

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

        // Use the repository to handle login
        $response = $this->userRepository->login($credentials);

        return response()->json($response, $response['success'] ? 200 : 401);
    }

    public function logout()
    {
        $this->userRepository->logout('customer');
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

        $customer = $this->userRepository->register($request->all());
        Auth::guard('customer')->login($customer);

        return response()->json(['success' => true, 'message' => 'Registered successfully.'], 200);
    }

    public function profile()
    {
        $cartData =  $this->userRepository->getCartData(Auth::guard('customer')->user()->id);
        $brandList = $this->userRepository->getBrandList();
        $userData = $this->userRepository->getSingleUserData(Auth::guard('customer')->user()->id);
  
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

        $this->userRepository->updateUserProfile($update, Auth::guard('customer')->user()->id);

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
            $cartData = $this->userRepository->getCartData(Auth::guard('customer')->user()->id);
        }
        $brandList = $this->userRepository->getBrandList();
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
            $cartData = $this->userRepository->getCartData(Auth::guard('customer')->user()->id);
        }

        $brandList = $this->userRepository->getBrandList();

        return view('customer.contact')->with([
            'brandList'  =>   $brandList, 
            'cartData'  =>  $cartData, 
        ]);
    }

}
