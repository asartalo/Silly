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

    /**
     * Says hello. Pass a name, and it'll be greeted.
     *
     * @param string $name your name
     */
    public function taskSayHello($name = '')
    {
        if ($name) {
            $say = "Hello, $name!";
        } else {
            $say = "Hello!";
        }
        $this->controller->out($say);
    }

}