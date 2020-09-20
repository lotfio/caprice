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
use Caprice\Contracts\RuleParserInterface;
use Caprice\Exception\CapriceException;

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
     * recompile mode
     *
     * @var  bool
     */
    protected $recompile = false;

    /**
     * setup compiler
     *
     * @param RulesParserInterface $rules
     */
    public function __construct(RuleParserInterface $parser, CapriceRules $rules, bool $recompile)
    {
        $this->parser    = $parser;
        $this->rules     = $rules;
        $this->recompile = $recompile;
    }

    /**
     * check if file is modified
     *
     * @param  string $filename
     * @return boolean
     */
    protected function isModified(string $file, string $tempFile): bool
    {
        return !file_exists($tempFile) || filemtime($file) !== filemtime($tempFile);
    }

    /**
     * compile caprice file
     *
     * @param  string $filename
     * @param  string $outputLocation
     * 
     * @return string
     */
    public function compile(string $filename, string $outputLocation): string
    {
        if(!file_exists($filename))
            throw new CapriceException("file $filename not found.");

        // apply parsing to al rules
        $rules    = $this->rules->list();

        $content  = \file_get_contents($filename);
        $tempFile = $outputLocation . SHA1($filename) . '.php';

        if($this->recompile || $this->isModified($filename, $tempFile)) // if cap file is modified or doesn't exists
        {
            for($i = 0; $i < count($rules); $i++)
                foreach($rules as $rule)
                    $content = $this->parser->parse($content, $rule);

            //save file 
            if(file_put_contents($tempFile, $content))
                touch($filename); touch($tempFile);
        }
        
        if(!file_exists($tempFile))
            throw new CapriceException("error compiling, file $tempFile not found.");

        return require_once $tempFile;
    }
}
