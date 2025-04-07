<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * function for registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'userName' => 'required|string|min:4|max:25|unique:users',
            'email' => 'required|string|unique:users',
            'profile_picture' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'pswd' => 'required|min:5|max:25|confirmed',
        ]);
        $imagePath = null;
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profiles'), $imageName);
            $imagePath = $imageName;
            // $image->storeAs('profiles', $imageName, 'public');

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
            return redirect('/user/login')->with('success', 'You are registred sucessfully!');
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
            'userName' => 'required|string|min:4|max:25',
            'pswd' => 'required|string|min:5|max:25',
        ]);
        $user = User::where('userName', $request->userName)->first();
        if (!$user) {
            return redirect()->back()->withErrors('Username ' . $request->userName . ' not found!');
        }
        if ($user && Hash::check($request->pswd, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/user/dashboard')->with('success', 'welcome ' . $user->name);
        } else {
            return redirect('/user/login')->withErrors(['userName' => 'Credentials do not match.']);
        }
    }


    /**
     * Dashboard for user
     */
    public function dashboard() {
        $user = Auth::user();
        return view('user.auth.dashboard', compact('user'));
    }



    /**
     *
     * Edit profile method
     */
    public function editProfilePage() {
        if (!Auth::check()) {
            // return redirect()->route('login')->withErrors(['error','You must have to login first!']);
            throw new NotFoundHttpException();
        }
        $user = Auth::user();
        return view('user.forms.editProfile', compact('user'));
    }


    public function updateProfile(Request $request) {
        $user = Auth::user();
        $request->validate([
            'name' => 'nullable|string|min:5|max:25',
            'userName' => 'nullable|string|min:5|max:25|unique:users,userName,'.$user->id,
            'email' => 'nullable|string|min:5|max:50|unique:users,email,'.$user->id,
            'profile' => 'nullable|file|mimes:jpg,png,jpeg,gif',
        ]);
        //The correct syntax for the unique rule is:
        //unique:<table>,<column>,<ignore_id>

        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        if ($request->filled('userName')) {
            $user->userName = $request->userName;
        }
        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        if ($request->hasFile('profile')) {
            if ($user->profile_picture && File::exists(public_path('profiles/'.$user->profile_picture))) {
                File::delete(public_path('profiles/'.$user->profile_picture));
            }
            $image = $request->file('profile');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('profiles'),$imageName);

            $user->profile_picture = $imageName;
        }
        $user->save();
        return redirect()->route('edit/profile')->with('success','Your personal information is updated successfully!');
    }

    /**
     *
     * Edit password
     */
    public function editPasswordPage() {
        if(!Auth::check()) {
            // return redirect()->route('login')->withErrors(['error','You must have to login first!']);
            throw new NotFoundHttpException();
        }
        return view('user.forms.changePassword');
    }

    public function updatePassword(Request $request) {
        $user = Auth::user();
        // dd($user);
        $request->validate([
            'current_pswd' => 'required|string|min:5|max:25',
            'new_pswd' => 'required|string|min:5|max:25',
        ]);
        if (!Hash::check($request->current_pswd, $user->password)){
            return redirect()->route('change/password')->withErrors(['error' => 'Your current password is incorrect! Try again.']);
            }

            $user->password = Hash::make($request->new_pswd);
            $user->save();
            return redirect()->route('change/password')->with('success','Your password has been changed!');
    }

    /**
     * function for logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/user/login');
    }
}
