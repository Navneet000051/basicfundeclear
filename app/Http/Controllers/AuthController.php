<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.layout.login');
    }

    public function login(Request $request)
    {
        $currentRoute = Route::currentRouteName();
        $request = Request::capture();
        $uri = $request->path();

        // If you want to get only the last segment of the URI (after the last "/")
        $uriName = last(explode('/', $uri));
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (DB::table('users')->where('email', $request->email)->count() > 0) {

           
            $user = DB::table('users')->where('email', $request->email)->first();
            $status = $user->status;

            if ($status == 1) {
                // dd(1);
                if($user->role_id == 1 && $currentRoute=='admin.logindata'){
                if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    Session::flash('success', 'Login successfully.');
                    // dd(1);
                        return redirect()->route('admin.dashboard');
                     
                } else {
                    return redirect()->route($uriName.'.login')->withInput($request->only('email'))->with('error', 'Please enter correct password');
                } 
            }
            else if($user->role_id != 1 && $currentRoute=='user.logindata'){
                // dd(1);
                if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    Session::flash('success', 'Login successfully.');
                    return redirect()->route('admin.userdashboard');
            } else {
                return redirect()->route('admin.login')->withInput($request->only('email'))->withErrors(['password' => 'Please enter correct password']);
            } 
            }
            else{
                // dd(5);
                return redirect()->route($uriName.'.login')->with('warning', 'Unautherized access');
                // return redirect()->route($uriName.'.login')->withInput($request->only('email'))->with('error', 'unautherized');
            }
        }

            else {
                return redirect()->route($uriName.'.login')->withInput($request->only('email'))->withErrors(['email' => 'Your Account is inactive']);
            }
        } else {
            return redirect()->route($uriName.'.login')->withInput($request->only('email'))->with('error', 'Please enter correct email');
        }
    }

    public function registration(Request $request)
    {
        return view('admin.layout.registration');  

    }

    public function registrationdata(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'mobile' => 'required|digits:10'
        ]);
    
        // Attempt to create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), 
            'mobile' => $validatedData['mobile'],
            'role_id' => 2 // Assuming 'role_id' is set to 2 for regular users
        ]);
    
        // Check if user creation was successful
        if ($user) {
            // Redirect to the login page with a success message
            return redirect()->route('admin.login')->with([
                'message' => 'User added successfully!', 
                'status' => 'success'
            ]);
        } else {
            // Redirect back to the registration form with an error message and old input
            return redirect()->back()->withErrors(['error' => 'User not added'])->withInput();
        }
    }
    
    
}
