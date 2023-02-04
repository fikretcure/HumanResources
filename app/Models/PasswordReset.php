<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class PasswordReset extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'token',
        'email',
        'expired_at'
    ];

    /**
     * @var string[]
     */
    protected $casts=[
        "expired_at" => "datetime"
    ];

    /**
     * @return BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class,"email","email");
    }
}
