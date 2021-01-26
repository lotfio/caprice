<?php

namespace Caprice\Directives;

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

use Caprice\Contracts\DirectiveInterface;
use Caprice\Exception\CapriceException;

class ExtendsDirective implements DirectiveInterface
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
        global  $compileFrom;
        $path = $compileFrom.dotPath(trim(str_replace('.', '/', $expression), ')("\''));

        if (!\file_exists($path)) {
            throw new CapriceException("file $path not found");
        }

        return file_get_contents($path);
    }
}
