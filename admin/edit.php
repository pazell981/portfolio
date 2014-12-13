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
        $user = $_POST['user_id'];
        $project = $_POST['project_id'];
        $title = escape_this_string($_POST['title']);
        $url = escape_this_string($_POST['url']);
        $date = date("Y-m-d H:i:s", strtotime(escape_this_string($_POST['date'])));
        $desc = escape_this_string($_POST['description']);
        $tech = escape_this_string($_POST['tech_info']);
        $active = escape_this_string($_POST['active']);
        $git = escape_this_string($_POST['github_address']);
        $query = "UPDATE projects SET user_id=". $user .", title='" . $title . "', url='" . $url . "', date='" . $date . "', description='" . $desc . "', tech_info='" . $tech . ", active='". $active . "', github_address='" . $git . "', updated_at='" . date('Y-m-d H:i:s', time()) . "' WHERE id=" . $project;
      } else {
        move_uploaded_file($_FILES["image"]["tmp_name"], "assets/images/" . $_FILES["image"]["name"]);
      	$user = $_POST['user_id'];
      	$project = $_POST['project_id'];
        $title = escape_this_string($_POST['title']);
      	$url = escape_this_string($_POST['url']);
      	$date = date("Y-m-d H:i:s", strtotime(escape_this_string($_POST['date'])));
      	$desc = escape_this_string($_POST['description']);
      	$tech = escape_this_string($_POST['tech_info']);
        $active = escape_this_string($_POST['active']);
        $git = escape_this_string($_POST['github_address']);
      	$image = "assets/images/" . $_FILES["image"]["name"];
      	$query = "UPDATE projects SET user_id=". $user .", title='" . $title . "', url='" . $url . "', date='" . $date . "', image_location='" . $image ."', description='" . $desc . "', tech_info='" . $tech . ", active='". $active . "', github_address='" . $git . "', updated_at='" . date('Y-m-d H:i:s', time())  . "' WHERE id=" . $project;
      }
    } else {
      $user = $_POST['user_id'];
      $project = $_POST['project_id'];
      $title = escape_this_string($_POST['title']);
      $url = escape_this_string($_POST['url']);
      $date = date("Y-m-d H:i:s", strtotime(escape_this_string($_POST['date'])));
      $desc = escape_this_string($_POST['description']);
      $tech = escape_this_string($_POST['tech_info']);
      $active = escape_this_string($_POST['active']);
      $git = escape_this_string($_POST['github_address']);
      $query = "UPDATE projects SET user_id=". $user .", title='" . $title . "', url='" . $url . "', date='" . $date . "', description='" . $desc . "', tech_info='" . $tech . ", active='". $active . "', github_address='" . $git . "', updated_at='" . date('Y-m-d H:i:s', time()) . "' WHERE id=" . $project;
    }
  	if (run_mysql_query($query)){
  		$_SESSION['success']="Entry updated successfully.";
  		header('location: administer.php');
  		die();
  	} else {
  		$_SESSION['error']="There was an error updating the entry, please try again.";
    	header('location: editsite.php');
    	die();
  	}
	}
?>