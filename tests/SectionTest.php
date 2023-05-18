<?php

namespace Dhenfie\Nuri\Tests;

use Dhenfie\Nuri\Libs\Section;
use PHPUnit\Framework\TestCase;

class SectionTest extends TestCase
{
    private Section $block;

    public function setUp() : void
    {
        $this->block = new Section;
    }

    public function testCreate() : void
    {
        self::expectOutputString('hello world !');

        $this->block->create('message', 'hello world !');
        echo $this->block->getSection('message');
    }

    public function testStartSection(): void {
        self::expectOutputString('PHP Template System');

        $this->block->start('message');
        echo 'PHP Template System';
        $this->block->end();

        // print message
        echo $this->block->getSection('message');
    }

    public function testUndefinedSection(){
        self::expectOutputString('');

        $this->block->start('message');
        echo 'test !';
        $this->block->end();

        echo $this->block->getSection('undefined');
    }
}
