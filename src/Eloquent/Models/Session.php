<?php namespace Nord\Lumen\OAuth2\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'oauth_sessions';

    /**
     * @var array
     */
    protected $fillable = [
        'client_id',
        'owner_type',
        'owner_id',
        'client_redirect_uri',
    ];


    /**
     * @return Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
