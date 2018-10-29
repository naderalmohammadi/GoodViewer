<?php
if(empty($_GET['postid'])){
  header("Location:index.php");
}
$username = $_GET['username'];
$postid = $_GET['postid'];
$subject = $_GET['subject'];
require_once("config.php");
$allrecords = fetchThisPost($username,$postid);
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Update This Show</title></head>
<body>
<header>
    <table id="table2">
    <tr><td><a href="userpage.php?username=<?php print $username ?>">Good Viewer</a> / Update This Show</td><td id="tdr"> Because good reviews are valuable</td><tr>
    </table>
</header>
&nbsp
<form method="post">
<table id="table">
 <?php foreach ($allrecords as $details) { ?>
    <tr><td><input id="td" type="text" name="name" value="<?php print $details['subject']; ?>" maxlength="20" placeholder="Title.." required></td></tr>
    <tr><td><textarea id="td" name="content" cols="40" rows="5" maxlength="400" placeholder="Review.." required><?php print $details['content']; ?></textarea></td></tr>
    <tr><td><input id="td" type="number" name="rate" min ='0' max='10' step='0.1' value="<?php print $details['rate']; ?>" placeholder="Rating (0-10).." required></td></tr>
    <tr><td><input type="submit" value="Update" name="submit"></td></tr>
    <?php } ?>
    </table>
</form>


<?php
if (isset($_POST['submit'])) {
        ?><p>Done</p><?php
                $user_name = $username;
                $post_id = $postid;
                $subject = $_POST['name'];
                $content = $_POST['content'];
                $rate = $_POST['rate'];
                $newpost = updateThisPost($user_name, $post_id, $subject, $content, $rate);
                header("Location:moviepage.php?subject=$subject&username=$username&postid=$postid");
    }
?>
</body>
<footer><p>&copy Nader Almohammadi <?php echo date("Y"); ?></p></footer>
</html>