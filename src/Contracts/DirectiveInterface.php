<?php

namespace Caprice\Contracts;

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     1.1.0
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2019
 * @license     MIT
 * @link        https://github.com/lotfio/caprice
 *
 */

interface DirectiveInterface
{
    /**
     * directive interface.
     *
     * @param string $expression
     * @param string $file
     * @param array  $extras parameters
     * 
     * @return string
     */
    public function replace(string $expression, string $file, array $extras): string;
}
