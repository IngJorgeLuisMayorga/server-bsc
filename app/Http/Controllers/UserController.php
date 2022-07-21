<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use DB;
use Str;
use Log;
use App\Mail\RecoveryPasswordMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class UserController extends Controller {

    public function getAll(Request $request) {
        $users = User::all();
        return json_encode($users);
    }
    public function getById(Request $request, $id) {
        $user = User::where('id' , '=' , $id)->first();
        return json_encode($user);
    }
    public function getByIds(Request $request, $ids) {
        $users = User::whereIn('id', explode(',', $ids))->get();
        return json_encode($users);
    }
    public function add(Request $request) {
        $user = new User;
        $data = $request->only($user->getFillable());
        $user->fill($data);
        $user->fill([
            'password' => Hash::make($request->password),
            'birthdate' =>  Carbon::parse($request->birthdate),
            'signin_at' =>  Carbon::parse($request->signin_at)
        ])->update();
        $user->save();
        return json_encode($user);
    }
    public function update(Request $request, $id) {
        $user = User::where('id' , '=' , $id)->first();
        $data = $request->only($user->getFillable());
        $user->fill($data);
        $user->save();
        return json_encode($user);
    }
    public function remove(Request $request, $id) {
        $user = User::where('id' , '=' , $id)->first();
        $user->delete();
        return json_encode($user);
    }

    public function signin(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        error_log(' ');
        error_log('signUpByEmail ====> parswowrd  email');
        error_log('$email');
        error_log($email);
        error_log('');
        error_log(' ');
        error_log('$password');
        error_log($password);
        error_log('');

        
        if (Auth::attempt(['email'=>$email,'password'=>$password])) {
            $user = User::where('email', $email)->first();
            return json_encode($user);
        } else {
            abort(404);
        }
    }

}
