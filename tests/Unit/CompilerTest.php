<?php namespace Tests\Unit;

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     0.1.0
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2019
 * @license     MIT
 * @link        https://github.com/lotfio/caprice
 *
 */

use Caprice\Compiler;
use PHPUnit\Framework\TestCase;
use Caprice\Exception\FileNotFoundException;
use Caprice\Exception\DirNotFoundException;

class CompilerTest extends TestCase
{
    public function setUp() : void
    {
        $this->compiler = new Compiler;
    }

    /**
     * test is modified is returning bool
     *
     * @return void
     */
    public function testIsModifiedMethod()
    {
        $check = $this->compiler->isModified(dirname(__DIR__)."/stub/fileOne", dirname(__DIR__)."/stub/fileTwo");
        $this->assertIsBool($check);
    }

    /**
     * test compile method file not exists
     *
     * @return void
     */
    public function testCompileFileNotExists()
    {
        $this->expectException(FileNotFoundException::class);
        $this->compiler->compile(dirname(__DIR__) ."/stub/test.cap.no", dirname(__DIR__) ."/stub/");
    }

    /**
     * test compile method cache dir not exists
     *
     * @return void
     */
    public function testCompileCacheDirNotExists()
    {
        $this->expectException(DirNotFoundException::class);
        $this->compiler->compile(dirname(__DIR__) ."/stub/test.cap", dirname(__DIR__) ."/stubsss/");
    }

    /**
     * test compile cap file
     *
     * @return void
     */
    public function testCompileMethodCompileFile()
    {
        $compiled = $this->compiler->compile(dirname(__DIR__) ."/stub/test.cap", dirname(__DIR__) ."/stub/");
        $this->assertFileExists($compiled);
    }
}
