<?php
session_start();
include "dbConnection.php";

if(!isset($_POST['secure'])){
	header('location: index.php');
	die();
} else {
	$email = escape_this_string($_POST['email']);
	$password = escape_this_string($_POST['password']);
	$errors = array('email'=>null,'password'=>null);

	$query = "SELECT id, enc_password FROM users WHERE email='" . $email . "'";

	$result = fetch_record($query);

	$encpassword = crypt($password, $result['enc_password']);

	if(is_null($result)){
		$errors['email']=TRUE;
		$errors['password']=FALSE;
		$_SESSION['errors']=$errors;
		header('location: ../index.php');
		die();
	} elseif ($result['enc_password']!==$encpassword) {
		$errors['password']=TRUE;
		$errors['email']=FALSE;
		$_SESSION['errors']=$errors;
		header('location: ../index.php');
		die();
	} else{
		$_SESSION['userid'] = $result['id'];
		header('location: administer.php');
		die();
	}
}
?>