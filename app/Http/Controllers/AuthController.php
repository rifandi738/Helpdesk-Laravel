<?php

namespace App\Http\Controllers;
use App\User;
use Mail;
use Alert;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        // dd(\);
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!\Auth::attempt(['username' => $request->username,
         'password' => $request->password])) {
            Alert::warning('Username Atau Password Salah');
            return redirect()->route('login');
        }

        // dd($request);
        return redirect()->route('dashboard.index');
    }

    public function logout(){

        \Auth::logout();

        return redirect()->route('login');
    }

    public function reset ()
    {
        return view('auth.email');
    }



    public function reset_password(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        $username = $request->email;
        $user = User::where('username',$username)->first();
        $check_user = User::where('username',$username)->count();
        if($check_user > 0){
            try {
                Mail::send('auth.send_email', ['user' => $user], function ($message) use ($request){
                    $message->subject('Reset Password');
                    $message->from('fidi@gmail.com','Fidi IT Kreatif');
                    $message->to($request->email);
                });
                // Alert::success('Berhasil Kirim Email, Silahkan Cek Email');
                // return redirect()->route('login');
                return redirect()->route('login')->withSuccess('Berhasil Kirim Email, Silahkan Cek Email');
            }
            catch (Exception $e) {
                return response (['status' => false,'errors' => $e->getMessage()]);
            }
            
        }else{
            Alert::warning('Email Tidak Terdaftar');
            return redirect()->route('reset');
        }
    }

    public function password_confirm($id)
    {
        $user = User::find($id);
        return view('auth.reset',compact('user'));

    }

    public function confirm_password(Request $request,$id)
    {
        $this->validate($request, [
            'password' => 'min:6|same:confirm_password',
            'confirm_password' => 'min:6'
        ]);
        $data = User::findOrFail($id);
        // dd($data);
        $data->update([
            'password' => bcrypt($request['password'])
        ]);

        return redirect()->route('login')->withSuccess('Reset Password Berhasil, Silahkan Login');
    }

   


}
