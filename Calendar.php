<?php

/**
* 
*/
abstract class Calendar {

	
	// protected function weekFill($start) {
	// 	for ($i=0; $i < $start; $i++) { 
	// 		echo '<td></td>';
	// 	}
	// }

	// protected function row(object $Date) {

	// 	for ($j = $fodm, $i = 0; $i < $Date->monthStart; $i++, $j++) { 
	// 		# code...
	// 	}
	// }

	public static function create(object $date) {

		echo '<table>';
		for ($i=0; $i < $date->firstDom; $i++) { 
			echo '<td></td>';
		}

		for ($j = $date->firstDom, $i = 0; $i < $date->firstDom; $i++, $j++) { 
			$iteration = getdate(mktime(0,0,0,$date->month, $i, $date->year));
			$parsed    = date('Y-m-d', strtotime("$iteration[month] $iteration[mday] $iteration[year]"));

			if ( $conn->raw_query("SELECT id FROM events WHERE date = '$parsed' AND user_id = '$_SESSION[id]'") == true ) {
		  		echo "<td class='scheduled'><a href='event.php?day=$i&month=$date->month&year=$date->year'>" . $i . "</a></td>";
		  	} else {
		 		echo "<td><a href='event.php?day=$i&month=$date->fdom&year=$date->year'>" . $i . "</a></td>";
			}
		  	if ($j >= 7) {
		  		echo "</tr><tr>";
		  		$j = 0;
		  	}
		}

	}


}
