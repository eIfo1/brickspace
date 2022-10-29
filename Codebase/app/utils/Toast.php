<?php

namespace brickspace\utils;

use Error;
use TypeError;

class Toast
{
  public $text;

  function __construct($text, $type)
  {
    $this->text = $text;

    if (empty($text)) {
      throw new Error("Toast text is empty!");
    }

    if ($type == 0) {
      $this->Error();
    } elseif ($type == 1) {
      $this->Note();
    } else {
      throw new TypeError("Toast type is invalid! (0->1)");
    }
  }

  public static function Handle() {
    if (@$_SESSION['error']) {
      new Toast($_SESSION['error'], 0);
      unset($_SESSION['error']);
    }
    if (@$_SESSION['note']) {
      new Toast($_SESSION['note'], 1);
      unset($_SESSION['note']);
    }
  }

  private function Note()
  {
    echo <<<HTML
    <div class="alert">
      $this->text
    </div>
  HTML;
  }

  private function Error()
  {
    echo <<<HTML
    <div class="alert error">
      $this->text
    </div>
  HTML;
  }
}
