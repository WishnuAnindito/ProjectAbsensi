<?php
namespace App\Libraries;
use Illuminate\Support\ServiceProvider;

class HashServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //        $this->app['hash'] = $this->app->share(function () {
        //            return new MD5Hasher();
        //        });
                $this->app->singleton('hash', function () {
                    return new MD5Hasher();
                });
            }
            /**
             * Get the services provided by the provider.
             *
             * @return array
             */
            public function provides() {
                return array('hash');
            }
}