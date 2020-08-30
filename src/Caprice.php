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

use Caprice\Contracts\CapriceInterface;
use Caprice\Exception\DirNotFoundException;
use Caprice\Exception\FileNotFoundException;

class Caprice implements CapriceInterface
{
    /**
     * caprice rules
     *
     * @var array
     */
    protected $rules;

    /**
     * set up
     */
    public function __construct()
    {
        $this->rules = new CapriceRules;
    }

    /**
     * add directive method 
     *
     * @param  string $directive
     * @param  mixed $callback
     * @return CapriceRules
     */
    public function directive(string $directive, $callback) : CapriceRules
    {
        return $this->rules->add($directive, $callback);
    }

    /**
     * Undocumented function
     *
     * @param  string $inputFile
     * @param  string $outputFile
     * @return CapriceCompiler
     */
    public function compile(string $inputFile, string $outputFile) : CapriceCompiler
    {

    }
}