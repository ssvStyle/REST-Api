<?php
/**
 * This is a routes file.
 *
 * The route and controller@method can be set in the format
 * route => controller@method
 * '/home' => 'home@index',
 *
 * route
 * '/article/show/{id}'
 *
 * {id} params
 *
 * or route
 * '/articles/page/{page}/sort/{sort}'
 *
 * {page} .. {sort} params
 *
 *
 * params will be added
 * and available in the controller
 * automatically in the variable $this->data[page]|$this->data[sort]...
 *
 */


return [
    'api' => [
        'route' => '/v1/data',
        'requestMethod' => 'GET',
        'controller' => 'GET\Data',
        'method' => 'all',
    ],
    [
        'route' => '/v1/data/{id}',
        'requestMethod' => 'GET',
        'controller' => 'GET\Data',
        'method' => 'byId',
    ],
    [
        'route' => '/v1/data/{id}/{field}',
        'requestMethod' => 'GET',
        'controller' => 'GET\Data',
        'method' => 'byIdField',
    ],
    [
        'route' => '/v1/data',
        'requestMethod' => 'POST',
        'controller' => 'POST\NewData',
        'method' => 'add',
    ],
    [
        'route' => '/v1/login',
        'requestMethod' => 'POST',
        'controller' => 'POST\Auth',
        'method' => 'login',
        'access' => true,
    ],
    [
        'route' => '/v1/data',
        'requestMethod' => 'PUT',
        'controller' => 'PUT\EditData',
        'method' => 'update',
    ],
    [
        'route' => '/v1/data/{id}',
        'requestMethod' => 'DELETE',
        'controller' => 'DELETE\Delete',
        'method' => 'oneById',
    ],
];



