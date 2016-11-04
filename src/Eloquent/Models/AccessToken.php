<?php

namespace Nord\Lumen\OAuth2\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessToken extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'oauth_access_tokens';

    /**
     * @var array
     */
    protected $fillable = [
        'session_id',
        'token',
        'expire_time',
    ];

    /**
     * @return BelongsTo
     */
    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    /**
     * @param string $token
     *
     * @return AccessToken
     */
    public static function findByToken($token)
    {
        return self::where('token', $token)->first();
    }
}
