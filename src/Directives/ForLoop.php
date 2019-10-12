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

class ForLoop implements DirectiveInterface
{
    /**
     * pattern property.
     *
     * @var string
     */
    public $pattern = '/#for\s*\((\$\w+\s*=\s*[\$\w+]+\s*\;)(\s*\$\w+\s*[<=>!]+\s*[\$\w+]+\s*\;\s*)(\$\w+[+-=\/\*\s\w\$]+)\)(.*?)#endfor/s';

    /**
     * string to replace the pattern.
     *
     * @return string
     */
    public function replace(array $match, string $file) : string
    {
        return '<?php for('.trim($match[1]).''.trim($match[2]).''.trim($match[3]).'):?>'.trim($match[4]).'<?php endfor;?>';
    }
}
