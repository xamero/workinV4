<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Exception;
use App\Models\User;
use Session;

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
            $emailId = User::where('email', $user->email)->first();



            if($finduser){
                Auth::login($finduser);
                if ($finduser->hasRole('employer')) {
                    return redirect()->route('employer.dashboard.index');
                } elseif ($finduser->hasRole('peso')) {
                    return redirect()->route('peso.dashboard.index');
                }
                return redirect('/dashboard');
            }elseif($emailId){
                $emailId->google_id = $user->id;
                $emailId->save();
                Auth::login($emailId);
                if ($emailId->hasRole('employer')) {
                    return redirect()->route('employer.dashboard.index');
                } elseif ($emailId->hasRole('peso')) {
                    return redirect()->route('peso.dashboard.index');
                }
                return redirect('/dashboard');
            } else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'email_verified_at' => Carbon::now()->toDateTimeString(),
                    'password' => encrypt('JesusChrist')
                ]);

                $newUser->assignRole('Applicant');
                Auth::login($newUser);
                return redirect('/dashboard');
            }

        } catch (Exception $exception) {

            Session::flash("error", "Ooops, something went wrong and we can't log you in with your facebook account.
            It is possible that the email associated with your account has already been used to register before.
            If you forgot the password, please click the forgot password? facility to recover your account.");
            return redirect('login');
        }
    }
}
