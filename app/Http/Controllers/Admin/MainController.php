<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Rate;

class MainController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password.' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/dashboard')->with('success', 'Login Successfully.');
        }

        return redirect()->back()->with('unsucces','These credentials do not match our records!');
    }

    public function dashboard()
    {
        $totalUsers  = User::where('role', 0 )->count();
        $totalProducts  = Product::count();
        $totalBrands  = Brand::count();
        $totalSubAdmin = User::where('role', 2 )->count();
        $recentRateData = Rate::join('products', 'rates.product_id', '=', 'products.product_id')->orderBy('rates.created_at', 'desc')->take(5)->select('products.item_name', 'rates.rate_count')->get();


        return view('admin.dashboard')->with([
            'totalUsers'  =>  $totalUsers, 
            'totalProducts'  =>  $totalProducts, 
            'totalBrands'  =>  $totalBrands, 
            'totalSubAdmin'  =>  $totalSubAdmin, 
            'recentRateData'  =>  $recentRateData, 
        ]);
    }

    public function logout()
    {
        Auth::guard()->logout();
        request()->session()->invalidate();
        //Regenerate session token to prevent session fixation attacks
        request()->session()->regenerateToken();

        return redirect('/admin/login')->with('message', 'Successfully logged out');
    }

}
