<?php

namespace Caprice\Contracts;

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

interface CompilerInterface
{
    /**
     * compile method.
     *
     * This method gets a parsed string from parsed file
     * and it compiles it and generates a PHP file based
     * on the .cap file
     * This compile method generates a file only if the .cap
     * file is modified
     *
     * @return void
     */
    public function compile(string $file, string $cache) : string;
}
