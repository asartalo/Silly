<?php

namespace Silly;

/**
* Silly and the silly Silly manager. Use this to get information about Silly.
* Copy?
*/
class Silly {

  private static $version = '0.1b';

  static function getVersion() {
    return self::$version;
  }

  static function getSourcePath() {
    return realpath(__DIR__);
  }

  static function getController(Tasks $tasks, $cwd = null) {
    if (!$cwd) {
      $cwd = getcwd();
    }
    $controller = new Controller(
      new Interpreter, new Executor(new Utilities), $cwd
    );
    $controller->register($tasks);
    return $controller;
  }

}