<?php

use function CommonMark\Render\HTML;

function ShowError($error_message)
{
  echo <<<HTML
  <div id="snackbar">
    $error_message  
  </div>
  HTML;
  ToastScript();
}

function ShowNote($note)
{
  echo <<<HTML
  <div id="snackbar" data-type="note">
    $note  
  </div>
  HTML;
  ToastScript();
}

function ToastScript() {
  echo <<<HTML
  <script>
    function snackbar() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2900);
    }
    snackbar();
  </script>
  HTML;
}