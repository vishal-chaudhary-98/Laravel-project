<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller
{
    public function adminLogin(Request $request) {
        $request->validate([
            'admin_id' => 'string|required|min:5|max:15',
            'admin_password' => 'string|required|min:5|max:15',
        ]);
        $admin = Admin::where('admin_id', $request->admin_id)->first();
        if (!$admin) {
            return redirect('admin')->withErrors('Admin ID not matched!');
        }
        if(!Hash::check($request->admin_password, $admin->admin_password)) {
            return redirect('admin')->withErrors(['error' => 'Password not match!']);
    }

    Auth::guard('admin')->login($admin);
    return redirect()->route('admin_dashboard')->with([
        'success'=> 'Login successful',
        'admin'=> $admin
    ]);
}

public function adminDashboard (){
    if(!Auth::guard('admin')->check()){
        // return redirect('/admin')->withErrors(['error' => 'You must have to login first!']);
            throw new NotFoundHttpException();
    }
    $admin = Auth::guard('admin')->user();
    $users = User::all();
    return view('admin.authAdmin.dashboard', compact('admin', 'users'));
}

public function viewUsers(Request $request) {
    if (!Auth::guard('admin')->check()){
        // return redirect('/login/admin')->with('message','Login first!');
            throw new NotFoundHttpException();
    }
    $users = User::all();
    return view('admin.authAdmin.view_users', compact('users'));

}

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect ('/admin');
    }
}

