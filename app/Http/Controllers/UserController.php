<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function saveUser(Request $request){
        //Log::info(json_encode($request->all()));
        //digits:10
        //in:S,M,L,XL

        $validated = $request->validate(
            [
                'name' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email_address' => 'required',
                'email' => 'required',
                'password' => 'required',
                'phone_number' => 'nullable'
            ],
        );

        $user = User::create($validated);

        $user['remember_token']= Str::random(10);
        $user['email_verified_at']= now();
        $user['password']=bcrypt($user['password']);
        //Log::info('User');
        //Log::info(json_encode($user));
        $user->save();

        return redirect()->route('home');
    }

    public function indexUser(Request $request){
        $users = User::all()->slice(-5)->reverse();
        return  view('/users', [
            'users' => $users,
        ]);
    }

    public function index(User $user){
        //Log::info($user);
        $users = User::all();
        //Log::info($users);
        $user = $users->search(function($user) {
            return $user->id === 5;
        });
        $user=$users[$user];
        return view('user',[
            'user'=>$user,
        ]);
    }
}
