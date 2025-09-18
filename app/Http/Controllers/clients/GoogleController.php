<?php

namespace App\Http\Controllers\clients;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
          
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
        
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
         
            if($finduser){
         
                Auth::login($finduser);
                return redirect()->route('home');
         
            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'userName' => $user->name,
                        'google_id'=> $user->id,
                        'passWord' => encrypt('123456dummy')
                    ]);
         
                Auth::login($newUser);
        
                return redirect()->route('home');
            }
        
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
