<?php
setrawcookie("test_cookie","test",time() + 3600, "/");
?>
<html>
<head>
<title>Cookies Check</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<a href="home.php">Home</a>
<a href="display_data.php">Display Data</a>

<h1>Learning PHP</h1>

<h2>Cookies</h2>

<h3>Check if cookies are enabled</h3>

<?php
if(count($_COOKIE)>0){
echo "Cookies are enabled.";
} else {
echo "Cookies are disabled.";
}
?>
</body>
</html>
