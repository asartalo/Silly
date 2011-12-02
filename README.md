Silly: The silly little CLI tool
================================

Silly helps you create php-based commandline scripts.

Usage
-----

```php
// my-silly-test.php
require_once 'Silly\Silly.php'; // or wherever you placed Silly

// Define some tasks
class MyCoolTasks implements Tasks
{
    private $controller;

    public function getTaskNamespace() {
        return '';
    }

    public function setController(\Silly\Controller $controller) {
        $this->controller = $controller;
    }

    public function taskSayHello()
    {
        $this->controller->out('Hello!');
    }
}

// Get the silly little controller
$controller = \Silly\Silly::getController(new MyCoolTasks);
// Okay, run it!
$controller->execute($argv);
```

Then on your terminal, run that silly little thing!

```bash
$ php my-silly-test.php say-hello
```

...then you'll get some sweet response.

```bash
$ Hello!
```

Cooool!
