<?php

namespace App\Core\Common\Providers;

use App\Core\User\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Dusterio\LumenPassport\LumenPassport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        LumenPassport::routes($this->app, ['prefix' => 'api/v1/auth']);
        LumenPassport::allowMultipleTokens();
    }
}
