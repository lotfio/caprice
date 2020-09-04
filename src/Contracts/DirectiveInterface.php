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

interface  DirectiveInterface
{
    /**
     * directive interface
     *
     * @param  string $expression
     * @param  string|null $file
     * @return string
     */
    public function replace(string $expression, ?string $file = null) : string;
}
