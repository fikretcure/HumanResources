<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Token extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        "user_id",
        "bearrer",
        "bearrer_expired_at",
        "refresh",
        "refresh_expired_at"
    ];

    protected $casts = [
        "bearrer_expired_at" => "datetime",
        "refresh_expired_at" => "datetime",
    ];
}
