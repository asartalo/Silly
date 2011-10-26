<?php

namespace Silly\Tests\Unit\Cli;

require realpath(__DIR__ . '/../../../bootstrap.php');

require_once realpath(__DIR__ . '/../../../../src/Silly/Silly.php');

use \Silly\Silly;

class SillyTest extends \PHPUnit_Framework_TestCase
{

    public function testGettingSillyVersion()
    {
        $this->assertEquals('0.1b', Silly::getVersion());
    }

    public function testGettingSillySourcePath()
    {
        $this->assertEquals(realpath(__DIR__ . '/../../../../src/Silly'), Silly::getSourcePath());
    }

    public function testGettingController()
    {
        $tasks = $this->getMock('Silly\Tasks');
        $this->assertInstanceOf('\Silly\Controller', Silly::getController($tasks));
    }

    public function testGettingControllerSetsWorkingDirectoryByDefault()
    {
        $controller = Silly::getController($this->getMock('Silly\Tasks'));
        $this->assertEquals(getcwd(), $controller->getWorkingDirectory());
    }

    public function testGettingControllerSettingWorkingDirectory()
    {
        $controller = Silly::getController($this->getMock('Silly\Tasks'), '/foo/bar');
        $this->assertEquals('/foo/bar', $controller->getWorkingDirectory());
    }

}