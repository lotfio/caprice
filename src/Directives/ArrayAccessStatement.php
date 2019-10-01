<?php namespace Caprice\Directives;

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

use Caprice\Contracts\DirectiveInterface;

class ArrayAccessStatement implements DirectiveInterface
{
    /**
     * pattern property
     *
     * @var string
     */
    public $pattern = '/((\$\w+)\.(\w+)(\s*\;*))/m';

    /**
     * string to replace the pattern
     *
     * @return void
     */
    public function replace(array $match) : string
    {
        return $match[2].'["'.$match[3].'"]'.$match[4];
    }
}