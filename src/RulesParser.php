<?php

namespace Caprice;

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
        return preg_replace_callback($rules['directive'], function($match) use ($rules)
        {
            if(is_string($rules['replace']) && !$rules['replace'] instanceof \Closure)
                return $this->parseClassMethod($rules['replace'], $match);

            return $this->parseCallback($rules['replace'], $match);
            
        }, $file);
    }

    /**
     * Undocumented function
     *
     * @param  [type] $callback
     * @param  [type] ...$parameters
     * @return void
     */
    protected function parseCallback($callback, $parameters)
    {
        return call_user_func($callback, $parameters[1] ?? $parameters[0]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $method
     * @param [type] ...$parameters
     * @return void
     */
    protected function parseClassMethod($class, $parameters)
    {
        if(!\class_exists($class))
            throw new CapriceException("class $class not found");

        $obj = new $class;

        if(!\method_exists($obj, 'replace'))
            throw new CapriceException("class method parse not found");

        return call_user_func_array([$obj, 'replace'], [$parameters[1] ?? $parameters[0]]);
    }
}