<?php
	session_start();
	date_default_timezone_set('America/Los_Angeles');
	include "dbConnection.php";
	if(!isset($_POST['secure'])){
		session_destroy();
		session_start();
		header('location: ../403.shtml');
		die();
	} else {
    $proj_id = $_POST['id'];
    $proj_query = "SELECT * FROM projects WHERE id=".$proj_id;
    $project = fetch_record($proj_query); 
    $_SESSION['project'] = $project;
    header('location: editsite.php');
    die();
	}
?>