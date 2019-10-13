<?php

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     0.1.0
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2019
 * @license     MIT
 * @link        https://github.com/lotfio/caprice
 *
 */

if (!function_exists('dotPath')) {

    /**
     * dot path helper function
     * allow dots as separators.
     *
     * @param string $filePath
     *
     * @return string
     */
    function dotPath(string $filePath) : string
    {
        $path = preg_replace('/\'|"/', null, $filePath);
        $path = preg_replace('/(.php|.cap.php)/', null, $path);
        $path = str_replace('.', '/', $path);

        return $path.'.cap.php';
    }
}

if (!function_exists('dump')) {
    /**
     * dump data method.
     *
     * @param mixed $variable
     *
     * @return void
     */
    function dump($variable)
    {
        echo  '<pre>';
        print_r($variable);
        echo '</pre>';
    }
}
