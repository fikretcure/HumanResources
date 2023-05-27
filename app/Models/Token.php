<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Token extends Model
{
    use HasFactory;


    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'token',
        'remote_addr',
        'server_addr',
        'http_user_agent',
        'type',
        'location',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'token' => 'hashed'
    ];

}
