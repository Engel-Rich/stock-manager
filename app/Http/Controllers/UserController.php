<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function signIn(Request $request)
    {
        try {
            // dd($request->all());
            $request->validate([
                'user_name' => 'string|required',
                'password' => 'required|min:6'
            ]);
            
            $credential = ["user_name" => $request->user_name, 'password'=>$request->password];
            if (Auth::attempt($credential)) {
                $request->session()->regenerate();
                return redirect()->intended(route('article.index'));
            }
            return to_route('auth.login')->withErrors([
                'user_name' => "Nom d'utilisateur ou mot de passe incorrecte",
            ])->onlyInput('user_name');
        } catch (\Throwable $th) {
            // dd($th);
            return to_route('auth.login')->withErrors([
                'error' => $th->getMessage(), 
            ])->onlyInput('user_name');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $request->validate([
                'user_name' => 'string|required|unique:users',
                'password' => 'required|min:6',
                'email' => 'unique:users,email',
                'name' => 'required|string',              
            ]);
            $userData = $request->all();
            $userData['password'] = Hash::make($request->password);                                
            User::create($userData);
            $credential  = $request->only('user_name', "password");
            if (Auth::attempt($credential)) {
                $request->session()->regenerate();
                // dd($request->session());
                return redirect()->intended(route('article.index'));
            }
            return to_route('auth.register')->withErrors([])->onlyInput('user_name', 'name', 'email', 'phone');
        } catch (\Throwable $th) {
            // dd($th);
            return to_route('auth.register')->withErrors(['error' => $th->getMessage()])->onlyInput('user_name', 'name', 'email', 'phone');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');

    }
}



// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;


// class UserController extends Controller
// {
    
// }
