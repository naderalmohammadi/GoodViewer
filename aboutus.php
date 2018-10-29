<?php
if(empty($_GET['username'])){
  header("Location:index.php");
}
$username = $_GET['username'];
require_once("config.php");
$allrecords = fetchAllPosts($username);
?>
<html >


<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
About us
</title>
</head>
<body>
<header>
  <table id="table2">
  <tr><td><a href="userpage.php?username=<?php print $username ?>">Good Viewer</a> / About the developer</td><td id="tdr"> Because good reviews are valuable</td><tr>
  </table>
</header>

<table><tr><td><p>Nader Almohammadi</p></td></tr>
<tr><td><p>Graduate student in Information Systems at Pace University</p></td></tr>
<tr><td><p>Email: nn-1411@hotmail.com</p></td></tr>
<tr><td><p>Phone: 3477778096</p></td></tr></table>
</body>
<footer><p>&copy Nader Almohammadi <?php echo date("Y"); ?></p></footer>

</html>