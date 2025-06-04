<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {

        $user = $request->user();

        // Check role and redirect accordingly
        if ($user->hasRole('administrator')) {
           return redirect()->route('administrator.dashboard');
        } elseif ($user->hasRole('applicant')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('employer')) {
            return redirect()->route('employer.dashboard.index');
        } elseif ($user->hasRole('peso')) {
            return redirect()->route('peso.dashboard.index');
        }

        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade

//        return $request->wantsJson()
//            ? response()->json(['two_factor' => false])
//            : redirect()->intended(config('fortify.home'));
    }

}
