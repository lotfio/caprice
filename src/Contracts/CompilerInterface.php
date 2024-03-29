<?php

namespace Caprice\Contracts;

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

interface CompilerInterface
{
    /**
     * compile method.
     *
     * This method gets a string file, compiles it
     * and generates a PHP file based on the .cap file
     *
     * @param string $from from location
     * @param string $to  output location
     * @param string $file file to compile
     * @param bool   $recompile
     * 
     * @return string
     */
    public function compile(string $from, string $to, string $file, bool $recompile): string;
}
