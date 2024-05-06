<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class AuthController extends Controller
{
    use SendsPasswordResetEmails;
    public function __construct()
    {

    }

    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email'
        ]);
        return $request->all();
    }


    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginStore(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            Cache::forget('locWiseAuthUserInfo');
            return redirect()->intended('/admin/dashboard');
            //return Redirect::route('admin.dashboard');
        }elseif (Auth::guard('admin')->attempt(['username' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            Cache::forget('locWiseAuthUserInfo');
            return redirect()->intended('/admin/dashboard');
        }
        Session::flash('error', "email or password does not match");
        return back()->withInput($request->only('email', 'remember'));
    }

    public function changePassword(Request $request, $id)
    {
        //$this->authorize('change_password',Admin::class);
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);
        
        try {
            $data['password'] = Hash::make($request->password);
            Admin::findOrFail($id)->update($data);
        } catch (\Throwable $exception) {
            return back()->with([
                //'error' => __('admin.common.error'),
                'error' => $exception->getMessage(),
                'alert-type' => 'error'
              ]);
        }

        return back()->with([
            'message' => __('admin.common.success'),
            'alert-type' => 'success'
        ]);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function logout(Request $request)
    {
        //return "Hello";
        //Auth::guard('web')->logout();
        $this->guard('admin')->logout();
        //$request->session()->invalidate();
        //$request->session()->regenerateToken();
        return redirect('admin/login');
    }

    

}
