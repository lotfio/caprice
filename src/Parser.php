<?php namespace Caprice;

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

use Caprice\Contracts\ParserInterface;
use Caprice\Contracts\DirectiveInterface;

class Parser implements ParserInterface
{
    /**
     * file to be parsed
     *
     * @var string
     */
    private $file;

    /**
     * parse method
     *
     * @param  DirectiveInterface $directive
     * @param  string $file
     * @return void
     */
    public function parse(DirectiveInterface $directive, $file)
    {
        $this->file = preg_replace_callback($directive->pattern, function(array $match) use ($directive){

            return $directive->replace($match);

        }, $file, $limit = -1);
    }

    /**
     * Undocumented function
     *
     * @param string $file
     * @return void
     */
    public function __invoke(string $file)
    {
        $this->file = $file;

        foreach(glob(__DIR__."/Directives/*.php") as $class)
        {
            $class = trim((explode("Directives", $class)[1]), "/");
            $class = "Caprice\\Directives\\" . ucfirst($class);
            $class = substr($class, 0, strpos($class, ".php"));

            if(class_exists($class))
            {
                $this->parse(new $class, $this->file);
            }
        }

        return $this->file;
    }
}