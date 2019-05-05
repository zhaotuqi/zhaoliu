<?php

namespace Library\StateMachine;

use Illuminate\Support\ServiceProvider;

class StateMachine extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private static function getHandle()
    {
        $sock = @stream_socket_client(self::STATEMACHINE_SERVER, $errno, $errstr, 0,
            STREAM_CLIENT_CONNECT|STREAM_CLIENT_ASYNC_CONNECT);

        if (false === $sock) {
            self::$error = "stream_socket_client failed, errno=$errno, error=$errstr";
            return false;
        }
        if (false === stream_set_blocking($sock, false)) {
            self::$error = "stream_set_blocking failed";
            return false;
        }
        if (false === stream_set_timeout($sock, 0, 50)) {   // 0.05 ms
            self::$error = "stream_set_timeout failed";
            return false;
        }
        return $sock;
    }
}
