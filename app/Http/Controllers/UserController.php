<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * function for registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'userName' => 'required|string|min:4|max:20|unique:users',
            'email' => 'required|string|unique:users',
            'profile_picture' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'pswd' => 'required|min:5|max:10|confirmed',
        ]);
        $imagePath = null;
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profiles'), $imageName);
            $imagePath = $imageName;
        }
        $hashed = Hash::make($request->pswd);
        $user = new User();
        $user->name = $request->name;
        $user->userName = $request->userName;
        $user->email = $request->email;
        $user->profile_picture = $imagePath;
        $user->password = $hashed;
        $registred = $user->save();
        if ($registred) {
            return redirect('/login')->with('success', 'You are registred sucessfully!');
        } else {
            return redirect()->back()->withErrors('Not registred! Try again later');
        }
    }

    /**
     * function for login
     */
    public function login(Request $request)
    {
        $request->validate([
            'userName' => 'required|string|min:4|max:20',
            'pswd' => 'required|string|min:5|max:10',
        ]);
        $user = User::where('userName', $request->userName)->first();
        if (!$user) {
            return redirect()->back()->withErrors('Username ' . $request->userName . ' not found!');
        }
        if ($user && Hash::check($request->pswd, $user->password)) {
            Auth::login($user);
            return redirect('/dashboard')->with('success', 'welcome ' . $user->name);
        } else {
            return redirect('/login')->withErrors(['userName' => 'Credentials do not match.']);
        }
    }

    /**
     *
     * Edit profile method
     */
    public function editProfile() {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error','You must have to login first!']);
        }
        return view('user.forms.editProfile');
    }

    /**
     *
     * Edit password
     */
    public function editPassword() {
        if(!Auth::check()) {
            return redirect()->route('login')->withErrors(['error','You must have to login first!']);
        }
        return view('user.forms.changePassword');
    }


    /**
     * function for logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
