<?php

/**
* 
*/
class DateControl {

	public $firstDom;
	public $firstWdom;
	public $month;
	public $year;

	public $weekdays = array(
		'0' => 'Sunday',
		'1' => 'Monday',
		'2' => 'Tuesday',
		'3' => 'Wednesday',
		'4' => 'Thursday',
		'5' => 'Friday',
		'6' => 'Saturday'
		);

	public $months = array(
		'1'  => 'January',
		'2'  => 'February',
		'3'  => 'March',
		'4'  => 'April',
		'5'  => 'May',
		'6'  => 'June',
		'7'  => 'July',
		'8'  => 'August',
		'9'  => 'September',
		'10' => 'October',
		'11' => 'November',
		'12' => 'December'
		);

	public $monthStart;
	public $dayCount;
	public $range;
	
	function __construct($date = null) {

		date_default_timezone_set('America/New_York');
		$date = ($date ? $date : getdate());
		
		$this->month     = $date['mon'];
		$this->year      = $date['year'];
		$this->firstDom  = getdate(mktime(0,0,0, $this->month, 1, $this->year))['mday'];
		$this->firstWdom = array_search($this->firstDom['weekday'], $this->weekdays)['wday'];
		$this->dayCount = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
		$this->range = range($date['year'], $this->year + 10);
	}
}
