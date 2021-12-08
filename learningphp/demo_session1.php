<?php
session_start();
?>

<html>
<head>
<title>Demo Session 1</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<a href="home.php">Home</a>
<a href="display_data.php">Display Data</a>

<h1>Learning PHP</h1>

<h2>Sessions</h2>

<?php
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
echo "<p>Session variables are set.</p>";
?>

<h3>Get PHP Session Variable Values</h3>

<a href="demo_session2.php">Click Here</a>
