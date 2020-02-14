<?php

namespace Caprice\Contracts;

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

interface ParserInterface
{
    /**
     * parse single method.
     *
     * This method gets a directive as first parameter
     * and a file string as the second parameter
     * 
     * this method replaces the content of the file 
     * based on the given directive pattern
     *
     * @param DirectiveInterface $directive
     * @param string             $file
     *
     * @return void
     */
    public function parseSingle(DirectiveInterface $directive, string $file): string;

    /**
     * parse file method.
     *
     * this method applies all the directives on the file
     * using the parse method
     *
     * @param string $file
     *
     * @return string
     */
    public function parse(string $file): string;
}
