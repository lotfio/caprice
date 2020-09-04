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

interface RulesParserInterface
{
    /**
     * parse file applying a rule
     *
     * @param  string $file
     * @param  array $rules
     * @return void
     */
    public function parse(string $file, array $rules);
}
