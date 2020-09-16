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

use Caprice\Contracts\CapriceInterface;
use Caprice\Exception\CapriceException;

class Caprice implements CapriceInterface
{   
    /**
     * caprice trait
     */
    use CapriceTrait;

    /**
     * rules array
     *
     * @var array
     */
    protected $rules;

    /**
     * parser 
     *
     * @var object
     */
    protected $parser;

    /**
     * compile from directory
     *
     * @var  string
     */
    protected $compileFromDir = './';

    /**
     * compile to directory
     *
     * @var  string
     */
    protected $compileToDir   = './';

    /**
     * set up
     */
    public function __construct()
    {
        $this->rules  = new CapriceRules;
        $this->parser = new RulesParser;
    }

    /**
     * add directive method 
     *
     * @param   string $directive
     * @param   mixed $callback
     * @param   bool $custom 
     * @return  CapriceRules
     */
    public function directive(string $directive, $callback, $custom = false) : CapriceRules
    {
        return $this->rules->add($directive, $callback, $custom);
    }

    /**
     * compile cap file
     *
     * @param string $filename
     * @return boolean
     */
    public function compile(string $filename) : string
    {
        // load predefined
        $this->loadPredefinedDirectives();

        $compiler = new Compiler($this->parser, $this->rules);
        
        if($compiler->compile($this->compileFromDir . $filename, $this->compileToDir) === TRUE)
        {
            return $this->compileToDir . SHA1($filename) . '.php';
        }

        return FALSE;
    }
}