<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\EloquentHashids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;

/**
 * @method $this whereNotAdmin()
 * @method $this whereUser(int $id)
 */
class AuthToken extends AbstractEntity
{
    use EloquentHashids;

    protected $fillable = ['token', 'user_id'];
    protected $hidden = ['id', 'user_id', 'token', 'updated_at'];

}
