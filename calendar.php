<?php

class Calendar {
    private $body;
    private $head;
    private $period;
    public $firstDayOfNextMonth;

    public function __construct() {
      $this->body = '';
      $this->head = '';
      $this->period = new DatePeriod(
        new DateTime('first day of this month'),
        new DateInterval('P1D'),
        new DateTime('first day of next month')
      );
      $this->firstDayOfNextMonth = new DateTime('first day of next month');
    }

    public function show_body() {
      foreach ($this->period as $day) {
        if ($day->format('w') % 7 === 0) { $this->body .= '</tr><tr>'; }
        $this->body .= sprintf('<td class="youbi_%d">%d</td>', $day->format('w'), $day->format('d'));
      }
      return $this->body;
    }

    public function show_head() {
      while ($this->firstDayOfNextMonth->format('w') > 0) {
        $this->head .= sprintf('<td class="gray">%d</td>', $this->firstDayOfNextMonth->format('d'));
        $this->firstDayOfNextMonth->add(new DateInterval('P1D'));
        //DatatimeObjectの日にちを1日進める
      }
      return $this->head;
    }
}

