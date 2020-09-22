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

use Caprice\Caprice;
use PHPUnit\Framework\TestCase;

class CapriceTest extends TestCase
{
    /**
     * caprice rules
     *
     * @var object
     */
    private $caprice;

    /**
     * set up
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->caprice = (new Caprice)
             ->setCompileLocations(dirname(__DIR__) . '/stub', dirname(__DIR__) . '/stub/cache')
             ->enableRecompile();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function assertCompileOutput(string $expected, string $actual)
    {
        return $this->assertSame($expected, file_get_contents($actual));
    }

    /**
     * test break
     *
     * @return void
     */
    public function testCompileBreakDirective()
    {
        $this->caprice->directive("#break", \Caprice\Directives\BreakDirective::class);
        $out = $this->caprice->compile("break-directive.cap.php");
        $this->assertCompileOutput('<?php break;?>', $out);
    }

    /**
     * test clear comment
     *
     * @return void
     */
    public function testCompileClearCommentsDirective()
    {
        $this->caprice->directive('~<!--(.*)-->~sUm', \Caprice\Directives\ClearCommentDirective::class, true);
        $out = $this->caprice->compile("comments-directive.cap.php");
        $this->assertCompileOutput('', $out);
    }

    /**
     * test clear lines
     *
     * @return void
     */
    public function testCompileClearLinesDirective()
    {
        $this->caprice->directive('/[\r\n]+/', \Caprice\Directives\ClearLinesDirective::class, true);
        $out = $this->caprice->compile("clear-lines-directive.cap.php");
        $this->assertCompileOutput("clearLine\r\nend", $out);
    }

    /**
     * test clear sections
     *
     * @return void
     */
    public function testCompileClearSectionsDirective()
    {
        $this->caprice->directive('/#section\s*\((.*?)\)(.*?)#endsection/s', \Caprice\Directives\ClearLinesDirective::class, true);
        $out = $this->caprice->compile("clear-sections-directive.cap.php");
        $this->assertCompileOutput('', $out);
    }

    /**
     * test continue 
     *
     * @return void
     */
    public function testCompileContinueDirective()
    {
        $this->caprice->directive('#continue', \Caprice\Directives\ContinueDirective::class, false);
        $out = $this->caprice->compile("continue-directive.cap.php");
        $this->assertCompileOutput('<?php continue;?>', $out);
    }

    /**
     * test do while
     *
     * @return void
     */
    public function testCompileDoWhileDirective()
    {
        $this->caprice->directive('#do', \Caprice\Directives\DoWhileDirective::class, false);
        $out = $this->caprice->compile("do-while-directive.cap.php");
        $this->assertCompileOutput('<?php do {;?>', $out);
    }

    /**
     * test dump 
     *
     * @return void
     */
    public function testCompileDumpDirective()
    {
        $this->caprice->directive('#dd', \Caprice\Directives\DumpDirective::class, false);
        $out = $this->caprice->compile("dump-directive.cap.php");
        $this->assertCompileOutput('<?php dump($var);?>', $out);
    }

    /**
     * test echo closing tag 
     *
     * @return void
     */
    public function testCompileEchoCloseDirective()
    {
        $this->caprice->directive('}}', \Caprice\Directives\EchoCloseDirective::class, false);
        $out = $this->caprice->compile("echo-close-directive.cap.php");
        $this->assertCompileOutput(');?>', $out);
    }

    /**
     * test echo open tag 
     *
     * @return void
     */
    public function testCompileEchoOpenDirective()
    {
        $this->caprice->directive('{{', \Caprice\Directives\EchoOpenDirective::class, false);
        $out = $this->caprice->compile("echo-open-directive.cap.php");
        $this->assertCompileOutput('<?=__escape(', $out);
    }

    /**
     * test else 
     *
     * @return void
     */
    public function testCompileElseDirective()
    {
        $this->caprice->directive('#else', \Caprice\Directives\ElseDirective::class, false);
        $out = $this->caprice->compile("else-directive.cap.php");
        $this->assertCompileOutput('<?php else:?>', $out);
    }

    /**
     * test else 
     *
     * @return void
     */
    public function testCompileElseIfDirective()
    {
        $this->caprice->directive('#elseif', \Caprice\Directives\ElseIfDirective::class, false);
        $out = $this->caprice->compile("else-if-directive.cap.php");
        $this->assertCompileOutput('<?php elseif($expression):?>', $out);
    }

    /**
     * test end do while 
     *
     * @return void
     */
    public function testCompileEndDoWhileDirective()
    {
        $this->caprice->directive('#enddo', \Caprice\Directives\EndDoWhileDirective::class, false);
        $out = $this->caprice->compile("end-do-while-directive.cap.php");
        $this->assertCompileOutput('<?php } while($expression);?>', $out);
    }

    /**
     * test end for
     *
     * @return void
     */
    public function testCompileEndForDirective()
    {
        $this->caprice->directive('#endfor', \Caprice\Directives\EndForDirective::class, false);
        $out = $this->caprice->compile("end-for-directive.cap.php");
        $this->assertCompileOutput('<?php endfor;?>', $out);
    }

    /**
     * test end for in
     *
     * @return void
     */
    public function testCompileEndForInDirective()
    {
        $this->caprice->directive('#endforin', \Caprice\Directives\EndForInDirective::class, false);
        $out = $this->caprice->compile("end-for-in-directive.cap.php");
        $this->assertCompileOutput('<?php endforeach;?>', $out);
    }

    /**
     * test end if
     *
     * @return void
     */
    public function testCompileEndIfDirective()
    {
        $this->caprice->directive('#endif', \Caprice\Directives\EndIfDirective::class, false);
        $out = $this->caprice->compile("end-if-directive.cap.php");
        $this->assertCompileOutput('<?php endif;?>', $out);
    }

    /**
     * test end php
     *
     * @return void
     */
    public function testCompileEndPhpDirective()
    {
        $this->caprice->directive('#endphp', \Caprice\Directives\EndPhpDirective::class, false);
        $out = $this->caprice->compile("end-php-directive.cap.php");
        $this->assertCompileOutput('?>', $out);
    }

    /**
     * test end while
     *
     * @return void
     */
    public function testCompileEndWhileDirective()
    {
        $this->caprice->directive('#endwhile', \Caprice\Directives\EndWhileDirective::class, false);
        $out = $this->caprice->compile("end-while-directive.cap.php");
        $this->assertCompileOutput('<?php endwhile;?>', $out);
    }

    /**
     * test extends
     *
     * @return void
     */
    public function testCompileExtendsDirective()
    {
        $this->caprice->directive('#extends', \Caprice\Directives\ExtendsDirective::class, false);
        $out = $this->caprice->compile("extends-directive.cap.php");
        $this->assertCompileOutput('#test', $out); // test if extends & get other file content only not multi parse
    }

    /**
     * test for
     *
     * @return void
     */
    public function testCompileForDirective()
    {
        $this->caprice->directive('#for', \Caprice\Directives\ForDirective::class, false);
        $out = $this->caprice->compile("for-directive.cap.php");
        $this->assertCompileOutput('<?php for($expression):?>', $out);
    }

    /**
     * test if
     *
     * @return void
     */
    public function testCompileIfDirective()
    {
        $this->caprice->directive('#if', \Caprice\Directives\IfDirective::class, false);
        $out = $this->caprice->compile("if-directive.cap.php");
        $this->assertCompileOutput('<?php if($expression):?>', $out);
    }

    /**
     * test include
     *
     * @return void
     */
    public function testCompileIncludeDirective()
    {
        $this->caprice->directive('#include', \Caprice\Directives\IncludeDirective::class, false);
        $out = $this->caprice->compile("include-directive.cap.php");
        $this->assertCompileOutput('#test', $out);
    }

    /**
     * test require
     *
     * @return void
     */
    public function testCompileRequireDirective()
    {
        $this->caprice->directive('#require', \Caprice\Directives\IncludeDirective::class, false);
        $out = $this->caprice->compile("require-directive.cap.php");
        $this->assertCompileOutput('#test', $out);
    }

    /**
     * test php
     *
     * @return void
     */
    public function testCompilePhpDirective()
    {
        $this->caprice->directive('#php', \Caprice\Directives\PhpDirective::class, false);
        $out = $this->caprice->compile("php-directive.cap.php");
        $this->assertCompileOutput('<?php', $out);
    }

    /**
     * test while
     *
     * @return void
     */
    public function testCompileWhileDirective()
    {
        $this->caprice->directive('#while', \Caprice\Directives\WhileDirective::class, false);
        $out = $this->caprice->compile("while-directive.cap.php");
        $this->assertCompileOutput('<?php while($expression):?>', $out);
    }

    /**
     * test yield
     *
     * @return void
     */
    public function testCompileYieldDirective()
    {
        $this->caprice->directive('#yield', \Caprice\Directives\YieldDirective::class, false);
        $this->caprice->directive('/#section\s*\((.*?)\)(.*?)#endsection/s', \Caprice\Directives\ClearLinesDirective::class, true);
        $out = $this->caprice->compile("yield-directive.cap.php");
        $this->assertCompileOutput('this is a header', $out);
    }
}