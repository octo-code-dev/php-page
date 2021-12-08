<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" href="style.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script>
			$(document).ready(function(){

				// Variable to hold request
				var request;

				// Bind to the submit event of our form
				$("#secure-form").submit(function(event){

				    // Prevent default posting of form - put here to work in case of errors
				    event.preventDefault();

				    // Abort any pending request
				    if (request) {
				        request.abort();
				    }
				    // setup some local variables
				    var $form = $(this);

				    // Let's select and cache all the fields
				    var $inputs = $form.find("input, select, button, textarea");

				    // Serialize the data in the form
				    var serializedData = $form.serialize();

				    // Let's disable the inputs for the duration of the Ajax request.
				    // Note: we disable elements AFTER the form data has been serialized.
				    // Disabled form elements will not be serialized.
				    $inputs.prop("disabled", true);

				    // Fire off the request to /secure_form_response.php
				    request = $.ajax({
				        url: "./secure_form_response.php",
				        type: "post",
				        data: serializedData
				    });

				    // Callback handler that will be called on success
				    request.done(function (response, textStatus, jqXHR){
				        // Log a message to the console
				        //console.log("Hooray, it worked!");
				        //console.log("Data: "+serializedData);
				        console.log("Response: "+response);
				        $("#secure-form-response").html(response);
				        //console.log("textStatus: "+textStatus);
				        //console.log("jqXHR: "+jqXHR);
				    });

				    // Callback handler that will be called on failure
				    request.fail(function (jqXHR, textStatus, errorThrown){
				        // Log the error to the console
				        console.error(
				            "The following error occurred: "+
				            textStatus, errorThrown
				        );
				    });

				    // Callback handler that will be called regardless
				    // if the request failed or succeeded
				    request.always(function () {
				        // Reenable the inputs
				        $inputs.prop("disabled", false);
				    });

				});
			});
		</script>
	</head>
	<body>
		<header>
			<a href="home.php"><img src="img/PHP.png"></a>
		</header>
		<nav>
			<a href="#1">Forms</a>
			<a href="#2">Superglobals</a>
			<a href="#3">Regular Expressions</a>
			<a href="#4">Date and Time</a>
			<a href="#5">Inlude/Require</a>
			<a href="#6">File Handling</a>
		</nav>
		<main>
				<div id="1">
				<h2>Forms</h2>

				<h3>Displaying data of this form in another page</h3>

				<form action="display_data.php" method="post">
				<input type="text" name="fname" placeholder="First Name"><br>
				<input type="text" name="age" placeholder="Age"><br><br>
				<input type="submit" value="Send">

				</form>

				<h3>Secure form using htmlspecialchars, trim and stripslashes function. Response on the same page</h3>

				<form id="secure-form">

				<span>*Required fields</span><br><br>

				<input type="text" name="name" placeholder="Name*" value="<?php echo $name; ?>"><br>
				<span class="red"><?php echo $nameErr; ?></span><br>

				<input type="text" name="email" placeholder="E-mail*" value="<?php echo $email; ?>"><br>
				<span class="red"><?php echo $emailErr; ?></span><br>

				<input type="text" name="website" placeholder="Website" value="<?php echo $website; ?>"><br>
				<span class="red"><?php echo $websiteErr; ?></span><br>

				<textarea rows="5" cols="40" name="comment" placeholder="Comment*"><?php echo $comment; ?></textarea><br>
				<br>

				<select name="gender">
					<option selected disabled>Gender*</option>
					<option <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="Male">Male</option>
					<option <?php if (isset($gender) && $gender == "female") echo "checked"; ?> value="Female">Female</option>
					<option <?php if (isset($gender) && $gender == "other") echo "checked"; ?> value="Other">Other</option>
				</select>
				<span class="red"><?php echo $genderErr; ?></span><br>

				<input type="submit" value="Send"><br>
				</form>
				<div id="secure-form-response"></div>
			</div>
			<div id="2">
				<h2>Superglobals</h2>
				<h3>PHP superglobal variable SERVER elements</h3>

				<?php
				echo "<p>"."PHP_SELF: ".htmlspecialchars($_SERVER['PHP_SELF'])."</p>";
				echo "<p>"."SERVER_NAME: ".$_SERVER['SERVER_NAME']."</p>";
				echo "<p>"."HTTP_HOST: ".$_SERVER['HTTP_HOST']."</p>";
				echo "<p>"."HTTP_USER_AGENT: ".$_SERVER['HTTP_USER_AGENT']."</p>";
				echo "<p>"."SCRIPT_NAME: ".$_SERVER['SCRIPT_NAME']."</p>";
				?> 
			</div>			
			<div id="3">
				<h2>Regular Expressions</h2>

				<?php
				$str = "Erich";
				$pattern = "/^[a-zA-Z ]*$/";
				echo "<p>"."String: ".$str."</p>";
				echo "<p>"."Pattern: ".$pattern."</p>";
				echo "<p>"."Preg Match: ".preg_match($pattern, $str)."</p>";
				echo "<p>"."Preg Match All: ".preg_match_all($pattern, $str)."</p>";
				echo "<p>"."Preg Replace: ".preg_replace($pattern, "a", $str)."</p>";

				?>
			</div>
			<div id="4">
				<h2>Date and Time</h2>

				<h3>Date</h3>

				<p>Today is <?php echo date("l, d/m/Y."); ?></p>

				<h3>Copyright</h3>

				<p>&copy 2000-<?php echo date("Y"); ?></p>

				<h3>Time</h3>

				<p>The AM/PM time is: <?php echo date("h:i:s A."); ?></p>

				<p>The 24 hours time is: <?php echo date("H:i:s.");?></p>

				<p>The time zone in America/New York is: <?php date_default_timezone_set("America/New_York"); echo date("h:i:s A."); ?></p>

				<p>Using mktime() function: <?php $d=mktime(11, 14, 54, 8, 12, 2014); echo date("l, d/m/Y H:i:s.",$d);?></p>

				<p>Using strtotime("10:30pm April 15 2014") function: <?php $d=strtotime("10:30pm April 15 2014"); echo date("l, d/m/Y H:i:s.",$d);?></p>

				<p>Using strtotime("tomorrow") function: <?php $d=strtotime("tomorrow"); echo date("l, d/m/Y H:i:s.",$d);?></p>

				<p>Using strtotime("next Saturday") function: <?php $d=strtotime("next Saturday"); echo date("l, d/m/Y H:i:s.",$d);?></p>

				<p>Using strtotime("+3 Months") function: <?php $d=strtotime("+3 Months"); echo date("l, d/m/Y H:i:s.",$d);?></p>

				<p>

				Using strtotime function to show the date for the next 6 saturdays:<br>

				<?php 

				$startdate = strtotime("Saturday");
				$enddate = strtotime("+6 weeks", $startdate);

				while ($startdate < $enddate) {
					
					echo "<br>".date("d/m/Y", $startdate) . "<br>";
					
					$startdate = strtotime("+1 week", $startdate);
					
				}

				?>

				</p>

				<p>

				Using strtotime function to show the number of days until 4th of July:

				<?php
				$d1=strtotime("July 04");
				$d2=ceil(($d1-time())/60/60/24);
				echo $d2;
				?> 

				</p>
			</div>
			<div id="5">
				<h2>Inlude/Require</h2>

				<?php include 'include.php'; ?>

				<?php require 'require.php'; ?>
			</div>
			<div id="6">
				<h2>File Handling</h2>

				<p>The text below was inserted using the readfile() function:</p>

				<?php readfile("webdictionary.txt")."<br>"; ?>

				<h2>File Open/Read/Close</h2>

				<h3>fopen(), fread() and fclose() functions</h3>

				<p>The text below was inserted using the fopen(), fread() and fclose() functions:</p>

				<?php

				$myfile = fopen("webdictionary.txt", "r") or die("Unable to open file.");

				echo fread($myfile, filesize("webdictionary.txt"));

				fclose($myfile);

				?>

				<h3>fgets() function</h3>

				<p>The text below was inserted using the fopen(), fgets() and fclose() functions:</p>

				<?php

				$myfile = fopen("webdictionary.txt", "r") or die("Unable to open file.");

				echo fgets($myfile);

				fclose($myfile);

				?>

				<h3>feof() function</h3>

				<p>The text below was inserted using the fopen(), feof(), fgets() and fclose() functions:</p>

				<?php

				$myfile = fopen("webdictionary.txt","r") or die("Unable to open file.");

				while (!feof($myfile)) {
					
					echo fgets($myfile);
					
				}

				fclose($myfile);

				?>


				<h3>fgetc() function</h3>

				<p>The text below was inserted using the fopen(), feof(), fgetc() and fclose() functions:</p>

				<?php

				$myfile = fopen("webdictionary.txt","r") or die("Unable to open file.");

				while (!feof($myfile)) {
					
					echo fgetc($myfile);
					
				}

				fclose($myfile);

				?>

				<h2>File Create/Write</h2>

				<h3>Create/Write</h3>

				<p>The text below was inserted using the fopen(), fwrite() fclose(), feof() and fgets() functions:</p>

				<?php

				$myfile = fopen("newfile.txt","w") or die("Unable to open file.");

				$txt = "John Doe\n";

				fwrite($myfile,$txt);

				$txt = "Jane Doe\n";

				fwrite($myfile,$txt);

				fclose($myfile);

				$myfile = fopen("newfile.txt", "r") or die("Unable to open file.");

				while (!feof($myfile)) {
					
					echo "<p>".fgets($myfile)."</p>";
					
				}

				fclose($myfile);

				?>

				<h3>Overwriting</h3>

				<p>The text below overwriten the text above ("John Doe" and "Jane Doe") in the "newfile.txt" file using the same functions:</p>

				<?php

				$myfile = fopen("newfile.txt","w") or die("Unable to open file.");

				$txt = "Mickey Mouse\n";

				fwrite($myfile,$txt);

				$txt = "Minnie Mouse\n";

				fwrite($myfile,$txt);

				fclose($myfile);

				$myfile = fopen("newfile.txt", "r") or die("Unable to open file.");

				while (!feof($myfile)) {
					
					echo "<p>".fgets($myfile)."</p>";
					
				}

				fclose($myfile);

				?>

				<h2>File Upload</h2>

				<form action="upload.php" method="post" enctype="multipart/form-data">
				<label>Select image to upload:</label><br><br>
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Upload Image" name="submit">
				</form>
			</div>
			<h2>Cookies</h2>

			<a href="cookies.php">Click Here</a>

			<h2>Sessions</h2>

			<h3>Start a PHP Session</h3>

			<a href="demo_session1.php">Click Here</a>

			<h2>Filters</h2>

			<h3>Sanitize a String</h3>

			<?php
			$str = "<h1>Hello World!</h1>";
			echo "String with h1 tags: " . $str;
			$newstr = filter_var($str, FILTER_SANITIZE_STRING);
			echo "String without h1 tags using filter_var function and FILTER_SANITIZE_STRING filter: <br><br>" . $newstr;
			?>

			<h3>Validate an Integer</h3>

			<?php
			$int = 100;
			echo "Integer to be validated: " . $int . ". ";

			if (!filter_var($int, FILTER_VALIDATE_INT) === false){
				echo ("Integer is valid.<br><br>");
			} else {
				echo ("Integer is not valid.<br><br>");
			}

			$int = 'a';
			echo "Integer to be validated: " . $int . ". ";

			if (!filter_var($int, FILTER_VALIDATE_INT) === false){
				echo ("Integer is valid.<br><br>");
			} else {
				echo ("Integer is not valid.<br><br>");
			}

			$int = 0;
			echo "Integer to be validated: " . $int . ". ";

			if (!filter_var($int, FILTER_VALIDATE_INT) === false){
				echo ("Integer is valid.<br><br>");
			} else {
				echo ("Integer is not valid.<br><br>");
			}
			?>

			<h3>Tip: filter_var() and Problem With 0</h3>

			<?php
			$int = 0;
			echo "Integer to be validated: " . $int . ". ";

			if (filter_var($int, FILTER_VALIDATE_INT) === 0 || !filter_var($int, FILTER_VALIDATE_INT) === false){
				echo ("Integer is valid.<br><br>");
			} else {
				echo ("Integer is not valid.<br><br>");
			}
			?>

			<h3>Validate an IP Address</h3>

			<?php
			$ip = "127.0.0.1";

			echo "IP to be validated: " . $ip . ".</p>";

			if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
				echo "<p>$ip is a valid IP address.</p>";
			} else {
				echo "<p>$ip is not a valid IP address.</p>";
			}

			$ip = "abcd";

			echo "<p>IP to be validated: " . $ip . ".</p>";

			if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
				echo "<p>$ip is a valid IP address.</p>";
			} else {
				echo "<p>$ip is not a valid IP address.</p>";
			}
			?>

			<h3>Sanitize and Validate an Email Address</h3>

			<?php
			$email = " j o h n . d o e @ e x a m p l e . c o m ";

			echo "<p>Email: ". $email . ".</p>";

			$email = filter_var($email, FILTER_SANITIZE_EMAIL);

			echo "<p>Sanitized Email: ". $email . ".</p>";

			if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				echo "<p>" . $email . " is a valid email address.</p>";
			} else {
				echo "<p>" . $email . " is not a valid email address.</p>";
			}

			$email = " 1 2 3 4 ";

			echo "<p>Email: ". $email . ".</p>";

			$email = filter_var($email, FILTER_SANITIZE_EMAIL);

			echo "<p>Sanitized Email: ". $email . ".</p>";

			if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				echo "<p>" . $email . " is a valid email address.</p>";
			} else {
				echo "<p>" . $email . " is not a valid email address.</p>";
			}
			?>

			<h3>Sanitize and Validate a URL</h3>

			<?php
			$url = " h t t p s : / / w w w . w 3 s c h o o l s . c o m ";

			echo "<p>URL: $url.</p>";

			$url = filter_var($url, FILTER_SANITIZE_URL);

			echo "<p>Sanitized URL: $url.</p>";

			if(!filter_var($url, FILTER_VALIDATE_URL) === false){
				echo "<p>$url is a valid URL.</p>";
			} else {
				echo "<p>$url is not a valid URL.</p>";
			}
			?>

			<h2>Filters Advanced</h2>

			<h3>Validate an Integer Within a Range</h3>

			<?php
			$int = 122;
			echo "<p>Integer to be validated: $int.</p>";
			$min = 1;
			echo "<p>Min value: $min.</p>";
			$max = 200;
			echo "<p>Max value: $max.</p>";


			if(filter_var($int, FILTER_VALIDATE_INT, array("options" => array("min_range" => $min, "max_range" => $max))) === false) {
				echo ("<p>Variable value is not within the legal range.</p>");
			} else {
				echo ("<p>Variable value is within the legal range.</p>");
			}
			?>

			<h3>Validate IPv6 Address</h3>

			<?php
			$ip = "2001:0db8:85a3:08d3:1319:8a2e:0370:7334";
			echo "<p>IPv6 to be validated: $ip.</p>";

			if(!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
				echo "<p>$ip is a valid IPv6 address.</p>";
			} else {
				echo "<p>$ip is not a valid IPv6 address.</p>";
			}
			?>

			<h3>Validate URL - Must Contain QueryString</h3>

			<?php
			$url = "https://www.w3schools.com";
			echo "<p>URL to be validated: $url.</p>";

			if(!filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED) === false) {
				echo ("<p>$url is a valid URL with a query string.</p>");
			} else {
				echo ("<p>$url is not a valid URL with a query string.</p>");
			}
			?>

			<h3>Remove Characters With ASCII Value > 127</h3>

			<?php
			$str = "<h1>Hello WorldÆØÅ!</h1>";
			echo "<p>String</p>" . $str;

			$newstr = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			echo "<p>New string: $newstr</p>";
			?>

			<h2>Callback Functions</h2>

			<h3>Pass a callback to PHP's array_map() function to calculate the length of every string in an array:</h3>

			<?php
			function my_callback($item) {
			return strlen($item);
			}

			$strings = ["apple", "orange", "banana", "coconut"];
			echo "<p>Strings</p>";
			print_r($strings);
			echo "<br>";
			echo "<p>Lengths</p>";
			$lengths = array_map("my_callback", $strings);
			print_r($lengths);
			?>

			<h3>Use an anonymous function as a callback for PHP's array_map() function:</h3>

			<?php
			$strings = ["apple", "orange", "banana", "coconut"];
			echo "<p>Strings</p>";
			print_r($strings);
			echo "<br>";
			echo "<p>Lengths</p>";
			$lengths = array_map( function($item) { return strlen($item); }, $strings);
			print_r($lengths);
			?>

			<h3>Run a callback from a user-defined function:</h3>

			<?php
			function exclaim($str){
			echo "<p>".$str."!</p>";
			}

			function ask($str){
			echo "<p>".$str."?</p>";
			}

			function printFormatted($str, $format){
			// Calling the $format callback function
			echo $format($str);
			}

			printFormatted("Hello world", "exclaim");
			printFormatted("Hello world", "ask");
			?>

			<h2>JSON</h2>

			<h3>json_encode()</h3>

			<p>This example shows how to encode an associative array into a JSON object:</p>
			<?php
			$age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

			echo json_encode($age);
			?>

			<p>This example shows how to encode an indexed array into a JSON array:</p>

			<?php
			$cars = array("Volvo", "BMW", "Toyota");

			echo json_encode($cars);
			?>

			<h3>json_decode()</h3>

			<p>This example decodes JSON data into a PHP object:</p>
			<?php
			$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';

			var_dump(json_decode($jsonobj));
			?>

			<p>This example decodes JSON data into a PHP associative array:</p>

			<?php
			$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';

			var_dump(json_decode($jsonobj,true));
			?>

			<h3>Accessing the Decoded Values</h3>

			<p>This example shows how to access the values from a PHP object:</p>

			<?php
			$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';

			$obj = json_decode($jsonobj);

			echo $obj->Peter."<br>";
			echo $obj->Ben."<br>";
			echo $obj->Joe."<br>";
			?>

			<p>This example shows how to access the values from a PHP associative array:</p>

			<?php
			$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';

			$arr = json_decode($jsonobj, true);

			echo $arr["Peter"]."<br>";
			echo $arr["Ben"]."<br>";
			echo $arr["Joe"]."<br>";
			?>

			<h3>Looping Through the Values</h3>

			<p>This example shows how to loop through the values of a PHP object:</p>

			<?php
			$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';

			$obj = json_decode($jsonobj);

			foreach($obj as $key => $value){

			echo $key . "=>" . $value . "<br>";
			}
			?>

			<p>This example shows how to loop through the values of a PHP associative array:</p>

			<?php
			$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';

			$obj = json_decode($jsonobj, true);

			foreach($obj as $key => $value){

			echo $key . "=>" . $value . "<br>";
			}
			?>

			<h2>Exceptions</h2>

			<h3>Throwing an Exception</h3>

			<p>Throwing an exception without catching it:</p>

			<?php
			/*function divide_a($dividend, $divisor) {
				if($divisor == 0) {
					throw new Exception("Division by zero");
				}
				return $dividend / $divisor;
			}

			echo divide_a(5, 0);*/
			?>

			<h3>The try...catch Statement</h3>

			<?php
			function divide_b($dividend, $divisor) {
				if($divisor == 0) {
					throw new Exception("Division by zero");
				}
				return $dividend / $divisor;
			}

			try {
			echo divide_b(5, 0);
			} catch (Exception $e) {
			echo "Unable to divide";
			}
			?>

			<h3>The try...catch...finally Statement</h3>

			<p>Show a message when an exception is thrown and then indicate that the process has ended:</p>

			<?php
			function divide_c($dividend, $divisor) {
				if($divisor == 0) {
					throw new Exception("Division by zero");
				}
				return $dividend / $divisor;
			}

			try {
			echo divide_c(5, 0);
			} catch (Exception $e) {
			echo "<p>Unable to divide</p>";
			} finally {
			echo "<p>Process completed</p>";
			}
			?>

			<p>Output a string even if an exception was not caught:</p>

			<?php
			/*function divide_d($dividend, $divisor) {
				if($divisor == 0) {
					throw new Exception("Division by zero");
				}
				return $dividend / $divisor;
			}

			try {
			echo divide_d(5, 0);
			} finally {
			echo "<p>Process completed</p>";
			}*/
			?>

			<h3>The Exception Object</h3>

			<p>Output information about an exception that was thrown:</p>

			<?php
			function divide_e($dividend, $divisor) {
				if ($divisor == 0) {
					throw new Exception ("Division by zero", 1);
			}
				return $dividend / $divisor;
			}

			try {
				echo divide_e(5,0);
			} catch (Exception $ex) {
				$code = $ex->getCode();
				$message = $ex->getMessage();
				$file = $ex->getFile();
				$line = $ex->getLine();

				echo "<p>Exception thrown in $file on line $line: [Code $code] $message</p>";
			}
			?>

			<h2>OOP</h2>

			<h3>Classes/Objects</h3>

			<?php
			class Fruit {

				public $name;
				public $color;
				
				function set_name($name) {
					$this->name = $name;
				}
				
				function get_name() {
					return $this->name;
				}
				
				function set_color($color) {
					$this->color = $color;
				}
				
				function get_color() {
					return $this->color;
				}
				
			}

			$apple = new Fruit();
			$apple->set_name('Apple');
			$apple->set_color('Red');

			echo '<p>'.$apple->get_name().'</p>';
			echo '<p>'.$apple->get_color().'</p>';
			var_dump($apple instanceof Fruit);

			$banana = new Fruit();
			$banana->set_name('Banana');
			$banana->set_color('Yellow');

			echo '<p>'.$banana->get_name().'</p>';
			echo '<p>'.$banana->get_color().'</p>';
			var_dump($apple instanceof Fruit);
			?>

			<h3>Constructor</h3>

			<?php

			class Fruit2 {
				
				public $name;
				public $color;
				
				function __construct($name) {
					$this->name = $name;
				}
				
				function get_name() {
					return $this->name;
				}
				
			}

				$apple = new Fruit2('Apple');
				echo '<p>'.$apple->get_name().'</p>';
				
			?>

			<h4>Another example:</h4>

			<?php

			class Fruit3 {
				
				public $name;
				public $color;
				
				function __construct($name, $color) {
					$this->name = $name;
					$this->color = $color;
				}
				
				function get_name() {
					return $this->name;
				}
				
				function get_color() {
				 return $this->color;
				}
				
			}

			$apple = new Fruit3('Apple', 'Red');
			echo '<p>'.$apple->get_name().'</p>';
			echo '<p>'.$apple->get_color().'</p>';

			?>
		</main>
	</body>
</html>
