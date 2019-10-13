<?php

namespace Caprice\Directives;

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     0.2.0
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2019
 * @license     MIT
 * @link        https://github.com/lotfio/caprice
 *
 */

use Caprice\Contracts\DirectiveInterface;
use Caprice\Exception\FileNotFoundException;

class IncludeStatement implements DirectiveInterface
{
    /**
     * pattern property.
     *
     * @var string
     */
    public $pattern = '/(#include|#require)\s*\((.*?)\)/s';

    /**
     * directive replace method
     *
     * @param  array  $match
     * @param  string $file original file
     * @param  string $filesDir .cap files dir
     * @return string
     */
    public function replace(array $match, string $file, string $filesDir) : string
    {
        $file = $filesDir . dotPath($match[2]);

        if(!file_exists($file))
            throw new FileNotFoundException("file $file not found", 4);
            
        return file_get_contents($file);
    }
}
