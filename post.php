<?php
if(empty($_GET['username'])){
    header("Location:index.php");
}
$username = $_GET['username'];
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Add New Show</title></head>
<body>
<header>
    <table id="table2">
    <tr><td><a href="userpage.php?username=<?php print $username ?>">Good Viewer</a> / Add New Show</td><td id="tdr"> Because good reviews are valuable</td><tr>
    </table>
</header>
&nbsp
<form method="post" enctype="multipart/form-data">
<table id="table">
    <tr><td><input id="td" type="text" name="name" maxlength="20" placeholder="Title.." required></td></tr>
    <tr><td><textarea id="td" name="content" cols="40" rows="5" maxlength="400" placeholder="Review.." required></textarea></td></tr>
    <tr><td><input id="td" type="number" name="rate" min ='0' max='10' step='0.1' placeholder="Rating (0-10).." required></td></tr>
    <tr><td>Poster: <input type="file" name="fileToUpload" id="fileToUpload" required></td></tr>
    <tr><td><input type="submit" value="Post" name="submit"></td></tr>
    </table>
</form>


<?php
if (isset($_POST['submit'])) {
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        ?><p>File is not an image</p><?php
        $uploadOk = 0;
    }
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    ?><p>Sorry, only JPG, JPEG, PNG and GIF files are allowed</p><?php
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    ?><p>Sorry, your file was not uploaded. Post Failed</p><?php
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        ?><p>Done</p><?php

                        require_once("config.php");

                $user_name = $username;
                $subject = $_POST['name'];
                $content = $_POST['content'];
                $rate = $_POST['rate'];
                $image = 'uploads/'.basename( $_FILES["fileToUpload"]["name"]);


                $newpost = createNewPost($user_name, $subject, $content, $rate, $image);
    } else {
        ?><p>Sorry, there was an error. Post Failed</p><?php
    }
}}
?>
</body>
<footer><p>&copy Nader Almohammadi <?php echo date("Y"); ?></p></footer>
</html>

