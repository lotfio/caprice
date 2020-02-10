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

use Caprice\Compiler;
use Caprice\Exception\DirNotFoundException;
use Caprice\Exception\FileNotFoundException;
use PHPUnit\Framework\TestCase;

class CompilerTest extends TestCase
{
    /**
     * setup method.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->compiler = new Compiler(dirname(__DIR__).'/stub/', dirname(__DIR__).'/stub/');
    }

    /**
     * test compile method file not exists.
     *
     * @return void
     */
    public function testCompileFileNotExists()
    {
        $this->expectException(FileNotFoundException::class);
        $this->compiler->compile('test.cap.no');
    }

    /**
     * test compile method cache dir not exists.
     *
     * @return void
     */
    public function testCompileFilesDirNotExists()
    {
        $this->expectException(DirNotFoundException::class);
        $this->compiler = new Compiler('FilesDir', dirname(__DIR__).'/stub');
    }

    /**
     * test compile method cache dir not exists.
     *
     * @return void
     */
    public function testCompileCacheDirNotExists()
    {
        $this->expectException(DirNotFoundException::class);
        $this->compiler = new Compiler(dirname(__DIR__).'/stub', 'cachedir');
    }

    /**
     * test compile cap file.
     *
     * @return void
     */
    public function testCompileMethodCompileFile()
    {
        $compiled = $this->compiler->compile('test.cap.php');
        $this->assertFileExists($compiled);
    }
}
