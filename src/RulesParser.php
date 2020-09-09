<?php

namespace Caprice;

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     1.0.0
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2019
 * @license     MIT
 * @link        https://github.com/lotfio/caprice
 *
 */

use Caprice\Contracts\RulesParserInterface;
use Caprice\Exception\CapriceException;

class RulesParser implements RulesParserInterface
{
    /**
     * rule parser
     *
     * @param array $rules
     * @return void
     */
    public function parse(string $file, array $rules)
    {
        return preg_replace_callback($rules['directive'], function($match) use ($rules, $file)
        {
            if(is_string($rules['replace']) && !$rules['replace'] instanceof \Closure)
                return $this->parseClassMethod($rules['replace'], $match, $file);

            return $this->parseCallback($rules['replace'], $match, $file);
            
        }, $file);
    }

    /**
     * parse callback
     *
     * @param  mixed $callback
     * @param  array $parameters
     * @param  string $file
     * @return void
     */
    protected function parseCallback($callback, $parameters, $file)
    {
        return call_user_func($callback, $parameters[1] ?? $parameters[0], $file);
    }

    /**
     * parse class method
     *
     * @param  mixed $class
     * @param  array $parameters
     * @param string $file
     * @return void
     */
    protected function parseClassMethod($class, $parameters, $file)
    {
        if(!\class_exists($class))
            throw new CapriceException("class $class not found");

        $obj = new $class;

        if(!\method_exists($obj, 'replace'))
            throw new CapriceException("class method parse not found");

        return call_user_func_array([$obj, 'replace'], [$parameters[1] ?? $parameters[0], $file]);
    }
}