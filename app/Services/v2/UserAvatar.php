<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 15.02.2019
 * Time: 10:46
 */

namespace App\Services\v2;


use App\Models\v2\User;
use Illuminate\Support\Facades\Storage;

class UserAvatar
{

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct()
    {
        //
    }

    public static function save($avatar, $id)
    {
        /** @var User $user */
        $user = User::findOrFail($id);

        if (is_null($avatar)) {
           $name = null;
        } else {
           $name = Storage::disk('avatars')->put($id, $avatar);
        }

        if ($user->avatar_path) {
            Storage::disk('avatars')->delete($user->getOriginal('avatar_path'));
        }

        $user->fill(['avatar_path' => $name])->save();

        return $user->avatar_path;

    }
}