<?php namespace Nord\Lumen\OAuth2\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class RefreshToken extends Model
{

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'oauth_refresh_tokens';

    /**
     * @var array
     */
    protected $fillable = [
        'access_token_id',
        'token',
        'expire_time',
    ];


    /**
     * @param string $token
     *
     * @return RefreshToken
     */
    public static function findByToken($token)
    {
        return self::where('token', $token)->firstOrFail();
    }
}
