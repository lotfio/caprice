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
    protected $compileFromDir;

    /**
     * compile to directory
     *
     * @var  string
     */
    protected $compileToDir;

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
     * set compile locations
     *
     * @param string $compileFromDir
     * @param string $compileToDir
     * @return void
     */
    public function setLocations(string $compileFromDir, string $compileToDir) : void
    {
        if(!is_dir($compileFromDir) || !is_writable($compileFromDir))
            throw new CapriceException("input location $compileFromDir is not a valid writable directory.");

        if(!is_dir($compileToDir) || !is_writable($compileToDir))
            throw new CapriceException("input location $compileToDir is not a valid writable directory.");

        $this->compileFromDir = $compileFromDir;
        $this->compileToDir   = $compileToDir;
    }

    /**
     * load predefined directives
     *
     * @return void
     */
    public function loadDirectives() : void
    {
        $caprice = $this;
        require_once 'rules.php';
    }

    /**
     * compile cap file
     *
     * @param string $filename
     * @return boolean
     */
    public function compile(string $filename) : string
    {
        $this->loadDirectives();
        $compiler = new Compiler($this->parser, $this->rules);
        return $compiler->compile($this->compileFromDir . $filename, $this->compileToDir);
    }
}