<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HasCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user()->employer_profile;
        //check if user has employer profile and company profile
        if(!$user)
        {
            return redirect('/employer/dashboard')->with('error', 'You need to be associated with a company and update your employer profile before accessing other pages.');
        }

        return $next($request);
    }
}
