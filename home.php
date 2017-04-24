<?php 
require 'config.php';
isset($_SESSION['id']) ? '' : header('location:index.php');

if ( isset($_GET['month']) || isset($_GET['year'])) {
	// If Month and Year are set, set calendar info to custom.
	$datecontrol = new DateControl(array(
		'mon'  => $_GET['month'],
		'year' => $_GET['year']
		)
	);
} else {
	// Set calendar info to current month/year.
	$datecontrol = new DateControl();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>My Calendar App</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="container">
			<h1><?php echo $datecontrol->getMonth(); ?></h1>
			<p id="year"><?php echo $datecontrol->year; ?></p>
			<nav>
				<a href="index.php">this month</a>
				<a href="logout.php">log out</a>
			</nav>

			<form method="get" id="month-select">
				<label for="year">Year: </label>
				<select name="year" id="year">
					<?php foreach ($datecontrol->range as $year) {
						echo "<option value='$year'". ($_GET['year'] == $year ? "selected='selected'" : '') .">" . $year . "</option>";
					} ?>
				</select>
				<label for="month">Month:</label>
				<select name="month" id="month">
					<?php foreach ($datecontrol->months as $number => $month) {
						echo "<option value='$number'" . ($_GET['month'] == $number || $datecontrol->month == $number ? "selected='selected'" : '') . ">" . $month . "</option>";
					} ?>
				</select>
				<input type="submit">
			</form>
				<?php 
					// Generate the Calendar
					Builder::create($datecontrol, $conn); 
				?>
		</div>
	</body>
</html>