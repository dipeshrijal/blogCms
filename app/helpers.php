<?php

if (!function_exists('theme')) 
{
    /**
     * @param $path
     * @return string
     */
    function theme($path)
    {
        $config = app('config')->get('cms.theme');
        
        return url($config['folder'] . '/' . $config['active'] . '/assets/' . $path);
    }
}
