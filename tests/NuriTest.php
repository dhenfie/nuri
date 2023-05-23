<?php

namespace Dhenfie\Nuri\Tests;

use Dhenfie\Nuri\Nuri;
use Exception;
use PHPUnit\Framework\TestCase;

class NuriTest extends TestCase
{
    private Nuri $nuri;

    public function setUp(): void
    {
        $this->nuri = new Nuri(__DIR__. DIRECTORY_SEPARATOR. 'nuri');
    }

    public function testNuriInstance(): void
    {
        self::expectException(Exception::class);
        $nuri = new Nuri(__DIR__. 'nuris');
    }

    public function testGetInstance(){
        $nuri = new Nuri(__DIR__. DIRECTORY_SEPARATOR. 'nuri');
        self::assertSame(Nuri::getInstance(), $nuri);
    }

    public function testExtend(){
        $this->nuri->extend('master.app');
        self::assertEquals('master.app', $this->nuri->getMaster());
    }

    public function testRender(){
        self::expectOutputString('welcome nuri !');

        $this->nuri->render('render');
    }

    public function testRenderWithExtend(){
        self::expectOutputString('extending theme');
        $this->nuri->render('renderWithExtend');
    }
}
