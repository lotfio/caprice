<?php

namespace Caprice;

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

use Caprice\Contracts\RulesParserInterface;

class RulesParser implements RulesParserInterface
{
    /**
     * rule parser
     *
     * @param array $rules
     * @return void
     */
    public function parse(string $file, array $rules)
    {
        return preg_replace_callback($rules['directive'], function($match) use ($rules)
        {
            return \call_user_func($rules['replace'], trim($match[1]));

        }, $file);
    }
}