<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminManagementController extends Controller
{
    public function addAdmin()
    {
        return view('admin.adminManagement.addAdmin');
    }

    public function storeAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    

        $userControlStatus = $request->has('userControl') ? 1 : 0;
        $productControlStatus = $request->has('productControl') ? 1 : 0;

        User::create([
            'fname' => $request->fname,
            'email' => $request->email,
            'role' => 2,
            'password' => Hash::make($request->password),
            'user_permissions' => $userControlStatus,
            'product_permissions' =>$productControlStatus,
        ]);
    
        return redirect()->back()->with([
            'success'  =>  'Sub admin added successfully.', 
        ]);
    }

    public function adminList()
    {
        $adminList = User::where('role', 2 )->get();

        return view('admin.adminManagement.adminList')->with([
            'adminList'  =>  $adminList, 
        ]);
    }

    
    public function cngPermission($type,$id,$status)
    {   
        if($type == 'user_permissions')
        {
            $update = [
                'user_permissions' => $status,
            ];
        }else
        {
            $update = [
                'product_permissions' => $status,
            ];
        }
       
        User::where('id',$id)->update($update);

        return redirect()->back()->with('success', 'Permission Change Successfully.');
    }
}
