<?php
declare(strict_types=1);

namespace App\Http\Requests\Order;

use App\Http\Requests\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;

class DeleteRequest extends Request
{
    public function rules(): array
    {
        return [
            'hash' => 'required|exists:orders,hash'
        ];

    }

    protected function getFailedValidationMessage(): string
    {
        return trans('order.on_create_error');
    }

    public function moreValidation(Validator $validator)
    {
        $validator->after(function ($validator) {

            $user = \Auth::user();
            $order = Order::where('hash', $this->get('hash'))
                ->where('user_id', $user['id']);

            if (!$order->exists()) {

                $validator->errors()->add('order.not_belongs', trans('order.on_delete_error'));
            }
        });
    }
}
