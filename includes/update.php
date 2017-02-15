<?php
session_start();

require 'config.php';

if (isset($_SESSION['session_id'])) {

	$form = $_POST;

	$id = $_SESSION['session_id'];
	$name = $form['name'];
	$email = $form['epost'];
	$adress = $form['adress'];
	$zipCode = $form['zipCode'];
	$city = $form['city'];
	$phoneNumber = $form['phoneNumber'];

	$sql = "UPDATE users SET name = '$name', email = '$email', role = :role, adress = '$adress', zipCode = '$zipCode', city = '$city', phoneNumber = '$phoneNumber' WHERE id = '$id'";

		$stmt = $pdo->prepare($sql);
		$stmt->execute(['role' => $_POST['role']]);

	}

header("Location: ../html/my_page.html");

?>