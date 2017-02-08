<?php

namespace App\Core;

class Application
{
    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $url_action = null;

    /** @var array URL parameters */
    private $url_params = array();

    private $request_path = array();

    public function __construct()
    {
        // create array with URL parts in $url
        $this->request_path = $this->request_path();
        $this->splitUrl();

        // check for controller: no controller given ? then load start-page
        // nếu không có controller sẽ load trang index login
        if (!$this->url_controller) {

            $page = new \App\Controller\UsersController();
            $page->login();

        } elseif (file_exists(APP . 'Controller/' . ucfirst($this->url_controller) . 'Controller.php')) {
            // kiểm tra xem có tồn tại Controller, nếu có sẽ gọi đến controller đó
            // here we did check for controller: does such a controller existloc ?

            // if so, then load this file and create this controller
            // like \App\Controller\CarController
            $controller = "\\App\\Controller\\" . ucfirst($this->url_controller) . 'Controller';
            $this->url_controller = new $controller();

            // kiểm tra xem có tồn tại action trong controller
            if (method_exists($this->url_controller, $this->url_action)) {

                if (!empty($this->url_params)) {

                    // nếu có params thì sẽ gọi method có params
                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                } else {

                    // If no parameters are given, just call the method without parameters, like $this->home->method();
                    // nếu không có papams thì sẽ gọi method không có params
                    $this->url_controller->{$this->url_action}();
                }
            } else {

                if (strlen($this->url_action) == 0) {
                    // no action defined: call the default index() method of a selected controller
                    // nếu method = null thì sẽ mặc định gọi đến method index()
                    $this->url_controller->index();
                } else {
                    // nếu method khác null mà không có trong controller thì sẽ gọi đến trang thông báo lỗi
                    header('location: ' . URL . 'error');
                }
            }
        }
    }

    public function request_path()
    {
        // cắt uri thành mảng
        $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

        $script_name = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));

        // so sánh 2 mảng và trả về 1 mảng chứa tất cả các giá trị
        // trong mảng $request_uri mà key không trùng với mảng $script_name
        $parts = array_diff_assoc($request_uri, $script_name);

        if (empty($parts) && empty($parts[0])) {
            return '/';
        }

        $path = implode('/', $parts);

        if (($position = strpos($path, '?')) !== FALSE) {
            $path = substr($path, 0, $position);
        }

        return $path;
    }

    public function splitUrl()
    {
       if (empty($this->request_path())) {
           $this->url_controller = null;
           $this->url_params = null;
       } else {
           $url = $this->request_path();
           $url = filter_var($url, FILTER_SANITIZE_URL);
           $url = explode('/', $url);

           $this->url_controller = isset($url[0]) ? $url[0] : null;
           $this->url_action = isset($url[1]) ? $url[1] : null;

           unset($url[0], $url[1]);

           $this->url_params = array_values($url);
       }
    }
}