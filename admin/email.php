<?php
	// function sanitize($data){
	// 	if ( preg_match( "/[\r\n]/", $data, $matches) {
	// 		$output["status"] = "forbidden";
	// 		$output["matches"] = $matches;
	// 		var_dump($output);
	// 		die();
	// 		echo json_encode($output);
	// 		die();
	// 	} else {
	// 		return $data;
	// 	}
	// }

	if (!isset($_POST["secure"])){
		header('location: ../403.shtml');
		die();
	} else {
		date_default_timezone_set( "America/Los_Angeles" ); 
		$now = new DateTime(); 
		$name = filter_var($_POST['name'], FILTER_SANITIZE_EMAIL, FILTER_NULL_ON_FAILURE);
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL, FILTER_NULL_ON_FAILURE);
		$subject = "PAZellmer.com Contact Request: " . filter_var($_POST['subject'], FILTER_SANITIZE_EMAIL, FILTER_NULL_ON_FAILURE);
		$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_NULL_ON_FAILURE);
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
		var_dump($output);
		die();
		echo json_encode($output);
		die();
	}
?>