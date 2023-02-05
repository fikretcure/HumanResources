<?php

namespace App\Helpers;

/**
 *
 */
class RequestMerge
{


    /**
     * @param $bearrer
     * @param $refresh
     * @return void
     */
    public function addToken($bearrer, $refresh): void
    {
        request()->merge([
            'bearrer' => $bearrer,
            'refresh' => $refresh,
        ]);
    }
}
