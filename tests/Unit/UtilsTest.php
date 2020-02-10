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

use Caprice\Exception\DirNotFoundException;
use Caprice\Exception\FileNotFoundException;
use Caprice\Utils;
use PHPUnit\Framework\TestCase;

class UtilsTest extends TestCase
{
    /**
     * assert hide sections works.
     *
     * @return void
     */
    public function testHideSectionsMethod()
    {
        $string = "#section('test')
                        section content here
                    #endsection";

        $parse = Utils::hideSections($string);
        $this->assertEmpty($parse);
    }

    /**
     * assert remove extra lines.
     *
     * @return void
     */
    public function testRemoveExtraLines()
    {
        $parse = Utils::removeExtraLines("\n");
        $this->assertSame('', $parse);
    }

    /**
     * test get namespace file not noud.
     *
     * @return void
     */
    public function testGetNamespaceFileNotFound()
    {
        $this->expectException(FileNotFoundException::class);
        $this->assertNull(Utils::getNamespace(dirname(__DIR__).'/stub/nofile'));
    }

    /**
     * test get namespace on file that doesn't have a namespace.
     *
     * @return void
     */
    public function testGetNamespaceReturnNull()
    {
        $this->assertNull(Utils::getNamespace(dirname(__DIR__).'/stub/test.cap.php'));
    }

    /**
     * test get namespace correct namespace.
     *
     * @return void
     */
    public function testGetNamespaceReturnNamespace()
    {
        $this->assertEquals('Caprice\TestGetNamespace', Utils::getNamespace(dirname(__DIR__).'/stub/ns/namespace.php'));
    }

    /**
     * test scanForDirectives when directory not exists.
     *
     * @return void
     */
    public function testScanForDirectivesNotFoundDirectory()
    {
        $this->expectException(DirNotFoundException::class);
        Utils::scanForDirectives(dirname(__DIR__).'/directives');
    }

    /**
     * test scanForDirectives on empty dir.
     *
     * @return void
     */
    public function testScanForDirectivesEmptyDir()
    {
        $dvs = Utils::scanForDirectives(dirname(__DIR__).'/stub/directives');
        $this->assertEmpty($dvs);
    }

    /**
     * test scanForDirectives.
     *
     * @return void
     */
    public function testScanForDirectives()
    {
        $dvs = Utils::scanForDirectives(dirname(__DIR__).'/stub/ns');
        $this->assertEquals('\NoNamespace::class', $dvs[0]);
        // custom namespace
        $dvs = Utils::scanForDirectives(dirname(__DIR__).'/stub/ns', 'customNameSpace');
        $this->assertEquals('customNameSpace\Namespace::class', $dvs[1]);
    }
}
