<?php
session_start();

require 'config.php';

if (isset($_POST['book'])) {
		
	foreach ($_POST as $key => $val) {
		$_POST[$key] = trim($val);
	}

	$userName = $_POST['name'];
	$subject = $_POST['subject'];
	$tutor = $_POST['tutor'];
	$startTime = $_POST['starttime'];
	$endTime = $_POST['endtime'];

	if (!isset($reg_error)) {
		
		$stm = $pdo->prepare("INSERT INTO `bookingtutor`(`userName`, `userId`, `subject`, `tutor`, `startTime`, `endTime`) VALUES ('$userName', :userId, '$subject', '$tutor', '$startTime', '$endTime')");

		try {
			$stm->execute(['userId' => $_SESSION['session_id']]);
		}
		catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}

		$_SESSION['userid'] = $pdo->lastInsertId();

		$_SESSION['bookobj'] = $_POST;

		echo "<script type='text/javascript'>
	   	document.location.href = '../html/my_page.html';
		</script>";
	    exit;
	}
}
?>
