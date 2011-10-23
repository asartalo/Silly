<?php

namespace Silly\Tests\Functional;

use Silly\Tasks;

/**
* A Dummy Tasks List used in StandardUseCasesTest.php
*/
class DummyTasksList implements Tasks
{

    private $controller;

    function getTaskNamespace() {
        return '';
    }

    function setController(\Silly\Controller $controller) {
        $this->controller = $controller;
    }

    public function taskSayHello()
    {
        $this->controller->out('Hello!');
    }

}