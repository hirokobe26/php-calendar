<?php

class Calendar {
    private $body;
    private $head;
    private $tail;
    private $period;
    private $dt;
    public $previosMonth;
    public $nextMonth;
    private $thisMonth;
    private $yearMonth;
    private $firstDayOfNextMonth;
    private $lastDayOfPreviousMonth;

    public function __construct() {
      $this->body = '';
      $this->head = '';
      $this->tail = '';
      try {
        if (!isset($_GET['t']) || !preg_match('/\A\d{4}-\d{2}\z/', $_GET['t'])) {
          throw new Exception();
        }
        $this->thisMonth = new DateTime($_GET['t']);
      }catch (Exception $e){
        $this->thisMonth = new DateTime('first day of this month');
      }
      $this->dt = clone $this->thisMonth;
      $this->previosMonth = $this->dt->modify('-1 month')->format('Y-m');
      $this->dt = clone $this->thisMonth;
      $this->nextMonth = $this->dt->modify('+1 month')->format('Y-m');
      $this->yearMonth = $this->thisMonth->format('F Y');
      $this->period = new DatePeriod(
        new DateTime('first day of' . $this->yearMonth),
        new DateInterval('P1D'),
        new DateTime('first day of' . $this->yearMonth . '+1 month')
        //最終日を含む場合は、来月の日付までを指定してあげる
      );
      $this->firstDayOfNextMonth = new DateTime('first day of' . $this->yearMonth . '+1 month');
      $this->lastDayOfPreviousMonth = new DateTime('last day of' .   $this->yearMonth . '-1 month');
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

    public function show_tail() {
      while($this->lastDayOfPreviousMonth->format('w') < 6){
        $this->tail = sprintf('<td class="gray">%d</td>', $this->lastDayOfPreviousMonth->format('d')) . $this->tail;
        $this->lastDayOfPreviousMonth->sub(new DateInterval('P1D'));
      }
      return $this->tail;
    }

    public function show_calendar(){
      return  '<tr>' . $this->show_tail() . $this->show_body() . $this->show_head() . '</tr>';
    }

    public function show_day_of_the_week(){
      return '<tr>
                <td>Sun</td>
                <td>Mon</td>
                <td>Tue</td>
                <td>Wed</td>
                <td>Thu</td>
                <td>Fri</td>
                <td>Sat</td>
             </tr>';
    }

    public function show_year_month(){
      return $this->yearMonth;
    }

    public function h($s){
      return htmlspecialchars($s,ENT_QUOTES, 'utf-8');
    }
}

