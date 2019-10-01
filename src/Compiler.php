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

 use Caprice\Contracts\CompilerInterface;

class Compiler implements CompilerInterface
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $file;

    /**
     * Undocumented function
     *
     * @param string $file
     * @param string $cache
     * @return void
     */
    public function compile(string $fileName, string $cache)
    {
        $this->file  = file_get_contents($fileName);

        // get parsed content and compile it to a file
        //check if not changed do not compile again

        $parser     = new Parser;
        $this->file = $parser($this->file);

        if(!is_dir($cache))
            die("please provide a correct cache directory");

        $cacheFile = $cache .'/'. md5($fileName) . '.php';


        if(!$this->isSame($fileName, $cacheFile)) // not same time
        {
            file_put_contents($cacheFile, $this->file);
            touch($fileName, time());
        }

        return $cacheFile;
    }

    public function isSame(string $file, string $cached)
    {
        $template  = filemtime($file);
        $generated = @filemtime($cached); // just ignore and generate a file if no file exists

        return $template === $generated;
    }
}