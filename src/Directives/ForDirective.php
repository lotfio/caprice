<?php

namespace Caprice\Directives;

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

use Caprice\Contracts\DirectiveInterface;

class ForDirective implements DirectiveInterface
{
    /**
     * replace.
     *
     * @param string $expression
     * @param string $file
     * @param array $extras
     *
     * @return string
     */
    public function replace(string $expression, string $file, array $extras): string
    {
        if (preg_match('/\(((.*)(in)(.*))\)/', $expression, $match)) {
            return '<?php foreach('.$match[4].' as '.$match[2].'):?>';
        }

        return '<?php for'.$expression.':?>';
    }
}
