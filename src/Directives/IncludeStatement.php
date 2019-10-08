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

class IncludeStatement implements DirectiveInterface
{
    /**
     * pattern property
     *
     * @var string
     */
    public $pattern = '/(#include|#require)\s*\((.*?)\)/s';

    /**
     * string to replace the pattern
     *
     * @return string
     */
    public function replace(array $match) : string
    {
        $file = str_replace("'", NULL, $match[2]);
        $file = str_replace('"', NULL, $file);
        $file = str_replace('.php', NULL, $file);
        $file = str_replace('.cap.php', NULL, $file);
        $file = str_replace('.', '/', $file) . '.php';

        return '<?php '. trim($match[1], '#') .'("' . $file . '");?>';
    }
}