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

use Caprice\Contracts\RuleParserInterface;
use Caprice\Exception\CapriceException;

class RuleParser implements RuleParserInterface
{
    /**
     * rule parser.
     *
     * @param string $file
     * @param array  $rule
     *
     * @return string
     */
    public function parse(string $file, array $rule): string
    {
        return preg_replace_callback($rule['directive'], function (mixed $match) use ($rule, $file) {
            if ($rule['replace'] instanceof \Closure) {
                return $this->parseCallback($rule['replace'], $match, $file);
            }

            return $this->parseClassMethod($rule['replace'], $match, $file);
        }, $file);
    }

    /**
     * parse callback.
     *
     * @param mixed  $callback
     * @param array  $parameters
     * @param string $file
     *
     * @return string
     */
    protected function parseCallback($callback, $parameters, $file): string
    {
        return call_user_func($callback, $parameters[1] ?? $parameters[0], $file);
    }

    /**
     * parse class method.
     *
     * @param mixed  $class
     * @param array  $parameters
     * @param string $file
     *
     * @return string
     */
    protected function parseClassMethod($class, $parameters, $file): string
    {
        if (!\class_exists($class)) {
            throw new CapriceException("class $class not found");
        }
        $obj = new $class();

        if (!\method_exists($obj, 'replace')) {
            throw new CapriceException('class method parse not found');
        }

        return call_user_func_array([$obj, 'replace'], [$parameters[1] ?? $parameters[0], $file]);
    }
}
