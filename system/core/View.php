<?php namespace Core;
/**
 *
 * View
 *
 * Handles all HTML output
 *
 * @package     Core
 * @author      Ted Mathew dela Cruz
 * @copyright   Copyright (c) 2013 - 2014, Ted Mathew dela Cruz.
 * @link        http://core.tedmdelacruz.com
 *
 */
class View
{
    /**
     * Render
     *
     * Includes the PHP file which outputs the view
     *
     * @param  string $view View file to be loaded in app/views
     * @param  array  $vars Variables to be passed to the view
     */
    public static function render($view, $vars = array())
    {

        // Declare the variables
        if( ! empty($vars)){

            foreach ($vars as $var_name => $var_value) {
                $$var_name = $var_value;
            }

        }

        $view_file = VIEWS_DIR . $view . '.php';

        try
        {
            if( ! is_file($view_file))
            {
                throw new Exceptions\CoreException("View not found: {$view_file}");
            }

            include_once $view_file;
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }
}