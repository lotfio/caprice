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

interface RuleParserInterface
{
    /**
     * parse file applying a rule.
     *
     * @param string $file
     * @param array  $rule
     *
     * @return string
     */
    public function parse(string $file, array $rule): string;
}
