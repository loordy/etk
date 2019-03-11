<?php

namespace App\Passport\Bridge;

use Illuminate\Database\Connection;
use Illuminate\Contracts\Events\Dispatcher;
use App\Passport\Events\RefreshTokenCreated;
use Illuminate\Support\Facades\Cache;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use Carbon\Carbon;
use App\Passport\Passport;

class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{
    /**
     * The access token repository instance.
     *
     * @var \App\Passport\Bridge\AccessTokenRepository
     */
    protected $tokens;

    /**
     * The database connection.
     *
     * @var \Illuminate\Database\Connection
     */
    protected $database;

    /**
     * The event dispatcher instance.
     *
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    protected $events;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Passport\Bridge\AccessTokenRepository  $tokens
     * @param  \Illuminate\Database\Connection  $database
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function __construct(AccessTokenRepository $tokens,
                                Connection $database,
                                Dispatcher $events)
    {
        $this->events = $events;
        $this->tokens = $tokens;
        $this->database = $database;
    }

    /**
     * {@inheritdoc}
     */
    public function getNewRefreshToken()
    {
        return new RefreshToken;
    }

    /**
     * {@inheritdoc}
     */
    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {
        Cache::tags(['refresh_tokens'])->add($id = $refreshTokenEntity->getIdentifier(),$accessTokenId = $refreshTokenEntity->getAccessToken()->getIdentifier(),Passport::refreshTokensExpireIn());
        $this->events->fire(new RefreshTokenCreated($id, $accessTokenId));
    }

    /**
     * {@inheritdoc}
     */
    public function revokeRefreshToken($tokenId)
    {
        Cache::tags(['refresh_tokens'])->forget($tokenId);
    }

    /**
     * {@inheritdoc}
     */
    public function isRefreshTokenRevoked($tokenId)
    {
        $refreshToken = Cache::tags(['refresh_tokens'])->get($tokenId);

        if ($refreshToken === null) {
            return true;
        }

        return false;
    }
}
