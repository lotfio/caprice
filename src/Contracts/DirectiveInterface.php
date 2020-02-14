<?php

namespace Caprice\Contracts;

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     0.4.0
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
     * @param array  $match
     * @param string $file     : original file if any additional content is nedded
     * @param string $filesDir : directory wheere files are located
     *
     * @return void
     */
    public function replace(array $match, string $file, string $filesDir): string;
}
