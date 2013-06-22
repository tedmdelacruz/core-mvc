<?php if ( ! defined('SYS_PATH')) exit('No direct script access allowed');
/**
 * Home
 *
 * This is the default home controller.
 *
 */
class HomeController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        View::render('home', $this->data);
    }

}