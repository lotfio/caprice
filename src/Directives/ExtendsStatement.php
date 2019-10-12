<?php

namespace Caprice\Directives;

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

class ExtendsStatement implements DirectiveInterface
{
    /**
     * pattern property.
     *
     * @var string
     */
    public $pattern = '/#extends\s*\((.+?)\)/';

    /**
     * directive replace method
     *
     * @param  array  $match
     * @param  string $file original file
     * @return string
     */
    public function replace(array $match, string $file) : string
    {
        $content = file_get_contents($match[1]);
        
        return $content;
    }
}
