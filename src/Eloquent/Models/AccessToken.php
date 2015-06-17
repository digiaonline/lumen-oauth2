<?php namespace Nord\Lumen\OAuth2\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

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
     * @param string $token
     *
     * @return AccessToken
     */
    public static function findByToken($token)
    {
        return self::where('token', $token)->first();
    }
}
