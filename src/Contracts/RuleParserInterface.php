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

interface RuleParserInterface
{
    /**
     * parse file applying a rule.
     *
     * @param string $file
     * @param array  $rule
     * @param array  $extras
     *
     * @return string
     */
    public function parse(string $file, array $rule, array $extras): string;
}
