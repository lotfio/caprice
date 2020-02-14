<?php

namespace Caprice\Directives;

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
     * directive replace method.
     *
     * @param array  $match
     * @param string $file     original file
     * @param string $filesDir .cap files dir
     *
     * @return string
     */
    public function replace(array $match, string $file, string $filesDir): string
    {
        $secPattern = '/#section\s*\(('.trim($match[1]).')\)(.*?)#endsection/s';

        preg_match($secPattern, $file, $mt);

        return isset($mt[2]) ? trim($mt[2]) : '';
    }
}
