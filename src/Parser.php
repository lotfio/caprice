<?php

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     0.1.0
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2019
 * @license     MIT
 * @link        https://github.com/lotfio/caprice
 *
 */

namespace Caprice;

use Caprice\Contracts\ParserInterface;
use Caprice\Contracts\DirectiveInterface;

class Parser implements ParserInterface
{
    /**
     * parse method
     *
     * @param  DirectiveInterface $directive
     * @param  string $file
     * @return void
     */
    public function parse(DirectiveInterface $directive, string $file)
    {
        $this->file = $file;

        preg_replace_callback($directive->pattern, function(array $match) use ($directive){

            return $directive->replace($match);

        }, $this->file, $limit = '-1');
    }

    /**
     * Undocumented function
     *
     * @param string $file
     * @return void
     */
    public function __invoke(string $file)
    {
        foreach(glob(__DIR__."/Directives/*.php") as $class)
        {
            $class = trim((rtrim(explode("Directives", $class)[1], ".php")), "/");
            $class = "Caprice\\Directives\\" . ucfirst($class);

            if(class_exists($class))
            {
                $this->parse(new $class, $file);
            }
        }

        echo $this->file;
    }
}