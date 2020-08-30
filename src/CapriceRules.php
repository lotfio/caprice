<?php

namespace Caprice;

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
    public function add(string $directive, $callback)
    {
        $this->rules = [
            'directive' => $directive,
            'callback'  => $callback
        ];
    }
    
}