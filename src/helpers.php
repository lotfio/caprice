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

use Caprice\Utils;

if (!function_exists("extend"))
{
    /**
     * extend template method
     *
     * @param  string $file
     * @return string
     */
    function extend(string $file) : string
    {
        return Utils::extend($file);
    }
}