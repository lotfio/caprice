<?php

namespace Tests\Unit;

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

use Caprice\CapriceRules;
use PHPUnit\Framework\TestCase;

class CapriceRulesTest extends TestCase
{
    /**
     * caprice rules.
     *
     * @var object
     */
    private $rules;

    /**
     * set up.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->rules = new CapriceRules();
    }

    /**
     * test add rule.
     *
     * @return void
     */
    public function testAddCapriceRule()
    {
        $this->rules->add('#test', 'callback', false);

        $this->assertSame("~#test(\s*\(((.*))\))?~", $this->rules->getRules()[0]['directive']);
        $this->assertSame('callback', $this->rules->getRules()[0]['replace']);
    }

    /**
     * test add rule (custom regex).
     *
     * @return void
     */
    public function testAddCustomCapriceRule()
    {
        $this->rules->add('/regex/', 'callback', true);

        $this->assertSame('/regex/', $this->rules->getRules()[0]['directive']);
        $this->assertSame('callback', $this->rules->getRules()[0]['replace']);
    }

    /**
     * test get rules.
     *
     * @return void
     */
    public function testGetCapriceRules()
    {
        $this->rules->add('#test', 'callback', false);
        $this->rules->add('/#test/', 'callback', true);

        $this->assertCount(2, $this->rules->getRules());
    }
}
