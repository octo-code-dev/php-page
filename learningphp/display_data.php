<html>
<head>
<title>Display Data</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<a href="home.php">Home</a>
<a href="display_data.php">Display Data</a><br><br>

<h1>Learning PHP</h1>

<h2>Forms</h2>

<h3>Displaying data of the form there's in another page:</h3>

<?php 
if ($_POST["fname"] != "" and $_POST["age"] != "") {
	
	echo "<p>Your first name is ". $_POST["fname"]." and your age is ". $_POST["age"]."."."</p>";
	
}

else {
	echo "<span>"."No data was inserted on the other page."."</span>";
}

?>

</body>
</html>
