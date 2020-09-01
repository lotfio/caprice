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
        $this->rules  = new CapriceRules;
        $this->parser = new RulesParser;
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
     * compile cap file
     *
     * @param  string $inputFile
     * @param  string $outputFile
     * @return CapriceCompiler
     */
    public function compile(string $inputFile, string $outputFile)
    {
        // apply parsing to al rules
        $rules = &$this->rules->list();

        $file = "
        
            #if (10 == 10)

            #endif

            #if (10 == 10)

            #endif

            #dump('hello')
        
            #for(name in names)
                (= name =)
            #endfor
        ";


        foreach($rules as $rule)
           $file = $this->parser->parse($file, $rule);

        echo $file;
        // generate view file
    }
}