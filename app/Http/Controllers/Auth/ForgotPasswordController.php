<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth as R;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    private $passwords;

    public function __construct(PasswordBroker $passwords)
    {
        $this->passwords = $passwords;
    }

}