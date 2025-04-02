<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminLogin(Request $request) {
        $request->validate([
            'admin_id' => 'string|required|min:5|max:15',
            'admin_password' => 'string|required|min:5|max:15',
        ]);
        $admin = Admin::where('admin_id', $request->admin_id)->first();
        if (!$admin) {
            return redirect()->back()->withErrors('Admin ID not matched!');
        }
        return view('admin.authAdmin.dashboard', compact('admin'));
    }

    // public function register(Request $request) {
    //     // dd($request);
    //     $request->validate ([
    //         'admin_id' => 'required|string|min:5|max:15',
    //         'admin_password' => 'required|string|min:5|max:15',
    //     ]);
    //     $admin = new Admin();
    //     $admin->admin_id = $request->admin_id;
    //     $admin->admin_password = Hash::make($request->admin_password);
    //     if ($admin->save()) {
    //         return redirect()->route('admin')->with('success','Admin registred sucessfully!');
    //     }
    //     return redirect()->route('admin')->withErrors(['error' , 'admin not registred']);
    //  }
}
