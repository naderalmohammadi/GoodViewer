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
Profile
</title>
</head>
<header>
  <table id="table2">
  <tr><td>Good Viewer / <?php echo $username;?>'s list</td><td id="tdr"> Because good reviews are valuable</td><tr>
  </table>
</header>

<body>
<div id="sidebar"><a href="editprofile.php?username=<?php print $username?>"><h6 id="p">Edit Profile</h6></a><a href="post.php?username=<?php print $username?>"><h6 id="p">Add New Show/Movie</h6></a><a href="aboutus.php?username=<?php print $username?>"><h6 id="p">About the developer</h6></a><a href="usersposts.php?username=<?php print $username?>"><h6 id="p">List of Shows/Movies</h6></a></div>
<?PHP
if($allrecords==0){
  echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
	?><p>You don't have any posts yet</p><?php
	}
	else{
?>
&nbsp
 <table id="table">
      <thead>
      <?php
      foreach($allrecords as $displayRecords) { ?>
      <th><a href="moviepage.php?subject=<?php print $displayRecords['subject'];?>&username=<?php print $username?>&postid=<?php print $displayRecords['postid']; ?>"><?php print $displayRecords['subject']; ?></a></th>
      </thead>
      <tbody>
      <tr><td><a href="moviepage.php?subject=<?php print $displayRecords['subject'];?>&username=<?php print $username?>&postid=<?php print $displayRecords['postid']; ?>"><img src=<?php print $displayRecords['image']; ?> width="400" height="430"></a></td></tr>
        <tr><td>My Rating: <?php print $displayRecords['rate']; ?> / 10</td></tr>
      <?php } ?>
      </tbody>
  </table>
<?php } ?>

</body>
<footer><p>&copy Nader Almohammadi <?php echo date("Y"); ?><a href="index.php"><h3 align ="center">Log out<h3></a></p></footer>

</html>