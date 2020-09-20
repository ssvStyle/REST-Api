<?php

namespace Core;

class Router implements \Core\Interfaces\RouterInterface
{
    protected $routeMap;
    
    protected $request;

    protected $parseRoute;

    public function __construct(string $request)
    {
        $this->request = $request;
        
        $this->routeMap = include __DIR__ . '/../routes/web.php';

        $this->parseRoute = new ParseRoute();


    }

    public function getParams()
    {
        //
    }

    public function response()
    {
        $res = [];

        $patternGetParams = '~([?]\w*[=]\w*).+~';

        $request = preg_replace($patternGetParams, '', $this->request);

        $request = preg_replace('~^\/[\w\-\.\+\?\#]*~', '', $request);

        $request = preg_replace('~\/$~', '', $request);

        if ( empty( $request ) ) {

            $request = '/';

        }

        $requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_ENCODED);


        foreach ($this->routeMap as $web) {

            if ((bool)preg_match($this->parseRoute->getRegexpFromRoute($web['route']), $request, $params) && $requestMethod === $web['requestMethod']) {
                //405 - Method not allowed
                $args = [];

                foreach ($params as $k => $v) {
                    if (!is_numeric($k)) {
                        $args[$k] = $v;
                    }
                }

                $res['access'] = $web['access'] ?? false;
                $res['ctrlAtMethod'] = $web['controller'] . '@' . $web['method'];
                $res['args'] = $args;

            }
        }


        //var_dump($res);die('response');
        return $res;
    }
}