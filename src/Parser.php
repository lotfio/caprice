<?php

namespace Caprice;

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     0.2.0
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
     * constructor
     *
     * @param string $filesDir
     */
    public function __construct(string $filesDir)
    {
        $this->filesDir = $filesDir;
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

        foreach (glob(__DIR__.'/Directives/*.php') as $class) {
            $class = trim((explode('Directives', $class)[1]), '/');
            $class = 'Caprice\\Directives\\'.ucfirst($class);
            $class = substr($class, 0, strpos($class, '.php'));

            if (class_exists($class)) {
                $this->file = $this->parse(new $class(), $this->file);
            }
        }

        return Utils::hideSections($this->file);
    }
}
