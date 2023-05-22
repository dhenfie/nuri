<?php

namespace Dhenfie\Nuri\Tests;

use Dhenfie\Nuri\Libs\FileHandler;
use Exception;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class FileHandlerTest extends TestCase
{

    private FileHandler $file;

    public function setUp() : void
    {
        $this->file = new FileHandler(__DIR__);
    }

    public function testCurrentDir()
    {
        $dir = realpath(__DIR__);
        self::assertEquals('tests', basename($dir));
    }

    public function testCheckPath()
    {
        self::assertTrue($this->methodCheckPath(dirname(__DIR__)));
    }

    public function testInvalidPath()
    {
        self::assertFalse($this->methodCheckPath('invalid-dir'));
    }

    public function testFileExit()
    {
        $actual = $this->file->fileExist('nuri.TestFile');
        self::assertTrue($actual);
    }

    public function testInclude()
    {
        self::expectOutputString('included');

        $this->file->include('nuri.TestIncludeFile');
    }

    public function testIncludeWithData()
    {
        self::expectOutputString('Hello World !');

        $this->file->include('nuri.TestIncludeFile', ['message' => 'Hello World !']);
    }

    public function testIncludeError()
    {
        self::expectException(Exception::class);

        $this->file->include('invalid-dir');
    }

    public function testUsingDotSeparator()
    {
        $exampleFilename = 'layouts.app';
        $actual          = str_replace('.', DIRECTORY_SEPARATOR, $exampleFilename);

        self::assertEquals('layouts/app', $actual);
    }


    /**
     * Alias FileHandler::checkPath()
     *
     * @param string $path
     * @return bool
     */
    private function methodCheckPath(string $path)
    {
        $classTarget = $this->file;
        $reflection  = new ReflectionMethod($classTarget, 'checkPath');
        $reflection->setAccessible(true);

        return $reflection->invoke($classTarget, $path);
    }
}
