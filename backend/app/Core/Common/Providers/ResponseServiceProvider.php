<?php
namespace App\Core\Common\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Http\ResponseFactory;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('success', function ($data = null, $message = '') use ($factory) {
            $format = [
                'success' => true,
                'message' => $message,
                'data' => $data,
            ];

            return $factory->make($format, 200);
        });

        $factory->macro('error', function ($errors = [], $message = '', $status = 500) use ($factory){
            $format = [
                'success' => false,
                'message' => $message,
                'errors' => $errors,
            ];

            return $factory->make($format, $status);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
