<?php

namespace App\Http\Controllers\API\v1;


use App\Utils\ResponseUtil;
use Illuminate\Http\Request;
use App\Repositories\v1\UsersRepository;
use Illuminate\Support\Facades\Gate;
use Storage;


class FilesAPIController extends AppAPIv1BaseController
{

    public function __construct()
    {
        //
    }

    public function avatar($id, Request $request)
    {
        $input = $this->validate($request, [
            'avatar' => 'image|max:5120', //PEG, PNG, BMP, GIF или SVG
        ]);

        $usersRepository = new UsersRepository( app() );

        /** @var Users $users */
        $users = $usersRepository->find($id);

        if (empty($users)) {
            return $this->sendError('User not found');
        }

        if (Gate::denies('update-user', $users)) {
            abort(403, 'Unauthorized to update this users.');
        }

        if ( !array_has($input, 'avatar') ) {

            Storage::disk('public')->delete( $users->getOriginal('avatar_path') );

            $name = null;

        } else {

            Storage::disk('public')->makeDirectory($id);

            if ($users->avatar_path) {

                Storage::disk('public')->delete( $users->getOriginal('avatar_path') );

            }

            $name = Storage::disk('public')->putFile($id, $input['avatar']);

        }

        $users =  $usersRepository->update(array('avatar_path' => $name), $id);

        return $this->sendResponse(array('avatar_path' => $users->toArray()['avatar_path']), 'Users avatar updated successfully');
    }


}
