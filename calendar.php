<?php

$body = '';
$period = new DatePeriod(
  new DateTime('first day of this month'),
  new DateInterval('P1D'),
  new DateTime('first day of next month')
);
foreach ($period as $day) {
  if ($day->format('w') % 7 === 0) { $body .= '</tr><tr>'; }
  $body .= sprintf('<td class="youbi_%d">%d</td>', $day->format('w'), $day->format('d'));
}

$head = '';
$firstDayOfNextMonth = new DateTime('first day of next month');
while ($firstDayOfNextMonth->format('w') > 0) {
  $head .= sprintf('<td class="gray">%d</td>', $firstDayOfNextMonth->format('d'));
  $firstDayOfNextMonth->add(new DateInterval('P1D'));
}
