<?php

namespace Caprice\Contracts;

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     1.0.0
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2019
 * @license     MIT
 * @link        https://github.com/lotfio/caprice
 *
 */
use Caprice\CapriceRules;

interface CapriceInterface
{
    /**
     * add a directive method.
     *
     * @param string $directive
     * @param mixed  $callback
     *
     * @return CapriceRules
     */
    public function directive(string $directive, $callback): CapriceRules;
}
