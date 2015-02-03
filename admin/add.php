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
		if (isset($_FILES["image"])){
      if (file_exists("assets/images/" . $_FILES["image"]["name"])) {
        $_SESSION['error']="Image already exists, please verify your submission.";
        header('location: addsite.php');
        die();
      } else {
        move_uploaded_file($_FILES["image"]["tmp_name"], "assets/images/" . $_FILES["image"]["name"]);
      	$user = $_POST['user_id'];
      	$title = escape_this_string($_POST['title']);
      	$url = escape_this_string($_POST['url']);
      	$date = date("Y-m-d H:i:s", strtotime(escape_this_string($_POST['date'])));
      	$desc = escape_this_string($_POST['description']);
      	$tech = escape_this_string($_POST['tech_info']);
        $active = escape_this_string($_POST['active']);
        $git = escape_this_string($_POST['github_address']);
      	$image = "assets/images/" . $_FILES["image"]["name"];
      	$query = "INSERT INTO projects (user_id, title, url, date, description, image_location, tech_info, active, github_address, created_at, updated_at) VALUES ('" . $user . "', '" . $title . "', '" . $url . "', '" . $date . "', '" . $desc . "', '" . $image . "', '" . $tech . "', '" . $active .", ". $git . "', '" . date('Y-m-d H:i:s', time()) . "', '". date('Y-m-d H:i:s', time()) . "')";
      	if (run_mysql_query($query)){
      		$_SESSION['success']="Entry added successfully.";
      		header('location: administer.php');
      		die();
      	} else {
          $_SESSION['error_details']=error_from_query();
      		$_SESSION['error']="There was an error adding the entry, please try again.";
        	header('location: addsite.php');
        	die();
      	}
      }
    }
	}
?>