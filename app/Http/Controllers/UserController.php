<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required | max: 120',
            'email' => 'email | required | unique:users',
            'password' => 'required | min: 4'
        ]);

        $email = $request['email'];
        $first_name = $request['firstname'];
        $password = bcrypt($request['password']);

        $user = New User();
        $user->email = $email;
        $user->first_name = $first_name;
        $user->password = $password;

        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required ',
            'password' => 'required '
        ]);

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }

    public function getLogout()
    {
        Auth::Logout();
        return redirect()->route('home');
    }

    public function getAccount()
    {
        return view('account', ['user' => Auth::user()]);
    }

    public function postAccountEdit(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:120'
        ]);

        $user = Auth::user();
        $oldname = $user->first_name;
        $user->first_name = $request['first_name'];
        $user->update();

        $file = $request->file('image');
//        if($oldname != $user->first_name) {
//            if ($file) {
//                $oldfilename = download($user->first_name . '-' . $user->id . '.jpg'))$oldname . '-' . $user->id . '.jpg';
//                Storage::disk('local')->put($oldfilename,File::get($file));
//            }
        $filename = $request['first_name'] . '-' . $user->id . '.jpg';
        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()->route('account');
//        }
    }

    public function getAccountImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return response($file, 200);
    }
}