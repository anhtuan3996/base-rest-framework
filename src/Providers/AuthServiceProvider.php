<?php

namespace Si6\Base\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Si6\Base\AccessTokenGuard;
use Si6\Base\Services\AuthService;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Auth::extend('access_token', function () {
            $request = app('request');

            /** @var AuthService $authService */
            $authService = app(AuthService::class);

            $user = $authService->authenticate($request);

            return new AccessTokenGuard($user);
        });
    }
}