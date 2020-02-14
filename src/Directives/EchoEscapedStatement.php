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

class EchoEscapedStatement implements DirectiveInterface
{
    /**
     * pattern property.
     *
     * @var string
     */
    public $pattern = '/\(\={1}(.*?)\={1}\)/s';

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
        return '<?=htmlentities('.trim($match[1]).', ENT_QUOTES, \'UTF-8\');?>';
    }
}
