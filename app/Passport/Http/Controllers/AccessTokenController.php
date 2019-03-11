<?php

namespace App\Passport\Http\Controllers;

use App\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response as Psr7Response;
use League\OAuth2\Server\AuthorizationServer;
use Illuminate\Support\Facades\Cache;

class AccessTokenController
{
    use HandlesOAuthErrors;

    /**
     * The authorization server.
     *
     * @var \League\OAuth2\Server\AuthorizationServer
     */
    protected $server;

    /**
     * The token repository instance.
     *
     * @var \App\Passport\TokenRepository
     */
    protected $tokens;

    /**
     * The JWT parser instance.
     *
     * @var \Lcobucci\JWT\Parser
     */
    protected $jwt;

    /**
     * Create a new controller instance.
     *
     * @param  \League\OAuth2\Server\AuthorizationServer $server
     * @param  \App\Passport\TokenRepository $tokens
     * @param  \Lcobucci\JWT\Parser $jwt
     * @return void
     */
    public function __construct(AuthorizationServer $server,
                                TokenRepository $tokens,
                                JwtParser $jwt)
    {
        $this->jwt = $jwt;
        $this->server = $server;
        $this->tokens = $tokens;
    }

    /**
     * Authorize a client to access the user's account.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request
     * @return \Illuminate\Http\Response
     */
    public function issueToken(ServerRequestInterface $request)
    {
        $response = $this->withErrorHandling(function () use ($request) {
            return $this->server->respondToAccessTokenRequest($request, new Psr7Response);
        });

        if ($response->getStatusCode() < 200 || $response->getStatusCode() > 299) {
            return $response;
        }

//        $payload = json_decode($response->getBody()->__toString(), true);
//
//        if (isset($payload['access_token'])) {
//            $tokenId = $this->jwt->parse($payload['access_token'])->getClaim('jti');
//            $token = $this->tokens->find($tokenId);
//
//            $this->revokeOrDeleteAccessTokens($token, $tokenId);
//
//        }

        return $response;
    }
//TODO удалить вроде можно
//    /**
//     * Create and configure a Password grant instance.
//     *
//     * @return \League\OAuth2\Server\Grant\PasswordGrant
//     */
//    private function makePasswordGrant()
//    {
//        $grant = new \League\OAuth2\Server\Grant\PasswordGrant(
//            app()->make(\App\Passport\Bridge\UserRepository::class),
//            app()->make(\App\Passport\Bridge\RefreshTokenRepository::class)
//        );
//
//        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());
//
//        return $grant;
//    }


}
