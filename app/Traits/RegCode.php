<?php

namespace App\Traits;

/**
 *
 */
trait RegCode
{
    /**
     * @param $model
     * @return string
     */
    public function generateRegCode($model): string
    {
        $last_id = $model::query()->withTrashed()->max("id") + 1;
        return $model::$reg_code . str_repeat("0", (4 - strlen($last_id))) . $last_id;
    }
}
