<?php

namespace Caprice;

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

class Utils
{
    /**
     * hide sections
     *
     * @param  string $file
     * @return string
     */
    public static function hideSections(string $file) : string
    {
        return preg_replace('/#section\s*\((.*?)\)(.*?)#endsection/s', NULL, $file);
    }
}