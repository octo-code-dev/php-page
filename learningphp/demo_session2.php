<?php
session_start();
?>

<html>
<head>
<title>Demo Session 2</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<a href="home.php">Home</a>
<a href="display_data.php">Display Data</a>

<h1>Learning PHP</h1>

<h2>Sessions</h2>

<h3>Get PHP Session Variable Values</h3>

<?php
echo "<p>Favorite color is: ".$_SESSION["favcolor"].".</p>";
echo "<p>Favorite animal is: ".$_SESSION["favanimal"].".</p>";
?>

<h3>Showing all the session variable values for a user session</h3>

<?php
echo "<p>".print_r($_SESSION)."</p>";
?>

<h3>Modify a PHP Session Variable</h3>
<?php
$_SESSION["favcolor"] = "yellow";
echo "<p>Favorite color is: ".$_SESSION["favcolor"].".</p>";
?>

<h3>Remove All Session Variables</h3>
<?php
session_unset();
echo "<p>Favorite color is: ".$_SESSION["favcolor"].".</p>";
echo "<p>Favorite animal is: ".$_SESSION["favanimal"].".</p>";
?>

<h3>Destroy the Session</h3>
<?php
session_destroy();
echo "<p>Session was destroyed.</p>";
?>

</body>
</html>
