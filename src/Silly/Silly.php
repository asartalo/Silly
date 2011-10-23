<?php

namespace Silly;

require_once 'Controller.php';
require_once 'Interpreter.php';
require_once 'Executor.php';
require_once 'Utilities.php';
require_once 'Tasks.php';

/**
* Silly and the silly Silly manager. Use this to get information about Silly.
* Copy?
*/
class Silly
{
    private static $version = '0.1b';

    public static function getVersion()
    {
        return self::$version;
    }

    public static function getSourcePath()
    {
        return realpath(__DIR__);
    }

    public static function getController(Tasks $tasks)
    {
        $controller = new Controller(new Interpreter, new Executor(new Utilities), getcwd());
        $controller->register($tasks);
        return $controller;
    }

}