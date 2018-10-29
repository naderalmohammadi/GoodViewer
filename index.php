<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
Good Viewer
</title>
</head>



<body>
<header>
    <table id="table2">
    <tr><td>Good Viewer / Welcome</td><td id="tdr"> Because good reviews are valuable</td><tr>
    </table>
</header>
&nbsp
<?php require_once("config.php"); ?>


<form method='POST'>
<table id="table">
<tr><td><input type="text" name="username" placeholder="Your Username.." required></td></tr>
<tr><td><input type="Password" name="pass" placeholder="Your Password.." required></td></tr>
<tr><td colspan=2 align='center'><input type="submit" name="login" value="Login"></td></tr>
</form>
<form method='POST'>
<tr><td colspan=2 align='center'><input type="submit" name="signup" value="Create new account"></td></tr>
</form>
</table>

<?php
    if (isset($_POST['login'])) {
    	$user = $_POST['username'];
    	$pass = $_POST['pass'];
    	$verfiythisuser = verifyThisUser($user,$pass);
    	if($verfiythisuser==1){
    		header("Location:userpage.php?username=$user");
    	}
    	else{
    		?><p>Username and Password combination is not valid</p> <?php
    	}


    	}
    elseif (isset($_POST['signup'])) {
            header("Location:signup.php");

    }
?>





</body>
<footer><p>&copy Nader Almohammadi <?php echo date("Y"); ?></p></footer>




</html>