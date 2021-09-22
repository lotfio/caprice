<?php

namespace Caprice;

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     1.1.0
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2019
 * @license     MIT
 * @link        https://github.com/lotfio/caprice
 *
 */

use Caprice\Contracts\RuleParserInterface;
use Caprice\Exception\CapriceException;

class RuleParser implements RuleParserInterface
{
    /**
     * rule parser.
     *
     * @param string $file
     * @param array  $rule
     * @param array  $extras
     * 
     * @return string
     */
    public function parse(string $file, array $rule, array $extras): string
    {
        return preg_replace_callback($rule['directive'], function (mixed $match) use ($rule, $file, $extras): string {
            if ($rule['replace'] instanceof \Closure) {
                return $this->parseCallback($rule['replace'], $match, $file, $extras);
            }

            return $this->parseClassMethod($rule['replace'], $match, $file, $extras);
        }, $file);
    }

    /**
     * parse callback.
     *
     * @param callable  $callback
     * @param array     $parameters
     * @param string    $file
     * @param array     $extras
     *
     * @return string
     */
    protected function parseCallback(callable $callback, array $parameters, string $file, array $extras): string
    {
        return call_user_func($callback, $parameters[1] ?? $parameters[0], $file, $extras);
    }

    /**
     * parse class method.
     *
     * @param string  $class
     * @param array   $parameters
     * @param string  $file
     * @param array   $extras
     * 
     * @return string
     */
    protected function parseClassMethod(string $class, array $parameters, string $file, array $extras): string
    {
        if (!\class_exists($class)) {
            throw new CapriceException("class $class not found");
        }
        $obj = new $class();

        if (!\method_exists($obj, 'replace')) {
            throw new CapriceException('class method parse not found');
        }

        return call_user_func_array([$obj, 'replace'], [$parameters[1] ?? $parameters[0], $file, $extras]);
    }
}
