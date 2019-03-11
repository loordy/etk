<?php

namespace App\Passport;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Passport\Client
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string $secret
 * @property string $redirect
 * @property bool $personal_access_client
 * @property bool $password_client
 * @property bool $revoked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Passport\AuthCode[] $authCodes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\Client wherePasswordClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\Client wherePersonalAccessClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\Client whereRedirect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\Client whereRevoked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\Client whereSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\Client whereUserId($value)
 * @mixin \Eloquent
 */
class Client extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'oauth_clients';

    /**
     * The guarded attributes on the model.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'grant_types' => 'array',
        'personal_access_client' => 'bool',
        'password_client' => 'bool',
        'revoked' => 'bool',
    ];

    /**
     * Get all of the authentication codes for the client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authCodes()
    {
        return $this->hasMany(Passport::authCodeModel(), 'client_id');
    }

    /**
     * Get all of the tokens that belong to the client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokens()
    {
        return $this->hasMany(Passport::tokenModel(), 'client_id');
    }

    /**
     * Determine if the client is a "first party" client.
     *
     * @return bool
     */
    public function firstParty()
    {
        return $this->personal_access_client || $this->password_client;
    }
}
