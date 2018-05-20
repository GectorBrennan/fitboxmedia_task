<?php
declare(strict_types=1);

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;

class GetByHashRequest extends Request
{
    public function rules(): array
    {
        return [
            'hash' => 'required|exists:products,hash',
        ];

    }

    protected function getFailedValidationMessage(): string
    {
        return trans('product.on_get_error');
    }
}
