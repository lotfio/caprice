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

class ForInValueOnlyStatement implements DirectiveInterface
{
    /**
     * pattern property.
     *
     * @var string
     */
    public $pattern = '/#for\s*\((\$\w+\s*)(\s*in\s*)(\$\w+\s*)\)(.*?)#endfor/s';

    /**
     * directive replace method.
     *
     * @param array  $match
     * @param string $file     original file
     * @param string $filesDir .cap files dir
     *
     * @return string
     */
    public function replace(array $match, string $file, string $filesDir) : string
    {
        return '<?php foreach('.trim($match[3]).' as '.trim($match[1]).'):?>'.trim($match[4]).'<?php endforeach;?>';
    }
}
