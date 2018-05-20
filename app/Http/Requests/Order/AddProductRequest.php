<?php
declare(strict_types=1);

namespace App\Http\Requests\Order;

use App\Http\Requests\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use Hashids;
use Illuminate\Contracts\Validation\Validator;

class AddProductRequest extends Request
{
    public function rules(): array
    {
        return [
            'order_hash' => 'required|exists:orders,hash',
            'product_hash' => 'required|exists:products,hash'
        ];

    }

    protected function getFailedValidationMessage(): string
    {
        return trans('product.on_create_error');
    }

    public function moreValidation(Validator $validator)
    {
        $validator->after(function ($validator) {

            $user = \Auth::user();
            $order = Order::where('hash', $this->get('order_hash'))
                ->where('user_id', $user['id']);

            if (!$order->exists()) {

                $validator->errors()->add('order.not_belongs', trans('order.on_add_oproduct_error'));
            }

            $products = OrderProduct::where('order_id', Hashids::decode($this->input('order_hash')))
                ->where('product_id', Hashids::decode($this->input('product_hash')))
                ->count();

            if ($products >= 3) {
                $validator->errors()->add('order.count_in_order', trans('order.on_add_product_error'));

            }
        });
    }
}
