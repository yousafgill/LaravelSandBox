<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use Auth;
use Exception;
use Socialite;

class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            } else {
                
                //Check if Email has already been taken but google_id is not registered yet
                $findemail=User::where('email',$user->email)->first();
                if($findemail){
                    $ID =$findemail->id;
                    $existinguser=User::where('id',$ID)->update([
                    'facebook_id' => $user->id,
                    'registered_with_facebook'=>true,
                    ]);
                    $facebookuser = User::where('facebook_id', $user->id)->first();
                    if($facebookuser){
                        Auth::login($facebookuser);
                        return redirect('/home');
                    }
                }else{
                    $uuid = Str::uuid()->toString();
                    $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'registered_with_facebook'=>true,
                    'password' => Hash::make(encrypt($uuid)),
                    ]);
                    Auth::login($newUser);
                    return redirect('/home');
                }
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}