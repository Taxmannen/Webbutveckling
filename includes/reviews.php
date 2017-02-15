<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lägg till referens</title>
</head>
<body>
<?php 
require 'config.php'; 

if (isset($_POST['leaveRef'])) {

	foreach ($_POST as $key => $val) {
		$_POST[$key] = trim($val);
	}

	if (empty($_POST['review']) || empty($_POST['user'])) {
		$reg_error[] = 0;
	}

	$name = $_POST['name'];
	$review = $_POST['review'];
	$user = $_POST['user'];

	if (!isset($reg_error)) {
		$sql = ("INSERT INTO `reviews`(`name`, `reference`, `user`) VALUES ('$name', '$review', '$user')");
		$stmRef = $pdo->prepare($sql);	

		try {
			$stmRef->execute();
		}
		catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}

		$_SESSION['userid'] = $pdo->lastInsertId();
		
		echo "Tack för ditt omdöme!";
	}

}

?>

<h1>Lämna ett omdöme</h1>

<?php

$error_list[0] = "Alla obligatoriska fält är inte ifyllda.";

	if (isset($reg_error)) {
		echo "<p>Något blev fel:</p>";
		echo "<ul>\n";
  		for ($i = 0; $i < sizeof($reg_error); $i++) {
    		echo "<li>{$error_list[$reg_error[$i]]}</li>\n";
  		}
  		echo "</ul>\n";
	}

?>

<form action="reviews.php" method="post">
	<p>Barnvakt/Läxhjälp:</p>
	<select name="name" id="name">
		<?php
			$stm = $pdo->prepare("SELECT `name` FROM `users` WHERE `role` != 'null'");
			$stm->execute([]);
				foreach ($stm as $row) {
					$name = $row['name'];
					echo "<option>$name</option>";
				}
		?>
	</select>
	<p>Omdöme:</p>
	<input type="text" name="review" value="" placeholder="Skriv ditt omdöme">
	<p>Namn:</p>
	<input type="text" name="user" value="" placeholder="Ditt namn">
	<br><br>
	<button type="submit" name="leaveRef">Lämna omdöme</button>
</form>


</body>
</html>