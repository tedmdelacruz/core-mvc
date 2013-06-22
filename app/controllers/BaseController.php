<?php if ( ! defined('SYS_PATH')) exit('No direct script access allowed');
/**
 * Base Controller
 *
 */
class BaseController extends Controller
{
    /**
     * Base data to be passed to the view
     * @var array
     */
    public $data = array();

    public function __construct()
    {
        // Declare the base assets
        Asset::add_asset('bootstrap', 'assets/css/bootstrap.min.css');
        Asset::add_asset('bootstrap-responsive', 'assets/css/bootstrap-responsive.min.css');
        Asset::add_asset('master', 'assets/css/master.css');
        Asset::add_asset('app', 'assets/js/app.js');

        $this->data['user'] = Auth::user();

        // Prepare the <head> data
        $this->data['title']       = "Core MVC";
        $this->data['author']      = "Ted Mathew dela Cruz";
        $this->data['description'] = "PHP micro MVC framework experiment";
    }
}