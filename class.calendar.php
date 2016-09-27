<?php

/**
* 
*/
class Calendar {

	private $months = array(
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

	private $weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];


	private $date;
	private $future_date;
	private $first_weekday_of_month;
	private $month_start_day;
	private $days_in_month;

	
	function __construct() {
		$this->date = getdate();

	}

	function daysInMonth($current_month, $current_year) {

	}
}

echo "<td><a href='event.php?day=$i&month=$date[month]&year=$date[year]'>" . $i . "</a></td>"