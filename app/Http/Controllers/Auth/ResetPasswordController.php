<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth as R;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function passwordReset(R\PasswordResetRequest $request)
    {

    }

}