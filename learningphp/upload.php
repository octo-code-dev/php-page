<html>
<head>
<title>Upload Image</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<a href="home.php">Home</a>
<a href="display_data.php">Display Data</a>

<h1>Learning PHP</h1>

<h2>File Create/Write</h2>

<h3>File Upload</h3>

<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
  if($check !== false) {
    echo "<p>File is an image - " . $check["mime"] . ".</p>";
    $uploadOk = 1;
  } elseif ($_FILES['fileToUpload']['error'] != 0) {
    $error_types = array(
    1 => "<span>Your file is too large. Choose a file up to ".ini_get('upload_max_filesize')."B in size.</span><br>",
    2 => "<span>Your file is too large. Choose a file up to ".$_POST['MAX_FILE_SIZE']."B in size.</span><br>",
    3 => "<span>The uploaded file was only partially uploaded. Try again.</span><br>",
    4 => "<span>No file was uploaded. Try again.</span><br>",
    6 => "<span>Missing a temporary folder. Try again.</span><br>",
    7 => "<span>Failed to write file to disk. Try again.</span><br>",
    8 => "<span>A PHP extension stopped the file upload. Try again.</span><br>" 
    );
    $error_message = $error_types[$_FILES['fileToUpload']['error']];
    echo $error_message;
    $uploadOk = 0;
  } else {
    echo "<span>File is not an image.</span><br>";
    $uploadOk = 0;
  }
}

 // Check if file already exists
if (file_exists($target_file) and $target_file<>$target_dir) {
  echo "<span>File already exists.</span><br>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "<span>Only JPG, JPEG, PNG & GIF files are allowed.</span><br>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<p>Your file was not uploaded.</p>";
  
// If everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
    echo "<p>The file ". basename($_FILES['fileToUpload']['name']). " has been uploaded.</p>";
  } else {
    echo "<span>There was an error uploading your file.</span>";
  }
}

?>

</body>
</html>
