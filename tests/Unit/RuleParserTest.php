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

use Caprice\Exception\CapriceException;
use Caprice\RuleParser;
use PHPUnit\Framework\TestCase;

class RuleParserTest extends TestCase
{
    /**
     * parser.
     *
     * @var object
     */
    private $parser;

    /**
     * set up.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->parser = new RuleParser();
    }

    /**
     * test parse callback.
     *
     * @return void
     */
    public function testParseCallback()
    {
        $file = '#test';
        $rule = [
            'directive' => '~#test(\s*\(((.*))\))?~',
            'replace'   => function () { return 'replaced !'; },
        ];

        $out = $this->parser->parse($file, $rule);

        $this->assertSame('replaced !', $out);
    }

    /**
     * test parse callback with match.
     *
     * @return void
     */
    public function testParseCallbackWithMatch()
    {
        $file = '#test';
        $rule = [
            'directive' => '~#test(\s*\(((.*))\))?~',
            'replace'   => function ($match) { return 'replaced !'.$match; },
        ];

        $out = $this->parser->parse($file, $rule);

        $this->assertSame('replaced !#test', $out);
    }

    /**
     * test class method not class found.
     *
     * @return void
     */
    public function testParseNoClass()
    {
        $file = '#test';
        $rule = [
            'directive' => '~#test(\s*\(((.*))\))?~',
            'replace'   => \Caprice\Directives\PhpDirectives::class, // wrong class
        ];

        $this->expectException(CapriceException::class);
        $this->parser->parse($file, $rule);
    }

    /**
     * test parse class method.
     *
     * @return void
     */
    public function testParseClassMethod()
    {
        $file = '#test';
        $rule = [
            'directive' => '~#test(\s*\(((.*))\))?~',
            'replace'   => \Caprice\Directives\PhpDirective::class,
        ];

        $out = $this->parser->parse($file, $rule);

        $this->assertSame('<?php ', $out);
    }
}
