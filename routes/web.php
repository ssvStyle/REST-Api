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
    '/v1/data' => 'get@All',
    '/v1/data/{id}' => 'get@byId',
    '/v1/data/{id}/content' => 'get@byIdField',
    '/v1/data/post/create' => 'post@create',
    '/v1/data/post/edit' => 'put@edit',
];



