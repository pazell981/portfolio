<?php
	if(!isset($_POST['secure'])){
		header("location: index.html");
		die();
	} else {
		session_start();
		// include "new-connection.php";
		if ($_FILES["file"]["name"]){
			if($_FILES["file"]["error"]){
				$_SESSION["file"]["error"] = "Error on file upload Return Code: " . $_FILES["file"]["error"];
			} else {
				$directory = "uploads/";
				$file_name = $_FILES["file"]["name"];
				$file_path = $directory . $file_name;
				if (file_exists($file_path)){
			  		$_SESSSION['error']['file'] = $file_name . " already exists. ";
			 	} else {
			  		if(!move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)){
			   			$_SESSION['message'] = $file_name." could not be saved";
			  		}
			 	}
			}
			$file = fopen($file_path, 'r');
			while (($line = fgetcsv($file)) !== FALSE) {
				$array[] = $line;
			}
			fclose($file);
		}
		$_SESSION['csv'] = $array;
		header("location: viewer.php");
		die();
	}
?>
