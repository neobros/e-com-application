<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserManagementController extends Controller
{

    public function userList()
    {
        $userList = User::where('role', 0 )->get();
        return view('admin.userManagement.userList')->with([
            'userList'  =>  $userList, 
        ]);
    }

    public function deactivateUserList()
    {
        $userList = User::where('role', 0 )->where('status', 0 )->get();
        return view('admin.userManagement.deactivateUserList')->with([
            'userList'  =>  $userList, 
        ]);
    }

    public function cngStatus($id , $status)
    {   
        $update = [
            'status' => $status,
        ];
        User::where('id',$id)->update($update);
        return redirect()->back()->with('success', 'Status Change Successfully.');
    }

    public function userDelete($id)
    {   
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'User Delete Successfully.');
    }

    public function userEdit($id)
    {
        $userData = User::where('id', $id)->where('role', 0 )->first();

        return view('admin.userManagement.userEdit')->with([
            'userData'  =>  $userData, 
        ]);
    }

    public function updateUser(Request $request)
    {   
        $update = [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'contact' => $request->contact,
        ];
        User::where('id', $request->id)->update($update);

        return redirect('/admin/userManagement/userList')->with('success', 'Details Change Successfully.');
    }

}
