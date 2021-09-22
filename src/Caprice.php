<?php

namespace Caprice;

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     1.1.0
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
     * caprice trait.
     */
    use CapriceTrait;

    /**
     * rules object.
     *
     * @var CapriceRules
     */
    protected CapriceRules $rules;

    /**
     * parser object.
     *
     * @var RuleParser
     */
    protected RuleParser $parser;

    /**
     * compiler object
     *
     * @var Compiler
     */
    protected Compiler $compiler;

    /**
     * set up.
     */
    public function __construct()
    {
        $this->rules    = new CapriceRules();
        $this->parser   = new RuleParser();
        $this->compiler = new Compiler($this->parser, $this->rules);
    }

    /**
     * add directive method.
     *
     * @param string $directive
     * @param mixed  $callback
     * @param bool   $custom
     *
     * @return CapriceRules
     */
    public function directive(string $directive, mixed $callback, bool $custom = false): CapriceRules
    {
        return $this->rules->add(
            $directive, $callback, $custom
        );
    }

    /**
     * compile cap file.
     *
     * @param string $file
     *
     * @return string
     */
    public function compile(string $file): string
    {
        return $this->compiler->compile(
            $this->compileFromDir, $this->compileToDir,
            $file, $this->recompile
        );
    }
}
