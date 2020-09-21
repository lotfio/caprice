<?php

namespace Caprice\Directives;

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

use Caprice\Contracts\DirectiveInterface;
use Caprice\Exception\CapriceException;

class IncludeDirective implements DirectiveInterface
{
    /**
     * replace
     *
     * @param  string $expression
     * @return string
     */
    public function replace(string $expression, ?string $file = null): string
    {
        $file = COMPILE_FROM . dotPath(\trim($expression, (')(\'"')));

        if(!\file_exists($file))
            throw new CapriceException("file $file not found");

        return file_get_contents($file);
    }
}