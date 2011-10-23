<?php

namespace Silly;

class Utilities {

  function dashLowerCase($string) {
    return $this->uncamelize($string, '-');
  }

  private function uncamelize($string, $splitter="_") {
    $string = preg_replace('/[[:upper:]]/', $splitter.'$0', $string);
    return trim(strtolower($string), '-');
  }

  function camelCase($string) {
    return str_replace(array(' ', '-'), '', $this->ucwordsLower($string));
  }

  private function ucwordsLower($string) {
    return ucwords(
      strtolower(str_replace(array('-', '_'), ' ', $string))
    );
  }

}
