<?php
/**
 * Created by PhpStorm.
 * User: gectorgrundy
 * Date: 20.05.18
 * Time: 00:03
 */

namespace App\Http\Controllers;

use App\Http\Requests\Order as R;
use App\Models\Order;
use App\Models\OrderProduct;
use DB;
use Hashids;
use Auth;


class OrderController extends Controller
{

    /**
     * @api {POST} /order.create order.create
     * @apiGroup Order
     * @apiPermission customer
     *
     * @apiSampleRequest /order.create
     */
    public function create()
    {
        $user = Auth::user();

        $order = Order::create(['user_id' => $user['id']]);

        return [
            'message' => trans('order.on_create_success'),
            'response' => $order,
            'status_code' => 202
        ];

    }

    /**
     * @api {DELETE} /order.delete order.delete
     * @apiGroup Order
     * @apiPermission customer
     *
     * @apiParam {String} hash
     *
     * @apiSampleRequest /order.delete
     */
    public function delete(R\DeleteRequest $request)
    {
        Order::where('hash', $request->get('hash'))->delete();

        return [
            'message' => trans('order.on_delete_success'),
            'status_code' => 202
        ];
    }

    /**
     * @api {GET} /order.getByHash order.getByHash
     * @apiGroup Order
     * @apiPermission customer
     *
     * @apiParam {String} hash
     *
     * @apiSampleRequest /order.getByHash
     */
    public function getByHash(R\GetByHashRequest $request)
    {
        $order = Order::with(['product.product'])->where('hash', $request->get('hash'))->first();

        return [
            'response' => $order,
            'status_code' => 200
        ];
    }

    /**
     * @api {GET} /order.getList order.getList
     * @apiGroup Order
     * @apiPermission customer
     * @apiPermission administrator
     *
     * @apiParam {String} hash
     *
     * @apiSampleRequest /order.getList
     */
    public function getList()
    {
        $orders = Order::with('product.product')->get();

        return [
            'response' => $orders,
            'status_code' => 200
        ];
    }

    /**
     * @api {GET} /order.getByUser order.getByUser
     * @apiGroup Order
     * @apiPermission customer
     *
     * @apiSampleRequest /order.getByUser
     */
    public function getByUser()
    {
        $orders = Order::with('product.product')->where('user_id', Auth::user()['id'])->get();

        return [
            'response' => $orders,
            'status_code' => 200
        ];
    }

    /**
     * @api {POST} /order.addProduct order.addProduct
     * @apiGroup Order
     * @apiPermission customer
     *
     * @apiParam {String} order_hash
     * @apiParam {String} product_hash

     * @apiSampleRequest /order.addProduct
     */
    public function addProduct(R\AddProductRequest $request)
    {
        $order_id = Hashids::decode($request->input('order_hash'))[0];
        $product_id = Hashids::decode($request->input('product_hash'))[0];

        DB::table('order_product')->insert([
            'order_id' => $order_id,
            'product_id' => $product_id,
        ]);

        $order = Order::with('product.product')->where('id', $order_id)->first();

        return [
            'message' => trans('order.on_add_product_success'),
            'response' => $order,
            'status_code' => 202
        ];
    }

    /**
     * @api {DELETE} /order.deleteProduct order.deleteProduct
     * @apiGroup Order
     * @apiPermission customer
     *
     * @apiParam {String} order_hash
     * @apiParam {String} product_hash

     * @apiSampleRequest /order.deleteProduct
     */
    public function deleteProduct(R\DeleteProductRequest $request)
    {
        $order_id = Hashids::decode($request->input('order_hash'))[0];
        $product_id = Hashids::decode($request->input('product_hash'))[0];

        $order_product = OrderProduct::where('order_id', $order_id)
            ->where('product_id', $product_id)
            ->delete();

        return [
            'message' => trans('order.on_delete_product_success'),
            'status_code' => 202
        ];
    }

    /**
     * @api {POST} /order.replaceProduct order.replaceProduct
     * @apiGroup Order
     * @apiPermission customer
     *
     * @apiParam {String} order_hash
     * @apiParam {String} from_product_hash
     * @apiParam {String} to_product_hash
     *
     * @apiSampleRequest /order.replaceProduct
     */
    public function replaceProduct(R\ReplaceProductRequest $request)
    {
        $order_id = Hashids::decode($request->input('order_hash'))[0];
        $from_product_id = Hashids::decode($request->input('from_product_hash'))[0];
        $to_product_id = Hashids::decode($request->input('to_product_hash'))[0];

        OrderProduct::where('order_id', $order_id)
            ->where('product_id', $from_product_id)
            ->update(['product_id' => $to_product_id]);

        return [
            'message' => trans('order.on_replace_product_success'),
            'status_code' => 202
        ];
    }
}