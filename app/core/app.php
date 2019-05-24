<?php

class App
{
    /** @var string $controller Default Controller */
    public $controller = 'home';

    /** @var string $method Default Controller Method */
    public $method = 'index';

    /** @var array $params Params passed in URL */
    public $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // Check does controller with this name exists
        if (file_exists('../app/controller/' . $url[0] . '.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        require_once '../app/controller/' . strtolower($this->controller) . '.php';

        $controller = ucfirst($this->controller);
        // Init Controller
        $this->controller = new $controller();

        // Check does method with this name exists in our controller
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        // If everything is ok call this controller method and pass params
        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    /**
     * Splitting the url and getting his parts that represents controller, method and all params in one array.
     * @return array Controller, method and all params in one array.
     */
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}