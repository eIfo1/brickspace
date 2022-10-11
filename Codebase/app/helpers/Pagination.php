<?php

namespace brickspace\helpers;

class Pagination
{
  public static function Handle($page, $link, $count, $expected_amount)
  {
    if (!$page == 2) {
      $previous = $page - 1;
    } else {
      $previous = "";
    }
    $next = $page + 1;
    $count -= 1;
    if ($page != 1) {
      if ($count != $expected_amount) {
?>
        <div class="ellipsis">
          <a id="prev" style="float: left" href="<?php echo $link . $previous; ?>">
            <i class="fas fa-angle-double-left"></i>
            Previous
          </a>
        </div>
      <?php
      } else {
      ?>
        <div class="ellipsis">
          <a id="prev" style="float: left" href="<?php echo $link . $previous; ?>">
            <i class="fas fa-angle-double-left"></i>
            Previous
          </a>
          <a id="next" style="float: right" href="<?php echo $link . $next; ?>">
            Next
            <i class="fa fa-angle-double-right"></i>
          </a>
        </div>
      <?php
      }
    } else {
      if ($count != $expected_amount) {
        return "";
      } else {
      ?>
        <div class="ellipsis">
          <a id="next" style="float: right" href="<?php echo $link . $next; ?>">
            Next
            <i class="fa fa-angle-double-right"></i>
          </a>
        </div>
<?php
      }
    }
  }

  public static function Set($page) {
    if (!$page) {
      $page = 1;
    }
    if ($page <= 0) {
      $page = 1;
    }
    if (!is_numeric($page)) {
      header('location: /dashboard');
      exit();
    }
    return $page;
  }
}
