<?php

/**
 * Routes.
 */

use application\lib\RouteKernel;

$app = new RouteKernel();

return [
    $app->add('/', 'sections@index', 'AuthMiddleware'),
    $app->add('create', 'sections@form', 'AuthMiddleware'),
    $app->add('store', 'sections@store', 'AuthMiddleware'),
    $app->add('update/{id}', 'sections@update', 'AuthMiddleware'),
    $app->add('section/{id}', 'sections@show', 'AuthMiddleware'),
    $app->add('delete/{id}', 'sections@destroy', 'AuthMiddleware'),
    $app->add('edit/{id}', 'sections@edit', 'AuthMiddleware'),

    $app->add('login', 'auth@show', 'AuthorizedMiddleware'),
    $app->add('auth', 'auth@login'),
];
