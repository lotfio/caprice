<?php

namespace Caprice;

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     0.3.0
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2019
 * @license     MIT
 * @link        https://github.com/lotfio/caprice
 *
 */

use Caprice\Contracts\DirectiveInterface;
use Caprice\Contracts\ParserInterface;

class Parser implements ParserInterface
{
    /**
     *  directives to apply for parsing
     *
     * @var array
     */
    private $directives = array(

    );

    /**
     * base files directory.
     *
     * @var string
     */
    private $filesDir;

    /**
     * file to be parsed.
     *
     * @var string
     */
    private $file;

    /**
     * constructor.
     *
     * @param string $filesDir
     */
    public function __construct(string $filesDir, $extendDirectives = NULL)
    {
        $this->filesDir     = $filesDir;

        $this->directives   = Utils::scanForDirectives(__DIR__ . '/Directives');
        if(!is_null($extendDirectives))
            $this->directives = array_merge($this->directives, Utils::scanForDirectives($extendDirectives));
    }

    /**
     * parse method.
     *
     * @param DirectiveInterface $directive
     * @param string             $file
     *
     * @return void
     */
    public function parse(DirectiveInterface $directive, string $file) : string
    {
        return preg_replace_callback($directive->pattern, function (array $match) use ($directive, $file) {

            // $file param is the original file
            // can be used if an extra match is nedded
            return $directive->replace($match, $file, $this->filesDir);
        }, $file, $limit = -1);
    }

    /**
     * parse caprice syntax using all the directives.
     *
     * @param string $file
     *
     * @return void
     */
    public function parseFile(string $file) : string
    {
        $this->file = $file;

        foreach ($this->directives as $class) {

            $class = rtrim($class, '::class');

            if (class_exists($class)) {
                $this->file = $this->parse(new $class(), $this->file);
            }
        }

        return Utils::hideSections($this->file);
    }
}
