<?php

namespace App\Passport;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Passport\PersonalAccessClient
 *
 * @property-read \App\Passport\Client $client
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\PersonalAccessClient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\PersonalAccessClient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Passport\PersonalAccessClient query()
 * @mixin \Eloquent
 */
class PersonalAccessClient extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'oauth_personal_access_clients';

    /**
     * The guarded attributes on the model.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get all of the authentication codes for the client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Passport::clientModel());
    }
}
