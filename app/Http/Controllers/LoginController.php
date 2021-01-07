<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class LoginController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user.name' => 'required',
            'user.email' => 'required|email',
            'user.password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        $userName =  $request->input('user.name');
        $passWord =  $request->input('user.password');
        $isMatch = $this->user->checkLogin($userName, $passWord);
        if($isMatch) {
            $request->session()->put('login', true);
            return redirect()->route('getLogin')->with('status', 'Login successfully!');
        }
        return redirect()->back()->withErrors('Username or password is not matched');
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('getLogin');
    }
}
