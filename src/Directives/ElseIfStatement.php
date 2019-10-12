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

class ElseIfStatement implements DirectiveInterface
{
    /**
     * pattern property.
     *
     * @var string
     */
    public $pattern = '/(#elif)\s*\((.*)\)/';

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
        return '<?php elseif('.trim($match[2]).'):?>';
    }
}
