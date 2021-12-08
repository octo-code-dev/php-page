<?php 
$name = $email = $website = $comment = $gender = "";
$nameErr = $emailErr = $websiteErr = $genderErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	//Name
	if (empty($_POST["name"])){
		$nameErr = "* Name is required.";
	}
	
	elseif (!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])) {
		$nameErr = "* Only letters and white space allowed.";
	}
	
	else {
		$name = formValidation($_POST["name"]);
		echo "<p>"."Name: ".$name.".</p>";
	}
	
	//E-mail
	if (empty($_POST["email"])){
		$emailErr = "* E-mail is required.";
	}
	
	elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
					$emailErr = "* Invalid email format";
			}
	
	else {
		$email = formValidation($_POST["email"]);
		echo "<p>"."E-mail: ".$email.".</p>";
	}
	
	//Website
	if (empty($_POST["website"])) {
		$website = "";
	}
	
	elseif (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$_POST["website"])) {
		$websiteErr = "Invalid URL";
			}
	
	else {
		$website = formValidation($_POST["website"]);
		echo "<p>"."Website: ".$website.".</p>";
	}
	
	//Comment
	if (empty($_POST["comment"])) {
		$comment = "";
	}
	
	else {
		$comment = formValidation($_POST["comment"]);

		echo "<p>"."Comment: ".$comment.".</p>";
	}
	
	//Gender
	if (empty($_POST["gender"])) {
		$genderErr = "* Gender is required";
	}
	
	else {
		$gender = formValidation($_POST["gender"]);
		echo "<p>"."Gender: ".$gender.".</p>";
	}
}

function formValidation($data){
	
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	
};
?>