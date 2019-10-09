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

interface DirectiveInterface
{
    /**
     * replace method.
     *
     * This method is a callback that returns a
     * string which will replace the directive
     *
     * @param array $match
     *
     * @return void
     */
    public function replace(array $match) : string;
}
