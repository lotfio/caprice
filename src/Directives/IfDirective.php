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

class IfDirective implements DirectiveInterface
{
    /**
     * replace.
     *
     * @param string $expression
     * @param string $file
     *
     * @return string
     */
    public function replace(string $expression, string $file): string
    {
        return '<?php if'.($expression).':?>';
    }
}
