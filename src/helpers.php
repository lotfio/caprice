<?php

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     1.1.2
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
    function dotPath(string $filePath): string
    {
        $path = preg_replace('/\'|"/', '', $filePath);
        $path = preg_replace('/(.php|.cap.php)$/', '', $path);
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
    function dump(mixed $variable): void
    {
        echo  '<pre>';
        print_r($variable);
        echo '</pre>';
    }
}

if (!function_exists('__escape')) {
    /**
     * dump data method.
     *
     * @param string $variable
     *
     * @return string
     */
    function __escape(string $variable): string
    {
        return htmlentities($variable, ENT_QUOTES, 'UTF-8');
    }
}
