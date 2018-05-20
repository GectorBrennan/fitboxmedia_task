<?php
/**
 * Created by PhpStorm.
 * User: gectorgrundy
 * Date: 19.05.18
 * Time: 17:21
 */

namespace App\Http\Controllers;

use App\Http\Requests\Product as R;
use App\Models\Product;
use Dingo\Api\Routing\Helpers;


class ProductController extends Controller
{
    use Helpers;

    /**
     * @api {POST} /product.create product.create
     * @apiGroup Product
     * @apiPermission administrator
     *
     * @apiParam {String} title
     * @apiParam {Number} cost

     * @apiSampleRequest /product.create
     */
    public function create(R\CreateRequest $request)
    {
        $product = Product::create([
            'title' => $request->get('title'),
            'cost' => $request->get('cost')
        ]);

        return [
            'message' => trans('product.on_create_success'),
            'response' => $product,
            'status_code' => 202
        ];
    }

    /**
     * @api {DELETE} /product.delete product.delete
     * @apiGroup Product
     * @apiPermission administrator
     *
     * @apiParam {String} hash
     *
     * @apiSampleRequest /product.delete
     */
    public function delete(R\DeleteRequest $request)
    {
        Product::where('hash', $request->input('hash'))->delete();

        return $this->response->accepted(null, [
            'message' => trans('product.on_delete_success'),
            'status_code' => 202
        ]);
    }

    /**
     * @api {GET} /product.getList product.getList
     * @apiGroup Product
     * @apiPermission administrator
     * @apiPermission customer
     *
     * @apiSampleRequest /product.getList
     */
    public function getList()
    {
        $products = Product::all();

        return [
            'response' => $products,
            'status_code' => 200
        ];
    }

    /**
     * @api {GET} /product.getByHash product.getByHash
     * @apiGroup Product
     * @apiPermission administrator
     * @apiPermission customer
     *
     * @apiParam {String} hash
     *
     * @apiSampleRequest /product.getByHash
     */
    public function getByHash(R\GetByHashRequest $request)
    {
        $product = Product::where('hash', $request->get('hash'))->first();

        return [
            'response' => $product,
            'status_code' => 200
        ];
    }
}