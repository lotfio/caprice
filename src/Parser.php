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
     *  directives to apply for parsing.
     *
     * @var array
     */
    private $directives = [

    ];

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
    public function __construct(string $filesDir, $extendDirectives = null)
    {
        $this->filesDir = $filesDir;

        $this->directives = Utils::scanForDirectives(__DIR__.'/Directives');
        if (!is_null($extendDirectives)) {
            $this->directives = array_merge($this->directives, Utils::scanForDirectives($extendDirectives));
        }
    }

    /**
     * parse single directive method.
     *
     * @param DirectiveInterface $directive
     * @param string             $file
     *
     * @return void
     */
    public function parseSingle(DirectiveInterface $directive, string $file): string
    {
        return preg_replace_callback($directive->pattern, function (array $match) use ($directive, $file) {
            // apply directive replace method
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
    public function parse(string $file): string
    {
        $this->file = $file;

        foreach ($this->directives as $directive) {

            //remove class suffix
            $directive = str_replace('::class', NULL, $directive);

            if (class_exists($directive)) {
                $this->file = $this->parseSingle(new $directive, $this->file);
            }
        }

        return Utils::hideSections($this->file);
    }
}
