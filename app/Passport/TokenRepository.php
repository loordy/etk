<?php

namespace App\Passport;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class TokenRepository
{
    /**
     * Creates a new Access Token.
     *
     * @param  array  $attributes
     * @return \App\Passport\Token
     */
    public function create($attributes)
    {
        return Cache::tags([$attributes['client_id']])->add($attributes['id'],$attributes['user_id'],Passport::tokensExpireIn());
        //return Passport::token()->create($attributes);
    }

    /**
     * Get a token by the given ID.
     *
     * @param  string  $client_id
     * @param  string  $id
     * @return \App\Passport\Token
     */
    public function find($client_id, $id)
    {
        return Cache::tags([$client_id])->get($id);
//        $value = Cache::remember($id, 2, function () use ($id){
//            return Passport::token()->where('id', $id)->first();
//        });
//        return $value;
    }

    /**
     * Get a token by the given user ID and token ID.
     *
     * @param  string  $id
     * @param  int  $userId
     * @return \App\Passport\Token|null
     */
    public function findForUser($id, $userId)
    {
        return Passport::token()->where('id', $id)->where('user_id', $userId)->first();
    }

    /**
     * Get the token instances for the given user ID.
     *
     * @param  mixed  $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function forUser($userId)
    {
        return Passport::token()->where('user_id', $userId)->get();
    }

    /**
     * Get a valid token instance for the given user and client.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $user
     * @param  \App\Passport\Client  $client
     * @return \App\Passport\Token|null
     */
    public function getValidToken($user, $client)
    {
        return $client->tokens()
                    ->whereUserId($user->getKey())
                    ->whereRevoked(0)
                    ->where('expires_at', '>', Carbon::now())
                    ->first();
    }

    /**
     * Store the given token instance.
     *
     * @param  \App\Passport\Token  $token
     * @return void
     */
    public function save(Token $token)
    {
        $token->save();
    }

    /**
     * Revoke an access token.
     *
     * @param  string  $id
     * @return mixed
     */
    public function revokeAccessToken($id)
    {
        //return Passport::token()->where('id', $id)->update(['revoked' => true]);
        return true;
    }

    /**
     * Check if the access token has been revoked.
     *
     * @param  string  $id
     *
     * @return bool Return true if this token has been revoked
     */
    public function isAccessTokenRevoked($id)
    {
        if ($token = $this->find($id)) {
            return $token->revoked;
        }

        return true;
    }

    /**
     * Find a valid token for the given user and client.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $user
     * @param  \App\Passport\Client  $client
     * @return \App\Passport\Token|null
     */
    public function findValidToken($user, $client)
    {
        return $client->tokens()
                      ->whereUserId($user->getKey())
                      ->whereRevoked(0)
                      ->where('expires_at', '>', Carbon::now())
                      ->latest('expires_at')
                      ->first();
    }
}
