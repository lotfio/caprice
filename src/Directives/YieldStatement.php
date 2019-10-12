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

class YieldStatement implements DirectiveInterface
{
    /**
     * pattern property.
     *
     * @var string
     */
    public $pattern = '/#yield\s*\((.+?)\)/';

    /**
     * directive replace method
     *
     * @param  array  $match
     * @param  string $file original file
     * @return string
     */
    public function replace(array $match, string $file) : string
    {
        $sectionName = preg_replace("/[^\w\.\/]/", NULL, $match[1]);
        $secPattern = '/#section\s*\(("' . $sectionName . '")\)(.*?)#endsection/s';
        preg_match($secPattern, $file, $mt);

        return isset($mt[2]) ? trim($mt[2]) : "section $sectionName not found";
    }
}
