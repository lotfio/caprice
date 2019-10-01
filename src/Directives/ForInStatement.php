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

class ForInStatement implements DirectiveInterface
{
    /**
     * pattern property
     *
     * @var string
     */
    public $pattern = '/#for\s*\((\$\w+\s*=>\s*\$\w+\s*)(\s*in\s*)(\$\w+\s*)\)(.*?)#endfor/s';

    /**
     * string to replace the pattern
     *
     * @return void
     */
    public function replace(array $match) : string
    {
        return '<?php foreach('.trim($match[3]).' as '.trim($match[1]).'):?>'.trim($match[4]).'<?php endforeach;?>';
    }
}