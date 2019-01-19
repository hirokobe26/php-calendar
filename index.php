<?php
  require_once(__DIR__ . '/calendar.php');
  $calendar = new Calendar();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
  <title>Calendar</title>
</head>
<body>
  <table>
    <thead>
      <tr>
        <th><a href="">&laquo;</a></th>
        <th colspan="5"><?php echo $calendar->yearMonth; ?></th>
        <th><a href="">&raquo;</a></th>
      </tr>
    </thead>
    <tbody>
      <?php echo $calendar->show_day_of_the_week(); ?>
      <?php echo $calendar->show_calendar(); ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="7"><a href="">Today</a></th>
      </tr>
    </tfoot>
  </table>
</body>
</html>
