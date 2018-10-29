<?php
if(empty($_GET['username'])){
	header("Location:index.php");
}
$username = $_GET['username'];
require_once("config.php");
$allrecords = searchAllPosts($username);
?>



<html >


<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
List of posts
</title>
</head>


<body>
<header>
	<table id="table2">
	<tr><td><a href="userpage.php?username=<?php print $username ?>">Good Viewer</a> / list of shows</td><td id="tdr"> Because good reviews are valuable</td><tr>
	</table>
</header>
<?PHP
if($allrecords==0){
  echo '<br><b>';
	?><p>There are no posts yet</p><?php
	}
	else{
?>
&nbsp
 <table id="table">
      <thead>
      <?php
      foreach($allrecords as $displayRecords) { ?>
      <tr><td>Posted by <?php print $displayRecords['username']; ?></td></tr>
      <th><a href="postdetails.php?username=<?php print $username?>&subject=<?php print $displayRecords['subject'];?>&user=<?php print $displayRecords['username'];?>&postid=<?php print $displayRecords['postid']; ?>"><?php print $displayRecords['subject']; ?></a></th>
      </thead>
      <tbody>
      <tr><td><a href="postdetails.php?username=<?php print $username?>&subject=<?php print $displayRecords['subject'];?>&user=<?php print $displayRecords['username'];?>&postid=<?php print $displayRecords['postid']; ?>"><img src=<?php print $displayRecords['image']; ?> width="400" height="430"></a></td></tr>
        <tr><td>My Rating: <?php print $displayRecords['rate']; ?> / 10</td></tr>
      <?php } ?>
      </tbody>
  </table>
<?php } ?>

</body>
<footer><p>&copy Nader Almohammadi <?php echo date("Y"); ?></p> <p><a href="index.php">Log out</a></p></footer>

</html>