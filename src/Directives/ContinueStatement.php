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

class ContinueStatement implements DirectiveInterface
{
    /**
     * pattern property
     *
     * @var string
     */
    public $pattern = '/#continue/s';

    /**
     * string to replace the pattern
     *
     * @return void
     */
    public function replace(array $match) : string
    {
        return '<?php continue;?>';
    }
}