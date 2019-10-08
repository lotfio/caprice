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
use Caprice\Exception\FileNotFoundException;
use Caprice\Exception\DirNotFoundException;

class Compiler implements CompilerInterface
{
    /**
     * file to compile
     *
     * @var string
     */
    private $file;

    /**
     * compile caprice file method
     *
     * @param  string $file
     * @param  string $cache
     * @return string compiled file
     */
    public function compile(string $fileName, string $cache) : string
    {
        if(!file_exists($fileName))
            throw new FileNotFoundException("file $fileName not found", 4);

        if(!is_dir($cache))
            throw new DirNotFoundException("$cache is not a valid directory", 4);

        //cache file
        $cacheFile  = $cache .'/'. md5($fileName) . '.php';

        if($this->isModified($fileName, $cacheFile)) // if modifed recompile
        {
            // read caprice file    
            $this->file  = file_get_contents($fileName);

            // parse caprice file
            $parser     = new Parser;
            $this->file = $parser->parseFile($this->file);

            file_put_contents($cacheFile, $this->removeExtraLines($this->file));
            touch($fileName, time()); // update caprice time to be the same as cahed file to detect any changes later
        }

        return $cacheFile;
    }

    /**
     * check if caprice file eis modified
     *
     * @param  string $file
     * @param  string $cached
     * @return boolean
     */
    public function isModified(string $file, string $cached) : bool
    {
        $template  = filemtime($file);
        $generated = @filemtime($cached); // just ignore and generate a file if no file exists

        return $template !== $generated;
    }

    /**
     * remove extra lines on a file
     *
     * @param string $file
     * @return void
     */
    public function removeExtraLines(string $file) : string
    {
        return preg_replace("~[\r\n]+~", "\r\n", trim($file)); //remove extra lines
    }
}