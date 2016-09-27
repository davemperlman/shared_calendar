<?php
	require 'config.php';
	isset($_SESSION['id']) ? '' : header('location:index.php');
	$time = strtotime("$_GET[day]-" . "$_GET[month]-" . "$_GET[year]");
	$date = date('Y-m-d', $time);
	if ( isset($_POST['submit']) ) {
		$conn->prepared_query("INSERT INTO events (title, start, end, date, description, is_private, user_id) VALUES(:title, :start, :end, :date, :description, :is_private, :user_id)", array(
			'title'  	  => $_POST['title'],
			'start'  	  => $_POST['start'],
			'end'    	  => $_POST['end'],
			'date'   	  => $_POST['date'],
			'description' => $_POST['description'],
			'is_private'  => $_POST['is_private'] = 0,
			'user_id'     => $_SESSION['id']
			));
		header("location:home.php?year=$_GET[year]&month=$_GET[month]");
	}

	$events = $conn->raw_query("SELECT events.id, title, start, end, date, description, is_private, user_id, first_name, last_name FROM events RIGHT JOIN users ON user_id = users.id WHERE is_private = 1 OR user_id = $_SESSION[id]");
?>


<!DOCTYPE html>
<html>
	<head>
		<title>My events</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="container">
			<section id="add-event">
				<ul>
					<form method="post">
							<li>
								<label hidden="hidden" for="title">Title</label>
								<input name="title" type="text" placeholder="Enter a title" required="required">
							</li>

							<li>
								<label for="start">Start: </label>
								<input name="start" type="time" required="required">
							</li>

							<li>
								<label for="end">End: </label>
								<input name="end" type="time" required="required">
							</li>
							
							<li>
								<label for="date">Date</label>
								<input type="date" id="date" value="<?php echo $date; ?>" name="date">
							</li>
							<li>
								<label hidden="hidden" for="description">Description</label>
								<textarea name="description" placeholder="Enter a Description" required="required"></textarea>
							</li>
							<li>
								<label for="is_private">Share this event with other users?</label>
								<input name="is_private" id="is_private" type="checkbox">
							</li>
							<li>
								<label hidden="hidden" for="submit">Submit</label>
								<input name="submit" type="submit" value="Submit">
							</li>
					</form>
				</ul>
			</section>
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
			<footer>
				<a href="logout.php">Log Out</a>
				<a href="<?php echo "home.php?year=$_GET[year]&month=$_GET[month]&day"; ?>">Back</a>				
			</footer>
		</div>
	</body>
</html>