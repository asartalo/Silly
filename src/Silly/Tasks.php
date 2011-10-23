<?php

namespace Silly;

interface Tasks {
  function getTaskNamespace();
  function setController(Controller $controller);
}
