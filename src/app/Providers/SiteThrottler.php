<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class SiteThrottler
{
    const THROTTLE_API = 100;
    const THROTTLE_API_USER = 200;

    const THROTTLE_GLOBAL = 100;
    const THROTTLE_GLOBAL_USER = 200;

    const THROTTLE_LOGIN = 25;

    const THROTTLE_AUTHENTICATE = 15;

    public static function configure() : void
    {
        RateLimiter::for('api', function (Request $request) {
            $user = $request->user();

            return $user
                ?  Limit::perMinute(SiteThrottler::THROTTLE_API_USER)->by($user->id)
                :  Limit::perMinute(SiteThrottler::THROTTLE_API)->by($request->ip());
        });

        RateLimiter::for('global', function (Request $request) {
            $user = $request->user();

            return $user
                ?  Limit::perMinute(SiteThrottler::THROTTLE_GLOBAL_USER)->by($user->id)
                :  Limit::perMinute(SiteThrottler::THROTTLE_GLOBAL)->by($request->ip());
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(SiteThrottler::THROTTLE_LOGIN)->by($request->ip());
        });

        RateLimiter::for('authenticate', function (Request $request) {
            return Limit::perMinute(SiteThrottler::THROTTLE_AUTHENTICATE)->by($request->ip());
        });
    }
}