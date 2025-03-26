<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function adminLogin(Request $request) {
        $request->validate([
            'admin_id' => 'string|required',
            'admin_password' => 'string|required|max:15',
        ]);
        $admin = Admin::where('admin_id', $request->admin_id);
        if (!$admin) {
            return redirect()->back()->withErrors('Admin ID not matched!');
        }


    }
}
