<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Dingo\Api\Routing\Helpers;
use App\Http\Requests\Auth as R;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\User;

class RegistrationController extends Controller
{
    use Helpers;
    use ResetsPasswords;

    private $auth_service;

    public function __construct(AuthService $auth_service)
    {
        $this->auth_service = $auth_service;
    }

    /**
     * @api {POST} /registration registration
     * @apiGroup Auth
     * @apiParam {String=advertiser,customer} role
     * @apiParam {String} email Unique email in the system
     * @apiParam {String} [password]
     * @apiParam {String} [phone]
     * @apiSampleRequest /registration
     */
    public function register(R\RegistrationRequest $request)
    {
        $user = User::create(array_merge($request->all()));

        $this->auth_service->auth($user, false);


        return $this->response->accepted(null, [
            'message' => trans('publishers.on_create_success'),
            'response' => $user,
            'status_code' => 202
        ]);
    }


}
