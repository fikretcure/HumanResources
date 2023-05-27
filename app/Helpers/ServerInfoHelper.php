<?php

namespace App\Helpers;

use Stevebauman\Location\Facades\Location;

/**
 *
 */
class ServerInfoHelper
{
    /**
     *
     */
    public function __construct()
    {

    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'remote_addr' => request()->server("REMOTE_ADDR"),
            'server_addr' => request()->server("SERVER_ADDR"),
            'http_user_agent' => request()->server("HTTP_USER_AGENT"),
            'location' => json_encode(Location::get(request()->ip())),
        ];
    }
}
