<?php
	function sanitize($data){
		if ( preg_match( "/[\r\n]/", $data ) {
			$output["status"] = "forbidden";
			echo json_encode($output);
			die();		
		}
	}

	if (!isset($_POST["secure"])){
		header('location: ../403.shtml');
		die();
	} else {
		date_default_timezone_set( "America/Los_Angeles" ); 
		$now = new DateTime(); 
		$name = sanitize($_POST['name']);
		$email = sanitize($_POST['email']);
		$subject = "PAZellmer.com Contact Request: " . sanitize($_POST['subject']);
		$message = $_POST['message'];
		$headers = "From: " . $name . " <" . $email . ">\r\n";
		$headers .= "Reply-To: " . $name . " <" . $email . ">\r\n";
		$headers .= "Date: " . date_format($now, 'r') ."\r\n"; 
		$headers .= "X-Mailer: PHP/".phpversion();

		if (mail("web@pazellmer.com", $subject, $message, $headers)){
			$output["status"] = "success";
			mail($email, "Thank you!", "Thank you " . $name . " for your interest, I will get in contact with you as soon as possible. \r\n\r\n Paul");
		} else {
			$output["status"] = "failure";
		}
		echo json_encode($output);
		die;
	}

?>