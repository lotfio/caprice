<?php

namespace Caprice;

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

class CapriceRules
{
    /**
     * caprice rules
     *
     * @var array
     */
    private $rules = [

    ];

    /**
     * add new directive rule
     *
     * @param  string $directive
     * @param  mixed $callback
     * @return void
     */
    public function add(string $directive, $callback, bool $custom) : self
    {
        $this->rules[] = [
            'directive' => $custom ? $directive : '~' . $directive . '(\s*\(((.*))\))?~',
            'replace'   => $callback
        ];

        return $this;
    }

    /**
     * list all available rules
     *
     * @return array
     */
    public function &list() : array
    {
        return $this->rules;
    }
}