<?php
/**
 * Base Controller
 *
 */
class BaseController extends Core\Controller
{
    /**
     * Base data to be passed to the view
     * @var array
     */
    public $data = array();

    /**
     * Add the assets and data to be shared across controllers
     */
    public function __construct()
    {
        // Declare the base assets
        Asset::add('bootstrap', 'assets/css/bootstrap.min.css');
        Asset::add('bootstrap-responsive', 'assets/css/bootstrap-responsive.min.css');
        Asset::add('master', 'assets/css/master.css');
        Asset::add('app', 'assets/js/app.js');

        // $this->data['user'] = Auth::user();

        // Prepare the <head> data
        $this->data['title']       = "Core MVC";
        $this->data['author']      = "Ted Mathew dela Cruz";
        $this->data['description'] = "PHP micro MVC framework experiment";

        // Prepare alert messages
        $this->data['error']   = '';
        $this->data['success'] = '';
        $this->data['notice']  = '';

        View::set($this->data);
    }
}