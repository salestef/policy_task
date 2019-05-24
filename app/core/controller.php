<?php

class Controller
{
    /** @var PDO $db Initializes connection with a database that can later be used in child controllers. */
    public $db = null;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->db = DB::connect();
    }

    /**
     * Initializes the model that we need in current controller.
     * @param string $model Name of the model.
     * @return mixed Instance of the model.
     */
    public function model($model)
    {
        require_once '../app/model/' . strtolower($model) . '.php';
        return new $model();
    }

    /**
     * Renders method view that we want to display and pass params to him.
     *
     * @param string $view Name of the view content that we want to display.
     * @param array $data Data that we want to send to our view content for later use.
     * @param string $viewHeader Name of the view header that we want to display.
     * @param array $dataHeader Data that we want to send to our view header for later use.
     * @param string $viewFooter Name of the view footer that we want to display.
     * @param array $dataFooter Data that we want to send to our view footer for later use.
     */
    public function view($view, $data = [], $viewHeader = 'default', $dataHeader = [], $viewFooter = 'default', $dataFooter = [])
    {
        $this->header($viewHeader, $dataHeader);
        $this->content($view, $data);
        $this->footer($viewFooter, $dataFooter);
    }

    /**
     * @param string $view Name of the view content that we want to display.
     * @param array $data Data that we want to send to our view content for later use.
     */
    public function content($view, $data = [])
    {
        require_once '../app/view/' . $view . '.php';
    }

    /**
     * @param string $view Name of the view header that we want to display.
     * @param array $data Data that we want to send to our view header for later use.
     */
    public function header($view = 'default', $data = [])
    {
        require_once '../app/view/headers/' . $view . '.php';
    }

    /**
     * @param string $view Name of the view footer that we want to display.
     * @param array $data Data that we want to send to our view footer for later use.
     */
    public function footer($view = 'default', $data = [])
    {
        require_once '../app/view/footers/' . $view . '.php';
    }


}