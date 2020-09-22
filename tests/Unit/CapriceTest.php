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
     * test break
     *
     * @return void
     */
    public function testCompileBreakDirective()
    {
        $this->caprice->directive("#break", \Caprice\Directives\BreakDirective::class);
        $out = $this->caprice->compile("break-directive.cap.php");
        $out = file_get_contents($out);
        $this->assertSame('<?php break;?>', $out);
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
        $out = file_get_contents($out);
        $this->assertSame("clearLine\r\nend", $out);
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
        $out = file_get_contents($out);
        $this->assertSame('', $out);
    }

}