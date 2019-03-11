<?php

namespace App\Http\Controllers\API\v2;


use App\Services\v2\UserAvatar;
use Illuminate\Http\Request;



/**
 * Class FilesAPIController
 * @package App\Http\Controllers\API\v2
 */
class FilesAPIController extends BaseAPIController
{

    /**
     * FilesAPIController constructor.
     */
    public function __construct()
    {
        //
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function avatar(Request $request)
    {
        $input = $this->validate($request, [
            'avatar' => 'present|nullable|image|max:5120', //PEG, PNG, BMP, GIF или SVG
            'user_id' => 'bail|required|regex:/^[0-9]+$/|user',
        ]);

        $name = UserAvatar::save($input['avatar'],$input['user_id']);

        return $this->sendResponse(['avatar_path' => $name], 'User avatar updated successfully');
    }


}
