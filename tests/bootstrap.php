<?php

$src_path = realpath(__DIR__ . '/../src/');
require_once realpath(__DIR__ . '/../') . '/vendor/AsarClassLoader/src/Asar/ClassLoader.php';
$classLoader = new \Asar\ClassLoader('Silly\Tests', __DIR__);
$classLoader->register();
$classLoader = new \Asar\ClassLoader('Silly', $src_path);
$classLoader->register();

