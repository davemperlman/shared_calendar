<?php 
require 'config.php';

isset($_SESSION['id']) ? '' : header('location:index.php');


// Current Date, Month, and Year
$date = getdate();
!isset($_GET['month']) ? $current_month = $date['mon'] : $current_month = $_GET['month'];
!isset($_GET['year']) ? $current_year  = $date['year'] : $current_year  = $_GET['year'];

// Future Date
$month_first_day = getdate(mktime(0,0,0, $current_month, 1, $current_year));

// First Weekday in the Month
$first_weekday = getdate(mktime($month_first_day['hours'], $month_first_day['minutes'], $month_first_day['seconds'], $month_first_day['mon'], 1, $month_first_day['year']));

$weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

// How many days from Sunday is the first weekday (numeric)
$month_start_position = array_search($first_weekday['weekday'], $weekdays);

// Counts the number of days in the month
$days = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);

$months_arr = array(
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

//print_r($months_arr); die();

$years = range($date['year'], $current_year+10);

// Displaying Events
$events = $conn->raw_query("SELECT events.id, title, date, body, is_private, user_id FROM events RIGHT JOIN users ON user_id = users.id WHERE is_private = 1 OR user_id = $_SESSION[id]");


$datething = new DateControl();

print_r($datething); die();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>My Calendar App</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="container">
			<h1><?php echo $month_first_day['month']; ?></h1>
			<p id="year"><?php echo $month_first_day['year']; ?></p>
			<nav>
				<a href="index.php">this month</a>
				<a href="logout.php">log out</a>
			</nav>
			<form method="get" id="month-select">
				<label for="year">Year: </label>
				<select name="year" id="year">
					<?php foreach ($years as $year) {
						echo "<option value='$year'". ($_GET['year'] == $year ? "selected='selected'" : '') .">" . $year . "</option>";
					} ?>
				</select>
				<label for="month">Month:</label>
				<select name="month" id="month">
					<?php foreach ($months_arr as $number => $month) {
						echo "<option value='$number'" . ($_GET['month'] == $number || $current_month == $number ? "selected='selected'" : '') . ">" . $month . "</option>";
					} ?>
				</select>
				<input type="submit">
				<p></p>
			</form>
			<?php Calendar::create($datething); ?>
			<section class="events">
				<?php foreach ($events as $event => $info) : ?> 
					<div class="event-item">
						<h3><?php echo $info->title; ?></h3>
						<ul>
							<li>Description: <?php echo $info->description ?></li>
							<li>Date: <?php echo date('m-d-Y', strtotime($info->date)); ?></li>
							<li>Start: <?php echo date('h:i A', strtotime($info->start)); ?></li>
							<li>End: <?php echo date('h:i A', strtotime($info->end)); ?></li>
							<li>Posted by: <?php echo $info->first_name . " " . $info->last_name; ?></li>
						</ul>
						<?php if ( $info->user_id == $_SESSION['id']): ?>
							<a href="<?php echo "delete.php?postid=$info->id&id=$_SESSION[id]&userid=$info->user_id"; ?>">Delete Post</a>
						<?php endif ?>
					</div>
				<?php endforeach; ?>
			</section>
		</div>
	</body>
</html>