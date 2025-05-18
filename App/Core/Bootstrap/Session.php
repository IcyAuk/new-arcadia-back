<?php

namespace App\Core\Bootstrap;

class Session
{
    public static function start(): void
    {
        session_set_cookie_params([
            'secure' => false,
            'httponly' => false,
            'samesite' => 'None'
        ]);
        session_start();
        session_regenerate_id(true);
    }
}
