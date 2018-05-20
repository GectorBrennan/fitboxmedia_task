<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Requests\Auth as R;
use Illuminate\Foundation\Auth\ResetsPasswords;

class LoginController extends Controller
{
    use Helpers;
    use ResetsPasswords;

    /**
     * @api {POST} /login login
     * @apiGroup Auth
     *
     * @apiParam {String} email
     * @apiParam {String} password
     * @apiParam {Number=0,1} remember
     *
     * @apiSampleRequest /login
     */
    public function login(R\LoginRequest $request, AuthService $auth_service)
    {
        $request->merge([
            'email' => strtolower($request->input('email'))
        ]);

        if (!$auth_service->checkCredentials($request->input('email'), $request->input(['password']))) {
            return $this->response->errorUnauthorized(trans('auth.on_login_error'));
        }

        $user = User::getByEmail($request->input('email'));


        $token = $auth_service->auth($user, (bool)$request->input('remember'));

        return [
            'message' => trans('auth.on_login_success'),
            'response' => [
                'token' => $token
            ],
            'status_code' => 200
        ];
    }



    /**
     * @api {POST} /logout logout
     * @apiGroup Auth
     *
     * @apiPermission customer
     * @apiPermission admin
     *
     * @apiSampleRequest /logout
     */
    public function logout(AuthService $auth_service)
    {
        $auth_service->logout();

        return ['status_code' => 202];
    }

    /**
     * @api {GET} /auth.getUser auth.getUser
     * @apiDescription Get user info by token for authentication purpose.
     * @apiGroup Auth
     *
     * @apiPermission customer
     * @apiPermission admin
     *
     * @apiSampleRequest /auth.getUser
     */
    public function getUser(Request $request)
    {
        User::$role = \Auth::user()['role'];

        $user = Auth::user();


        return [
            'user' => $user,
        ];
    }
}
