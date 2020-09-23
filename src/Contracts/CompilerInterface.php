<?php

namespace Caprice\Contracts;

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     1.0.0
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
     * @param string $file cap file
     * @param  string output location
     *
     * @return string
     */
    public function compile(string $file, string $outputLocation): string;
}
