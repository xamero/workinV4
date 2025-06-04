<?php

namespace App\Http\Controllers;
use App\Models\AppPersonalProfile;
use Carbon\Carbon;

use App\Models\User;
use Validator;
use Socialite;
use Exception;
use Auth;
use File;
use Image;
use Illuminate\Support\Str;
use Session;


class FbController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->fields([
            'first_name', 'last_name', 'email', 'gender'
        ])->scopes([
            'email'
        ])->redirect();

//        return Socialite::driver('facebook')->redirect();
    }

    public function facebookSignin()
    {
        try {

            $user = Socialite::driver('facebook')->fields([
                'name',
                'first_name',
                'last_name',
                'middle_name',
                'picture',
                'email'
            ])->user();

            $facebookId = User::where('facebook_id', $user->id)->first();
            $emailId = User::where('email', $user->email)->first();

            if($facebookId){
                Auth::login($facebookId);
                return redirect('/dashboard');
            }elseif($emailId){
                $emailId->facebook_id = $user->id;
                $emailId->save();
                Auth::login($emailId);
                return redirect('/dashboard');
            } else{
                $email = $user->id;
                if($user->email != null){
                    $email = $user->email;
                }

                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $email,
                    'email_verified_at' => Carbon::now()->toDateTimeString(),
                    'facebook_id' => $user->id,
                    'password' => encrypt('JesusChrist')
                ]);

                $createUser->assignRole('Applicant');
                $facebookId = User::where('facebook_id', $user->id)->first();
                Auth::login($facebookId);
//                Auth::login($createUser);

//              create profile
                $personal = new AppPersonalProfile();
                $personal->user_id = $createUser->id;
                $personal->firstname = $user->user['first_name'];
                $personal->surname = $user->user['last_name'];
                $personal->save();


                if ($user->avatar_original) {
                    $code = Str::random(15);
                    $article_storage = public_path() . '/profilepictures/picture/' . $personal->id;

                    if (!File::exists($article_storage)) {
                        File::makeDirectory($article_storage, 0755, true);
                    }else{
                        File::deleteDirectory($article_storage);
                        File::makeDirectory($article_storage, 0755, true);
                    }

                    $personal->profile_picture_path = '/profilepictures/picture/' . $personal->id . '/' . $code;
                    $personal->save();

                    $img = Image::make($user->avatar_original);
                    $filename_prefix = $code;

                    $img->resize(320, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->interlace()->save($article_storage . '/' . $filename_prefix . '.jpg');
                }

                return redirect('/dashboard');
            }

        } catch (Exception $exception) {

//            dd($exception->getMessage());
            Session::flash("error", "Ooops, something went wrong and we can't log you in with your facebook account.
            It is possible that the email associated with your account has already been used to register before.
            If you forgot the password, please click the forgot password? facility to recover your account.");
            return redirect('login');
       }
    }
}

