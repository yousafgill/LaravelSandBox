<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Auth;
use Exception;
use Socialite;

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
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            } else {
                
                //Check if Email has already been taken but google_id is not registered yet
                $findemail=User::where('email',$user->email)->first();
                if($findemail){
                    $ID =$findemail->id;
                    $existinguser=User::where('id',$ID)->update([
                    'google_id' => $user->id,
                    'avatar' => $user->avatar,
                    'registered_with_google'=>true,
                    ]);
                    $googleuser = User::where('google_id', $user->id)->first();
                    if($googleuser){
                        Auth::login($googleuser);
                        return redirect('/home');
                    }
                  
                }else{
                    $uuid = Str::uuid()->toString();
                    $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'avatar' => $user->avatar,
                    'registered_with_google'=>true,
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