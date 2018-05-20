<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\GlobalUserEnabledScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\EloquentHashids;
use App\Models\Traits\DynamicHiddenVisibleTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * @mixin AbstractEntity
 * @method $this search(?string $search_field, ?string $search)
 * @method $this whereRoles(array $roles)
 */
class User extends AbstractEntity implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use EloquentHashids;
    use DynamicHiddenVisibleTrait;
    use Notifiable;
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;

    public const ADMINISTRATOR = 'administrator';
    public const CUSTOMER = 'customer';

    protected $table = 'users';
    protected $fillable = [
        'email', 'nickname', 'role', 'locale', 'password',
    ];
    protected $hidden = [
        'id',  'password', 'remember_token', 'deleted_at', 'updated_at', 'pivot'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // Need for profile method
    public static $role;

    public static function getHashidEncodingValue(Model $model)
    {
        return $model->id;
    }

    public function setPasswordAttribute(string $value)
    {
        // Crutch because of ResetsPasswords@resetPassword
        if (!starts_with($value, '$2y$10$')) {
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }

    public function setEmailAttribute(string $value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public static function getByEmail(string $email): User
    {
        return self::whereEmail($email)->firstOrFail();
    }
}
