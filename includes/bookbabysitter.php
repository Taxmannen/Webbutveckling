<?php
session_start();

require 'config.php';

if (isset($_POST['book'])) {
		
	// tar bort ev blanksteg
	foreach ($_POST as $key => $val) {
		$_POST[$key] = trim($val);
	}
	
	$userName = $_POST['name'];
	$children = $_POST['children'];
	$babysitter = $_POST['babysitter'];
	$startTime = $_POST['starttime'];
	$endTime = $_POST['endtime'];	

	if (!isset($reg_error)) {
		
		$stm = $pdo->prepare("INSERT INTO `bookingbabysitter` (`userName`, `userId`, `children`, `babysitter`, `startTime`, `endTime`) VALUES ('$userName', :userId, '$children', '$babysitter', '$startTime', '$endTime')");

		try {
			$stm->execute(['userId' => $_SESSION['session_id']]);
		}
		catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}

		$_SESSION['userid'] = $pdo->lastInsertId();

		$_SESSION['bookobj'] = $_POST;

		echo "<script type='text/javascript'>
	   	document.location.href = '../html/my_page.php';
		</script>";
	    exit;
	}
}
?>
