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
    public function add(string $directive, $callback) : self
    {
        $this->checkValidDirective($directive);

        $this->rules[] = [
            'directive' => '~' . $directive . '(\s*\(((.*))\))?~',
            'replace'   =>       $callback
        ];

        return $this;
    }

    /**
     * check if directive is valid
     *
     * @param  string $directive
     * @return void
     */
    public function checkValidDirective(string $directive)
    {
        if(preg_match('/[\~\(\)\.\*]/', $directive))
            throw new \Exception("Directive characters not allowed.");
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