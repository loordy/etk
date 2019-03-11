<?php

namespace App\Passport;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Passport\AuthCode
 *
 * @property-read \App\Passport\Client $client
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\AuthCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\AuthCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\AuthCode query()
 * @mixin \Eloquent
 */
class AuthCode extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'oauth_auth_codes';

    /**
     * The guarded attributes on the model.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'revoked' => 'bool',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the client that owns the authentication code.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Passport::clientModel());
    }
}
