<?php
if(empty($_GET['postid'])){
  header("Location:index.php");
}
$username = $_GET['username'];
$postid = $_GET['postid'];
$subject = $_GET['subject'];
require_once("config.php");
$allrecords = fetchThisPost($username,$postid);
$allreplies = fetchThisReply($postid);
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
Profile
</title>
</head>


<body>
<header>
  <table id="table2">
  <tr><td><a href="userpage.php?username=<?php print $username ?>">Good Viewer</a> / <?php echo $subject;?> </td><td id="tdr"> Because good reviews are valuable</td><tr>
  </table>
</header>
<?PHP
if($allrecords==0){
	?><p>You don't have any posts yet</p><?php
  }
	else{
?>
&nbsp
 <table id="table">
       <?php
      foreach($allrecords as $displayRecords) { ?>
      <thead>
      <th><?php print $displayRecords['subject']; ?></th>
      </thead>
      <tbody>
      <tbody>
      <tr><td><img src=<?php print $displayRecords['image']; ?> width="400" height="430"></td></tr>
        <tr><td>My Rating: <?php print $displayRecords['rate']; ?> / 10</td></tr>
        <tr><td id="tdm"><?php print $displayRecords['content']; ?></td></tr>
        <tr><td>Last Edit: <?php print $displayRecords['post_date']; ?></td></tr>
        <tr><td><form method="POST"><input type="submit" name="change" value="Change Poster"> <input type="submit" name="update" value="Update Entries"> <input type="submit" name="delete" value="Delete Post"></form></td></tr>
      <?php } ?>
      </tbody>
  </table>
<?php } ?>
<?php
if($allreplies==0){
  ?><p>No replies for this post yet</p><?php
}
  else{
?>
&nbsp
 <table id="table">
       <?php
      foreach($allreplies as $displayRecords) { ?>
        <tr><td>Reply by <?php print $displayRecords['username']; ?></td></tr>
        <tr><td id="tdm"><?php print $displayRecords['rsubject']; ?></td></tr>
        <tr><td>Last Edit: <?php print $displayRecords['reply_date']; ?></td></tr>
        <tr><td><form method="POST"><input type="hidden" name="replyid" value="<?php print $displayRecords['replyid'];?>"><input type="submit" name="deletereply" value="Delete Reply"></form></td></tr>
      <?php } ?>
  </table>

<?php

if (isset($_POST['deletereply'])) {
  $replyid = $_POST['replyid'];
  $delete = deleteThisReply($replyid);
    header("Location:moviepage.php?subject=$subject&username=$username&postid=$postid");
  }

 } ?>




&nbsp
<form method='POST'>
 <table id="table">
        <tr><td><textarea id="td" name="rsubject" cols="40" rows="5" maxlength="400" required></textarea></td></tr>
                <tr><td><input type="submit" name="reply" value="Reply"></td></tr>
  </table>
  </form>






















<?php
 if (isset($_POST['delete'])) {
  if($allrecords==0){

}
  else
  {
  foreach($allrecords as $displayRecords) {
      $delete = deleteThisPost($displayRecords['postid']);
      header("Location:userpage.php?username=$username");}
  }
      }
    elseif (isset($_POST['update'])) {
              if($allrecords==0){

}
  else
  {
  foreach($allrecords as $displayRecords) {
      header("Location:movieupdate.php?username=$username&postid=$postid");}
  }

    }
        elseif (isset($_POST['change'])) {
              if($allrecords==0){

}
  else
  {
  foreach($allrecords as $displayRecords) {
      header("Location:changeposter.php?subject=$subject&username=$username&postid=$postid");}
  }

    }
          elseif (isset($_POST['reply'])) {
            $rsubject = $_POST['rsubject'];
    $create = createNewReply($username, $postid, $rsubject);
    header("Location:moviepage.php?subject=$subject&username=$username&postid=$postid");

    }

?>
</body>
<footer><p>&copy Nader Almohammadi <?php echo date("Y"); ?></p></footer>
</html>