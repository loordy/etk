<?php

namespace App\Http\Controllers\API\v1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Utils\ResponseUtil;
/**
 * @OA\Info(
 *   title="ETK API",
 *   version="1.0",
 *   @OA\Contact(
 *     email="loordy@live.ru",
 *     name="fbeck"
 *   )
 * )
 */
/**
 * @OA\Tag(
 *     name="helpers",
 *     description="helpers desc",
 * )
 * @OA\Tag(
 *     name="Contract",
 *     description="Access to Labor Contracts",
 * )
 * @OA\Tag(
 *     name="Structure",
 *     description="Access to company structures",
 * )
 * @OA\Tag(
 *     name="Users",
 *     description="Access to users",
 * )
 * @OA\Tag(
 *     name="Position",
 *     description="Access to company Position",
 * )
 * @OA\Tag(
 *     name="Log",
 *     description="Access to Log",
 * )
 *
 * @OA\Server(
 *     description="First iteration",
 *     url="/api/v1",
 * )
 *  * @OA\Server(
 *     description="Second iteration",
 *     url="/api/v2",
 * )
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     name="etk_auth",
 *     securityScheme="etk_auth",
 *     @OA\Flow(
 *         flow="password",
 *         tokenUrl="/oauth/token",
 *         refreshUrl="/oauth/token",
 *         scopes={
 *         }
 *     )
 * )
 */
/**/

/**
 * Class AppAPIv1BaseController
 * @package App\Http\Controllers\API\v1
 */
class AppAPIv1BaseController extends Controller
{
    /**
     * @param $result
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message)
    {
        return response()->json(ResponseUtil::makeResponse($message, $result));
    }

    /**
     * @param $error
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $code = 404)
    {
        return response()->json(ResponseUtil::makeError($error), $code);
    }
}
