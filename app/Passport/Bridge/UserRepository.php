<?php

namespace App\Passport\Bridge;

use RuntimeException;
use Illuminate\Hashing\HashManager;
use Illuminate\Contracts\Hashing\Hasher;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use App\Models\v2\User as BaseUser;

/**
 * Class UserRepository
 * @package App\Passport\Bridge
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * The hasher implementation.
     *
     * @var \Illuminate\Hashing\HashManager
     */
    protected $hasher;


    /**
     * @var User
     */
    protected $user;

    /**
     * Create a new repository instance.
     *
     * @param  \Illuminate\Hashing\HashManager $hasher
     * @param User $users
     */
    public function __construct(HashManager $hasher, BaseUser $users)
    {
        $this->hasher = $hasher->driver();
        $this->user = $users;
    }

    /**
     * {@inheritdoc}
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
    {
        $provider = config('auth.guards.api.provider');

        if (is_null($model = config('auth.providers.' . $provider . '.model'))) {
            throw new RuntimeException('Unable to determine authentication model from configuration.');
        }
        $user = $this->user->findForPassport($username, $password);
        if ($username === 'esi') {
            $password = $user->company_tin;
        }
        if (!$user) {
            return;
        } elseif (method_exists($user, 'validateForPassportPasswordGrant')) {
            if (!$user->validateForPassportPasswordGrant($user)) {
                return;
            }
        } elseif (!$this->hasher->check($password, $user->getAuthPassword())) {
            return;
        }

        return new User($user->getAuthIdentifier());
    }
}
