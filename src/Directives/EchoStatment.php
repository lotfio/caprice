<?php

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

namespace Caprice\Directives;

use Caprice\Contracts\DirectiveInterface;

class EchoStatment implements DirectiveInterface
{
    /**
     * pattern property
     *
     * @var string
     */
    public $pattern = '/\(\-{1}(.*?)\-{1}\)/s';

    /**
     * string to replace the pattern
     *
     * @return void
     */
    public function replace(array $match) : string
    {
        return '<?='.trim($match[1]).'?>';
    }
}