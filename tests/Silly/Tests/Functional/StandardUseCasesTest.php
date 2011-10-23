<?php

namespace Silly\Tests\Functional;

require realpath(__DIR__ . '/../../../bootstrap.php');

require_once $src_path . '/Silly/Silly.php';
require_once 'DummyTasksList.php';
require_once $tests_path . '/Silly/Tests/ArgvParser.php';


use \Silly\Tests\ArgvParser;
use \Silly\Silly;

/**
* Standard Use Cases test
*/
class StandardUseCasesTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->argvParser = new ArgvParser('silly');
        $this->controller = Silly::getController(new DummyTasksList);
    }

    function testQuickSetupForTaskList()
    {
        $this->assertInstanceOf('Silly\Controller', $this->controller);
    }

    public function testQuickSetupRegistersTaskList()
    {
        $this->assertEquals(array('say-hello'), $this->controller->getRegisteredTasks());
    }

    public function testRunningTask()
    {
        ob_start();
        $this->controller->execute($this->argvParser->parse('say-hello'));
        $output = ob_get_clean();
        $this->assertEquals("Hello!\n", $output);
    }
}