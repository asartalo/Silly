**Silly:** The silly little CLI tool
====================================

Silly is a PHP-based tool for quickly creating commandline scripts.

Silly makes it easy for you to write your script by simply writing a PHP class definition. It's that easy!

Quick Guide
-----------

### Install

Through Pear
```
$ pear channel-discover pear.brainchildprojects.org
$ pear install brainchild/Silly
```

OR clone source

```
$ git clone git://github.com/asartalo/Silly.git
```

### Write Tasks
```php
<?php
// my-silly-test.php
require_once 'Silly\Silly.php'; // or wherever you placed Silly

// Define some tasks
class MyCoolTasks implements \Silly\Tasks
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

### Run!

```
$ php my-silly-test.php say-hello
Hello!
```

Tasks
-----

Script commands are defined in your Task list. Task lists only need to implement `Silly\Tasks` interface which defines a method for obtaining passing the controller object (`Silly\Controller`), and a method for setting the namespace. When you register a task, the controller is passed before any task method is executed.

```php
<?php
use Silly\Tasks;

// A sample task list
class FooTasks implements Tasks {

    private $controller;

    public function getTaskNamespace() {
        return '';
    }

    public function setController(Silly\Controller $controller) {
        $this->controller = $controller;
    }

    function taskFoo() {
        $this->controller->out('foo');
    }
}
```

To be useful, task lists need to define some task methods. These are simply public methods that start with 'task'. So to define a 'foo' task:

```php
<?php
use Silly\Tasks;

// A sample task list
class FooTasks implements Tasks {

    //...snip...//

    function taskFoo() {
        $this->controller->out('foo');
    }

    function taskFooBar() {
        $this->controller->out('foo-bar');
    }
}
```

In the previous example, you can call `taskFoo` by typing in the terminal:

```
$ myscript.php foo
```

And you can call `taskFooBar` by:

```
$ myscript.php foo-bar
```

If you want to pass some arguments to the task method, just define them.

```php
<?php
use Silly\Tasks;

// A sample task list
class FooTasks implements Tasks {

    //...snip...//

    function taskHello($name) {
        $this->controller->out("Hello $name!");
    }
}
```

```
$ myscript.php hello Guwapo
Hello Guwapo!
```

Please note that task methods can only take scalar values from the cli. Also, there is no argument validation so not passing an argument to the hello task will issue some InvalidArgument exception or the like.

Do You Want Flags with That?
----------------------------

Sometimes you'll want to pass some flags to modify the behavior of a task. Flags can be defined by writing flag methods. Like:

```php
<?php
use Silly\Tasks;

class FooTasks implements Tasks {

    private $suffix = '';
    private $annoy;

    //...snip...//

    public function taskFoo() {
        $output = "Foo{$this->suffix}";
        if ($this->annoy) {
            for ($i=0; $i < 3; $i++) {
                $output .= $output;
            }
        }
        $this->controller->out($output);
    }

    public function flagSuffix($suffix)
    {
        $this->suffix = $suffix;
    }

    public function flagAnnoyMe()
    {
        $this->annoy = true;
    }

}
```

```
$ myscript.php foo
Foo
$ myscript.php foo --suffix Bar
FooBar
$ myscript.php foo --suffix Bar --annoy-me
FooBar
FooBar
FooBar
FooBar
```


Namespaces
----------

Sometimes you'll have a lot of tasks and you'll want to make them manageable. A good way to do that is to group them into namespaces. Each task definition can specify a namespace. To set the namespace for a task list, <code>Tasks::getTaskNamespace()</code> must return a string. For example...


```php
<?php
use Silly\Tasks;

class FooTasks implements Tasks {
    //...snip...//

    public function getTaskNamespace() {
        return '';
    }

    public function taskFoo() {
        $this->controller->out('Foo!');
    }

}

class BarTasks implements Tasks {
    //...snip...//

    public function getTaskNamespace() {
        return 'bar';
    }

    function taskFoo() {
        $this->controller->out('Bar!');
    }
}

$controller = \Silly\Silly::getController(new FooTasks); // this registers FooTasks
$contorller->register(new BarTasks)
// Okay, run it!
$controller->execute($argv);
```

```
$ myscript.php foo
Foo!
$ myscript.php bar:foo
Bar!
```

Roadmap
-------

* Argument validation
* Add shortcut flags like -f -s
* Add documentation through doc comments
