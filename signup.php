<html>


<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
signup
</title>
</head>

<header>
    <table id="table2">
    <tr><td>Good Viewer / Sign up</td><td id="tdr"> Because good reviews are valuable</td><tr>
    </table>
</header>
&nbsp
<body>
  <?php require_once("config.php"); ?>



<form method='POST'>
<table id="table">
<tr><td><input type="text" name="username" maxlength="20" placeholder="Your Username.." required></td></tr>
<tr><td><input type="number" name="age" min ='18' step="1" max='80' placeholder="Your Age.." required></td></tr>
<tr><td><input type="radio" name="gender" value='Male' checked>Male<input type="radio" name="gender" value='Female'>Female</td></tr>
<tr><td><input type="email" name="email" maxlength="50" placeholder="Email.." required></td></tr>
<tr><td><input type="email" name="emailcon" maxlength="50" placeholder="Confirm Email.." required></td></tr>
<tr><td><input type="Password" name="pass" maxlength="20" placeholder="Password.." required></td></tr>
<tr><td><input type="Password" name="passcon" maxlength="20" placeholder="Confirm Password.." required></td></tr>

<tr><td colspan=2 align='center'><input type="submit" name="create" value="Create"></td></tr>
</table>

<?php
    if (isset($_POST['create'])) {
    	$username = $_POST['username'];
    	$email = $_POST['email'];
    	$thisuser = fetchThisUser($username);
    	$thisemail = fetchThisEmail($email);
    	if ($_POST['email'] != $_POST['emailcon']){
    				?><p>Email confirmation doesn't match</p><?php
    		}
    		elseif ($_POST['pass'] != $_POST['passcon']){
    				?><p>Password confirmation doesn't match</p><?php
    		}
    		elseif ($thisuser==1){
					?><p>Username already exists</p><?php
    		}
    		elseif ($thisemail==1){
					?><p>Email already exists</p><?php
    		}
    		else{

				require_once("config.php");

				$name = $_POST['username'];
				$age = $_POST['age'];
				$gender = $_POST['gender'];
				$email = $_POST['email'];
				$pass = $_POST['pass'];


				$newuser = createNewUser($name, $age, $gender, $email, $pass);

				echo $newuser;
				if ($newuser==1){
				header("Location:index.php");}}

    }
?>





</body>
<footer><p>&copy Nader Almohammadi <?php echo date("Y"); ?></p></footer>



</html>