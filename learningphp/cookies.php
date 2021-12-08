<?php
$cookie_name = "user";
$cookie_value = "Alex Porter";

setrawcookie($cookie_name,rawurlencode($cookie_value),time() + (86400 * 30), "/"); //86400 = 1 day
//setcookie($cookie_name,"",time() - 3600, "/");

?>
<html>
<head>
<title>Cookies</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<a href="home.php">Home</a>
<a href="display_data.php">Display Data</a>

<h1>Learning PHP</h1>

<h2>Cookies</h2>

<?php
if(!isset($_COOKIE[$cookie_name])) {
echo "Cookie named '". $cookie_name . "' is not set!";
} else {
echo "Cookie named '". $cookie_name . "' is set!<br>";
echo "Value is: ". $_COOKIE[$cookie_name];
}
?>

<h3>Check if cookies are enabled</h3>

<a href="cookiescheck.php">Click Here</a>

</body>
</html>
