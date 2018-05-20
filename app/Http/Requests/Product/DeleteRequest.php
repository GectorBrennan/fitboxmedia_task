<?php
declare(strict_types=1);

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;

class DeleteRequest extends Request
{
    public function rules(): array
    {
        return [
            'hash' => 'required|exists:products,hash',
        ];

    }

    protected function getFailedValidationMessage(): string
    {
        return trans('product.on_delete_error');
    }
}
