<?php
use function CommonMark\Render\HTML;

function HandlePagination($page, $link, $count, $expected_amount)
{
  if(!$page == 2) {
    $previous = $page - 1;
  } else {
    $previous = "";
  }
  $next = $page + 1;
  $count -= 1;
  if ($page != 1) {
    if ($count != $expected_amount) {
      return <<<HTML
    <div class="ellipsis">
      <a id="prev" style="float: left" href="$link$previous">
        <i class="fas fa-angle-double-left"></i>
        Previous
      </a> 
    </div>
    HTML;
    } else {
      return <<<HTML
    <div class="ellipsis">
      <a id="prev" style="float: left" href="$link$previous">
        <i class="fas fa-angle-double-left"></i>
        Previous
      </a> 
      <a id="next" style="float: right" href="$link$next">
        Next
        <i class="fa fa-angle-double-right"></i>
      </a> 
    </div>
    HTML;
    }
  } else {
    if ($count != $expected_amount) {
      return "";
    } else {
      return <<<HTML
      <div class="ellipsis">
      <a id="next" style="float: right" href="$link$next">
        Next
        <i class="fa fa-angle-double-right"></i>
      </a> 
      </div>
    HTML;
    }
  }
}

function SetPagination($page) {
  if (!$page) {
    $page = 1;
  }
  if($page <= 0) {
    $page = 1;
  }
  if(!is_numeric($page)) {
    header('location: /dashboard');
    exit();
  }
  return $page;
}