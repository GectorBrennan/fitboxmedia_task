<?php
declare(strict_types=1);

/**
 * @var Dingo\Api\Routing\Router $router
 */


$router->group(['middleware' => ['cookie', 'session']], function () use ($router) {
    $router->post('login', 'Auth\LoginController@login');
    $router->post('registration', 'Auth\RegistrationController@register');
    $router->post('promoQuestion', 'Auth\RegistrationController@promoQuestion');
    $router->post('recoveryPasswordSend', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    $router->post('passwordReset', 'Auth\ResetPasswordController@passwordReset');

    $router->group(['middleware' => ['api.auth']], function () use ($router) {
        $router->post('logout', 'Auth\LoginController@logout');
    });
});

$router->group(
    ['middleware' => ['api.auth']],
    function () use ($router) {

        //Docs
        $router->get('docs', function () {
            return \File::get(public_path('docs/index.html'));
        });

        //LoginController
        $router->get('auth.getUser', ['scopes' => 'auth.getUser', 'uses' => 'Auth\LoginController@getUser']);

        //ProductController
        $router->get('product.getList', ['scopes' => 'product.getList', 'uses' => 'ProductController@getList']);
        $router->get('product.getByHash', ['scopes' => 'product.getByHash', 'uses' => 'ProductController@getByHash']);
        $router->post('product.create', ['scopes' => 'product.create', 'uses' => 'ProductController@create']);
        $router->delete('product.delete', ['scopes' => 'product.delete', 'uses' => 'ProductController@delete']);

        //OrderController
        $router->get('order.getList', ['scopes' => 'order.getList', 'uses' => 'OrderController@getList']);
        $router->get('order.getByUser', ['scopes' => 'order.getByUser', 'uses' => 'OrderController@getByUser']);
        $router->get('order.getByHash', ['scopes' => 'order.getByHash', 'uses' => 'OrderController@getByHash']);
        $router->post('order.create', ['scopes' => 'order.create', 'uses' => 'OrderController@create']);
        $router->delete('order.delete', ['scopes' => 'order.delete', 'uses' => 'OrderController@delete']);
        $router->post('order.addProduct', ['scopes' => 'order.addProduct', 'uses' => 'OrderController@addProduct']);
        $router->delete('order.deleteProduct', ['scopes' => 'order.deleteProduct', 'uses' => 'OrderController@deleteProduct']);
        $router->post('order.replaceProduct', ['scopes' => 'order.replaceProduct', 'uses' => 'OrderController@replaceProduct']);




    });
