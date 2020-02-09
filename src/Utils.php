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
use Caprice\Exception\FileNotFoundException;

class Utils
{
    /**
     * hide sections.
     *
     * @param string $file
     *
     * @return string
     */
    public static function hideSections(string $file) : string
    {
        return preg_replace('/#section\s*\((.*?)\)(.*?)#endsection/s', null, $file);
    }

    /**
     * remove extra lines on a file.
     *
     * @param string $file
     *
     * @return void
     */
    public static function removeExtraLines(string $file) : string
    {
        return preg_replace("~[\r\n]+~", "\r\n", trim($file)); //remove extra lines
    }

    /**
     * extract php file namespace
     *
     * @param  string $file
     * @return ?string
     */
    public static function getNamespace(string $file) : ?string
    {
        $ns = NULL;

        if(!file_exists($file))
            throw new FileNotFoundException("can scan for namespace file not found ", 4);
        $handle = fopen($file, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                if (strpos($line, 'namespace') === 0) {
                    $parts = explode(' ', $line);
                    $ns = rtrim(trim($parts[1]), ';');
                    break;
                }
            }
            fclose($handle);
        }
        return $ns;
    }

    /**
     * scan for directives method
     *
     * @param  string $directory
     * @param  string $namespace
     * @return array
     */
    public static function scanForDirectives(string $directory, $namespace = NULL) : array
    {
        // directives
        $directives = array();

        // scan directives folder
        $dir = scandir($directory);
        $dir = array_filter($dir, function($elem){
            return ($elem != '.' && $elem != '..' && strpos($elem, '.php') !== false) ? $elem : NULL;
        });
        $dir = array_values($dir);

        if (count($dir) > 0) {

            // get namespace for first or use default namespace
            $namespace  = (is_null($namespace)) ? self::getNamespace(rtrim($directory,'/') . '/' . $dir[0]) : $namespace;

            // mach all directives to their namespace
            foreach ($dir as $directive) {
                $directives[] = $namespace . '\\' . ucfirst(rtrim($directive, '.php')) . "::class";
            }
        }
        // return an associative array of directives with the namespace
        return $directives;

    }
}
