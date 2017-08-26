<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Storage;
use File;

class UserController extends Controller
{
    //
    
    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:120|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|max:120'
        ]);
    	$username = $request['username'];
    	$email = $request['email'];
    	$password = bcrypt($request['password']);

    	$user = new User();
		$user->username = $username;
		$user->email = $email;
		$user->password = $password;
		$user->save();

        Auth::login($user);
		return redirect()->route('dashboard');
    }

    public function postSignIn(Request $request)
    {
         $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            return redirect()->route('dashboard');
        }
        else
            return redirect()->back();
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function getAccount()
    {
        return view('account', [ 'user' => Auth::user() ]);
    }

    public function postSaveAccount(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:120'
        ]);

        $user = Auth::user();
        $user->username = $request['username'];
        $user->update();

        $file = $request->file('image');
        $filename = $user->id . '.jpg';

        if($file)
        {
            Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()->route('account');
    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
}