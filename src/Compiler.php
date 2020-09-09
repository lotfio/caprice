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

use Caprice\Contracts\CompilerInterface;
use Caprice\Exception\DirNotFoundException;
use Caprice\Exception\FileNotFoundException;
use Caprice\Contracts\RulesParserInterface;

class Compiler implements CompilerInterface
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
     * setup compiler
     *
     * @param RulesParserInterface $rules
     */
    public function __construct(RulesParserInterface $parser, CapriceRules $rules)
    {
        $this->parser = $parser;
        $this->rules  = $rules;
    }

    /**
     * check if file is modified
     *
     * @param string $filename
     * @return boolean
     */
    protected function isModified(string $file, string $tempFile) : bool
    {
        
    }

    /**
     * compile caprice file
     *
     * @param  string $filename
     * @return string
     */
    public function compile(string $filename, string $outputLocation) : bool
    {
        // apply parsing to al rules
        $rules = &$this->rules->list();

        $file  = \file_get_contents('index.cap.php');

        for($i = 0; $i < count($rules); $i++)
            foreach($rules as $rule)
                $file = $this->parser->parse($file, $rule);

        

        return $file;
    }
}
