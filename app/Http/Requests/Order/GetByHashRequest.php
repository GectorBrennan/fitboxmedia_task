<?php
declare(strict_types=1);

namespace App\Http\Requests\Order;

use App\Http\Requests\Request;

class GetByHashRequest extends Request
{
    public function rules(): array
    {
        return [
            'hash' => 'required|exists:orders,hash',
        ];

    }

    protected function getFailedValidationMessage(): string
    {
        return trans('order.on_get_error');
    }
}
