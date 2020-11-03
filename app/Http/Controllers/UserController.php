<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateByUser;
use App\Http\Requests\UpdatePassword;
use App\Http\Requests\UpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function register()
    {
        return view('user.register');
    }

    public function login()
    {
        return view('user.login');
    }
    public function signUp(StoreUser $request,User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = password_hash($request->password,PASSWORD_DEFAULT);
        $user->save();
        return redirect('/login')->with('success','کاربر با موفقیت ثبت نام شد');
    }
    public function signIn(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/');
        } else
        {
            return redirect()->back()->with('warning','نام کاربری یا کلمه عبور اشتباه است');
        }
    }
    public function logout()
    {
        if (Auth::user())
        {
            Auth::logout();
            return redirect('/');
        } else {
            return abort(404);
        }
    }
    public function index()
    {
        $users = User::orderBy('created_at','desc')->get();
        return view('user.index')->with('users',$users);
    }
    public function destroy(User $user)
    {
        //TODO remove posts of the masters if exists
        $user->delete();
    }
    public function edit(User $user)
    {
        return view('user.edit')->with('user',$user);
    }
    public function update(UpdateUser $request,User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->balance = $request->balance;
        $user->save();
        return redirect('/admin/user')->with('success','کاربر با موفقیت ویرایش شد');
    }
    public function account()
    {
        $user = Auth::user();
        $courses = $user->courses;
        return view('user.profile')->with('user',$user)->with('courses',$courses);
    }
    public function editByUser()
    {
        $user = Auth::user();
        return view('user.edit-by-user')->with('user',$user);
    }
    public function editPassword()
    {
        $user = Auth::user();
        return view('user.edit-password')->with('user',$user);
    }
    public function updatePassword(UpdatePassword $request)
    {
        $user = Auth::user();
        //check if the old one is correct
        if (password_verify($request->oldPass,$user->password))
        {
            $user->password = password_hash($request->password,PASSWORD_DEFAULT);
            $user->save();
            return redirect('/')->with('success','رمز عبور با موفقیت ویریاش شد');
        } else {
            return redirect()->back()->with('warning','رمز قبلی صحیح نیست');
        }
    }
    public function updateByUser(UpdateByUser $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();
        return redirect('/')->with('success','کاربر با موفقیت ویرایش شد');
    }

}
