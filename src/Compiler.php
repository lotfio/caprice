<?php

namespace Caprice;

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     1.1.2
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
     * parser.
     *
     * @var RuleParserInterface
     */
    protected RuleParserInterface $parser;

    /**
     * rules.
     *
     * @var CapriceRules
     */
    protected CapriceRules $rules;

    /**
     * setup compiler.
     *
     * @param RuleParserInterface $parser
     * @param CapriceRules        $rules
     * @param bool $recompile
     */
    public function __construct(RuleParserInterface $parser, CapriceRules $rules)
    {
        $this->parser = $parser;
        $this->rules = $rules;
    }

    /**
     * check if file is modified.
     *
     * @param string $filename
     * @param string $tempFile
     *
     * @return bool
     */
    protected function isModified(string $file, string $tempFile): bool
    {
        return !file_exists($tempFile) || filemtime($file) !== filemtime($tempFile);
    }

    /**
     * compile method
     *
     * @param string  $from location
     * @param string  $to location 
     * @param string  $file
     * @param boolean $recompile
     * 
     * @return string
     */
    public function compile(string $from, string $to, string $file, bool $recompile): string
    {
        $file = $from . dotPath($file);

        if (!file_exists($file)) {
            throw new CapriceException("file $file not found.");
        }
        // apply parsing to al rules
        $rules = $this->rules->getRules();

        $content = \file_get_contents($file);
        $tempFile = $to.sha1($file).'.php';

        if ($recompile || $this->isModified($file, $tempFile)) { // if cap file is modified or doesn't exists
            for ($i = 0; $i < count($rules); $i++) {
                foreach ($rules as $rule) {
                    $content = $this->parser->parse($content, $rule, [ // passing extra parameters needed for parsing
                        "compileFrom" => $from,
                        "compileTo"   => $to
                    ]);
                }
            }

            //save file
            if (file_put_contents($tempFile, trim($content))) {
                touch($file);
            }
            touch($tempFile);
        }

        if (!file_exists($tempFile)) {
            throw new CapriceException("error compiling, file $tempFile not found.");
        }

        return $tempFile;
    }
}
