<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CustomAuthController extends Controller
{

    public function index()
    {
        
        return view('index');
    }  
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],
         [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',

        ]


    );
        $credentials = $request->only('email', 'password');
         if ($credentials['email']=='user@dreamstechnologies.com' && $credentials['password']=='123456'){
        return redirect()->intended('deals-dashboard')
                        ->withSuccess('Signed in');
        }
        if (Auth::attempt($credentials)) {
            return redirect()->intended('deals-dashboard')
                        ->withSuccess('Signed in');
        }
        return redirect("index")->withErrors('These credentials do not match our records.');
    }
    public function registration()
    {
        return view('register');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ],
        [
            'name.required' => 'Username is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'confirm_password.required' => 'Confirm Password is required',
        ]

    );
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("index")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('deals-dashboard');
        }
  
        return redirect("index")->withSuccess('You are not allowed to access');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('index');
    }
}