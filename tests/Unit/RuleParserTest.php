<?php

namespace Tests\Unit;

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
    protected function setUp(): void
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

        $extras = []; // extra needed parameters like paths 

        $out = $this->parser->parse($file, $rule, $extras);

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
        $extras = []; // extra needed parameters like paths 

        $out = $this->parser->parse($file, $rule, $extras);

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
        $extras = []; // extra needed parameters like paths 

        $this->expectException(CapriceException::class);
        $this->parser->parse($file, $rule, $extras);
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
        $extras = []; // extra needed parameters like paths 

        $out = $this->parser->parse($file, $rule, $extras);

        $this->assertSame('<?php ', $out);
    }
}
