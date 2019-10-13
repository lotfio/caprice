<?php

namespace Tests\Unit;

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

use Caprice\Directives;
use Caprice\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /**
     * init parser.
     *
     * @return void
     */
    public function setUp() : void
    {
        $this->parser = new Parser(dirname(__DIR__) . '/stub/');
    }

    /**
     * test code block.
     *
     * @return void
     */
    public function testCodeBlock()
    {
        $directive = new Directives\CodeBlock();
        $string = '(( $var = "my variable" ))';
        $this->assertSame('<?php $var = "my variable"?>', $this->parser->parse($directive, $string));
    }

    /**
     * test echo statement.
     *
     * @return void
     */
    public function testEchoStatement()
    {
        $directive = new Directives\EchoStatement();
        $string = '(- "my echo" -)';
        $this->assertSame('<?="my echo"?>', $this->parser->parse($directive, $string));
    }

    /**
     * test echo escaped.
     *
     * @return void
     */
    public function testEchoEscapedStatement()
    {
        $directive = new Directives\EchoEscapedStatement();
        $string = '(= "my echo escaped" =)';
        $this->assertSame('<?=htmlentities("my echo escaped", ENT_QUOTES, \'UTF-8\');?>', $this->parser->parse($directive, $string));
    }

    /**
     * test array access directive.
     *
     * @return void
     */
    public function testParseArrayAccessStatement()
    {
        $directive = new Directives\ArrayAccessStatement();
        $string = '$array.property';
        $this->assertSame('$array["property"]', $this->parser->parse($directive, $string));
    }

    /**
     * test if statement.
     *
     * @return void
     */
    public function testIfStatement()
    {
        $directive = new Directives\IfStatement();
        $string = '#if (is_int(10))';
        $this->assertSame('<?php if(is_int(10)):?>', $this->parser->parse($directive, $string));
    }

    /**
     * test else statement.
     *
     * @return void
     */
    public function testElseStatement()
    {
        $directive = new Directives\ElseStatement();
        $string = '#else';
        $this->assertSame('<?php else:?>', $this->parser->parse($directive, $string));
    }

    /**
     * test elseif statement.
     *
     * @return void
     */
    public function testElseIfStatement()
    {
        $directive = new Directives\ElseIfStatement();
        $string = '#elif (is_string(10))';
        $this->assertSame('<?php elseif(is_string(10)):?>', $this->parser->parse($directive, $string));
    }

    /**
     * test end if statement.
     *
     * @return void
     */
    public function testEndIfStatement()
    {
        $directive = new Directives\EndIfStatement();
        $string = '#endif';
        $this->assertSame('<?php endif;?>', $this->parser->parse($directive, $string));
    }

    /**
     * test for in statement.
     *
     * @return void
     */
    public function testForInStatement()
    {
        $directive = new Directives\ForInStatement();
        $string = '#for ($name => $last_name in $names)#endfor';
        $this->assertSame('<?php foreach($names as $name => $last_name):?><?php endforeach;?>', $this->parser->parse($directive, $string));
    }

    /**
     * test for in statement value only no key.
     *
     * @return void
     */
    public function testForInValueOnlyStatement()
    {
        $directive = new Directives\ForInValueOnlyStatement();
        $string = '#for ($name in $names)#endfor';
        $this->assertSame('<?php foreach($names as $name):?><?php endforeach;?>', $this->parser->parse($directive, $string));
    }

    /**
     * test for loop.
     *
     * @return void
     */
    public function testForLoop()
    {
        $directive = new Directives\ForLoop();
        $string = '#for ($i = 0; $i <=10; $i++)#endfor';
        $this->assertSame('<?php for($i = 0;$i <=10;$i++):?><?php endfor;?>', $this->parser->parse($directive, $string));
    }

    /**
     * test while loop.
     *
     * @return void
     */
    public function testWhileLoop()
    {
        $directive = new Directives\WhileLoop();
        $string = '#while (TRUE)#endwhile';
        $this->assertSame('<?php while(TRUE):?><?php endwhile;?>', $this->parser->parse($directive, $string));
    }

    /**
     * test break statement.
     *
     * @return void
     */
    public function testBreakStatement()
    {
        $directive = new Directives\BreakStatement();
        $string = '#break';
        $this->assertSame('<?php break;?>', $this->parser->parse($directive, $string));
    }

    /**
     * test continue statement.
     *
     * @return void
     */
    public function testContinueStatement()
    {
        $directive = new Directives\ContinueStatement();
        $string = '#continue';
        $this->assertSame('<?php continue;?>', $this->parser->parse($directive, $string));
    }

    /**
     * test include statement.
     *
     * @return void
     */
    public function testIncludeStatement()
    {
        $directive = new Directives\IncludeStatement();
        $string = '#include("ex")';
        $this->assertSame('', $this->parser->parse($directive, $string));
    }

    /**
     * test require statement.
     *
     * @return void
     */
    public function testRequireStatement()
    {
        $directive = new Directives\IncludeStatement();
        $string = '#require("ex")';
        $this->assertSame('', $this->parser->parse($directive, $string));
    }

    /**
     * test extends statement.
     *
     * @return void
     */
    public function testExtendsStatement()
    {
        $directive = new Directives\ExtendsStatement();
        $string = '#extends("ex")';
        $this->assertSame('', $this->parser->parse($directive, $string));
    }

    /**
     * test yield not found statement.
     *
     * @return void
     */
    public function testYieldStatementNotFound()
    {
        $directive = new Directives\YieldStatement();
        $string = '#yield("caprice")';
        $this->assertSame('section "caprice" not found', $this->parser->parse($directive, $string));
    }

    /**
     * test yield found statement.
     *
     * @return void
     */
    public function testYieldStatementFound()
    {
        $directive = new Directives\YieldStatement();
        $string  = '#yield("caprice")';
        $string .= '#section("caprice")#endsection';

        $this->assertSame('#section("caprice")#endsection', $this->parser->parse($directive, $string));
    }

     /**
     * test dump found statement.
     *
     * @return void
     */
    public function testDumpStatementFound()
    {
        $directive = new Directives\DumpStatement();
        $string    = '#dump ($var) #dd($var)';
        $this->assertSame('<?= dump($var);?> <?= dump($var);?>', $this->parser->parse($directive, $string));
    }
}
