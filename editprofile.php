<?php
if(empty($_GET['username'])){
    header("Location:index.php");
}
$username = $_GET['username'];
require_once("config.php");
$allrecords = fetchUser($username);
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
Edit Profile
</title>
</head>

<header>
    <table id="table2">
    <tr><td><a href="userpage.php?username=<?php print $username ?>">Good Viewer</a> / Edit Profile</td><td id="tdr"> Because good reviews are valuable</td><tr>
    </table>
</header>
&nbsp
<body>
  <?php require_once("config.php"); ?>


<?php 
if($allrecords==0){
    ?><p>This user doesn't exists</p><?php
}
else{
?>
<?php
foreach($allrecords as $display){
?>
<form method='POST'>
<table id="table">
<tr><td><input type="number" name="age" min ='18' step="1" max='80' value="<?php print $display['age']?>" placeholder="Update Age.." required></td></tr>
<tr><td><input type="radio" name="gender" value='Male' checked>Male<input type="radio" name="gender" value='Female'>Female</td></tr>
<tr><td><input type="Password" name="pass" maxlength="20" value="<?php print $display['password']?>" placeholder="Update Password.." required></td></tr>
<tr><td><input type="Password" name="passcon" maxlength="20" value="<?php print $display['password']?>" placeholder="Confirm Updated Password.." required></td></tr>

<tr><td colspan=2 align='center'><input type="submit" name="create" value="Edit"></td></tr>
</table>
</form>
<?php }?>
<?php
    if (isset($_POST['create'])) {
    	if ($_POST['pass'] != $_POST['passcon']){
    				?><p>Password confirmation doesn't match</p><?php
    		}
    		else{

				$name = $username;
				$age = $_POST['age'];
				$gender = $_POST['gender'];
				$pass = $_POST['pass'];
				$newuser = updateThisUser($name, $age, $gender, $pass);
				if ($newuser==1){
				header("Location:userpage.php?username=$username");}}

    }
?>
<?php }?>




</body>
<footer><p>&copy Nader Almohammadi <?php echo date("Y"); ?></p></footer>



</html>