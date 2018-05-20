<?php
declare(strict_types=1);

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;
use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;

class CreateRequest extends Request
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'cost' => 'required|numeric'
        ];

    }

    protected function getFailedValidationMessage(): string
    {
        return trans('product.on_create_error');
    }

    public function moreValidation(Validator $validator)
    {
        $validator->after(function ($validator) {

            $product = Product::where('title', $this->get('title'))
                ->where('cost', $this->get('cost'));

            if ($product->exists()) {

                $validator->errors()->add('product.unique_error', trans('product.on_create_error'));
            }
        });
    }
}
