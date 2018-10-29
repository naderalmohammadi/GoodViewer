<?php 



function createNewUser($name, $age, $gender, $email, $pass)
{
  global $mysqli;
  $stmt = $mysqli->prepare(
    "INSERT INTO user (
		Username,
		Age,
		Gender,
		Email,
		Password
		)
		VALUES (
		?,
		?,
		?,
		?,
		?
		)"
  );
  $stmt->bind_param("sssss", $name, $age, $gender, $email, $pass);
  $result = $stmt->execute();
  $stmt->close();
  return $result;

}

function updateThisUser($username, $age, $gender, $password){

	    global $mysqli;
    $stmt = $mysqli->prepare(
      "UPDATE user
    SET
    Age = ?,
    Gender = ?,
    Password = ?
    WHERE
    Username = ?
    LIMIT 1"
    );
    $stmt->bind_param("ssss",$age, $gender, $password, $username);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

function createNewPost($username, $subject, $content, $rate, $image)
{
  global $mysqli;
  $stmt = $mysqli->prepare(
    "INSERT INTO post (
		Username,
		Subject,
		Content,
		Rate,
		Image
		)
		VALUES (
		?,
		?,
		?,
		?,
		?
		)"
  );
  $stmt->bind_param("sssss", $username, $subject, $content, $rate, $image);
  $result = $stmt->execute();
  $stmt->close();
  return $result;

}



function createNewReply($username, $postid, $rsubject){

  global $mysqli;
  $stmt = $mysqli->prepare(
    "INSERT INTO reply (
    Username,
    PostID,
    Rsubject
    )
    VALUES (
    ?,
    ?,
    ?
    )"
  );
  $stmt->bind_param("sss", $username, $postid, $rsubject);
  $result = $stmt->execute();
  $stmt->close();
  return $result;

}



function fetchUser($username)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
      " SELECT *
    FROM user
    WHERE
    Username = ?
    LIMIT 1"
    );
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($username, $age, $gender, $email, $pass);
    $stmt->execute();
  while ($stmt->fetch()) {
    $row[] = array(
      'username'             => $username,
      'age'                  => $age,
      'gender'               => $gender,
      'email'                => $email,
      'password'             => $pass

    );
  }
  $stmt->close();
  if (empty($row)==false){
  	return $row;
  }
  else{
  return 0;
}
}

function fetchThisUser($username)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
      " SELECT *
    FROM user
    WHERE
    Username = ?
    LIMIT 1"
    );
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($username, $age, $gender, $email, $pass);
    $stmt->execute();
  while ($stmt->fetch()) {
    $row[] = array(
      'Username'             => $username,
      'Age'                  => $age,
      'Gender'               => $gender,
      'Email'                => $email,
      'Password'             => $pass

    );
  }
  $stmt->close();
  if (empty($row)==false){
  	return 1;
  }
  else{
  return 0;
}
}

function fetchThisEmail($email)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
      " SELECT *
    FROM user
    WHERE
    Email = ?
    LIMIT 1"
    );
    $stmt->bind_param("s", $email);
    $result = $stmt->execute();
    $stmt->execute();
    $stmt->bind_result($username, $age, $gender, $email, $pass);
    $stmt->execute();
  while ($stmt->fetch()) {
    $row[] = array(
      'Username'             => $username,
      'Age'                  => $age,
      'Gender'               => $gender,
      'Email'                => $email,
      'Password'             => $pass

    );
  }
  $stmt->close();
    if (empty($row)==false){
  	return 1;
  }
  else{
  return 0;
}
}

function fetchThisPost($username,$postid)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
      " SELECT *
    FROM post
    WHERE
    Username = ?
    AND
    PostID = ?
    LIMIT 1"
    );
    $stmt->bind_param("ss", $username, $postid);
    $stmt->execute();
    $stmt->bind_result($postid, $username, $subject, $content, $rate, $image, $post_date);
    $stmt->execute();
  while ($stmt->fetch()) {
    $row[] = array(
      'postid'           => $postid,
      'username'         => $username,
      'subject'          => $subject,
      'content'          => $content,
      'rate'             => $rate,
      'image'            => $image,
      'post_date'        => $post_date

    );
  }
  $stmt->close();
  if (empty($row)==false){
  	return $row;
  }
  else{
  return 0;}
}

function verifyThisUser($username,$pass)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
      " SELECT *
    FROM user
    WHERE
    Username = ?
    and
    Password = ?
    LIMIT 1"
    );
    $stmt->bind_param("ss", $username,$pass);
    $result = $stmt->execute();
    $stmt->execute();
    $stmt->bind_result($username, $age, $gender, $email, $pass);
    $stmt->execute();
  while ($stmt->fetch()) {
    $row[] = array(
      'Username'             => $username,
      'Age'                  => $age,
      'Gender'               => $gender,
      'Email'                => $email,
      'Password'             => $pass

    );
  }
  $stmt->close();
    if (empty($row)==false){
  	return 1;
  }
  else{
  return 0;
}
}


function deleteThisPost($postid) {
	      global $mysqli;
            $stmt = $mysqli->prepare(
      "DELETE FROM reply where PostID= ?"
    );
    $stmt->bind_param("s", $postid);
    $stmt->execute();
    $stmt->close();



    $stmt2 = $mysqli->prepare(
      "DELETE FROM post where PostID= ?"
    );
    $stmt2->bind_param("s", $postid);
    $result = $stmt2->execute();
    $stmt2->close();
    return $result;
}

function deleteThisReply($replyid) {
        global $mysqli;
    $stmt = $mysqli->prepare(
      "DELETE FROM reply where ReplyID = ? "
    );
    $stmt->bind_param("s", $replyid);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


function fetchAllPosts($username) {
  global $mysqli;
  $stmt = $mysqli->prepare(
    "SELECT
    	Image,
		PostID,
		Subject,
		Rate
		FROM Post
		WHERE Username =? 
    ORDER BY Post_date
		"
  );
  $stmt->bind_param("s", $username);
  $result = $stmt->execute();
  $stmt->execute();
  $stmt->bind_result(
  	$image,
    $postid,
    $subject,
    $rate
  );
  while ($stmt->fetch()) {
    $row[] = array(
      'image'                => $image,
      'postid'                => $postid,
      'subject'               => $subject,
      'rate'                  => $rate
    );
  }
  $stmt->close();
  if(empty($row)){
  return 0;
  }
  else{
  return ($row);
}
}


function updateThisPost($username, $postid, $subject, $content, $rate){

	    global $mysqli;
    $stmt = $mysqli->prepare(
      "UPDATE post
		SET
		Subject = ?,
		Content = ?,
		Rate = ?,
		post_date = CURRENT_TIMESTAMP
		WHERE
		Username = ?
		AND
		PostID = ?
		LIMIT 1"
    );
    $stmt->bind_param("sssss", $subject, $content, $rate, $username, $postid);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


function updateThisPoster($username, $postid, $image){

	    global $mysqli;
    $stmt = $mysqli->prepare(
      "UPDATE post
		SET
		Image = ?,
		post_date = CURRENT_TIMESTAMP
		WHERE
		Username = ?
		AND
		PostID = ?
		LIMIT 1"
    );
    $stmt->bind_param("sss", $image, $username, $postid);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


function fetchThisReply($postid){
  global $mysqli;
  $stmt = $mysqli->prepare(
    "SELECT
    ReplyID,
    Username,
    PostID,
    Rsubject,
    Reply_date
    FROM Reply
    WHERE PostID =?
    ORDER BY Reply_date
    "
  );
  $stmt->bind_param("s", $postid);
  $result = $stmt->execute();
  $stmt->execute();
  $stmt->bind_result(
    $replyid,
    $username,
    $postid,
    $rsubject,
    $reply_date
  );
  while ($stmt->fetch()) {
    $row[] = array(
      'replyid'                => $replyid,
      'username'                => $username,
      'postid'                => $postid,
      'rsubject'               => $rsubject,
      'reply_date'               => $reply_date
    );
  }
  $stmt->close();
  if(empty($row)){
  return 0;
  }
  else{
  return ($row);
}
}


function searchAllPosts($username){

  global $mysqli;
  $stmt = $mysqli->prepare(
    "SELECT
    Image,
    Username,
    PostID,
    Subject,
    Rate
    FROM post
    WHERE Username != ? 
    ORDER BY Post_date
    "
  );
  $stmt->bind_param("s", $username);
  $result = $stmt->execute();
  $stmt->execute();
  $stmt->bind_result(
    $image,
    $username,
    $postid,
    $subject,
    $rate
  );
  while ($stmt->fetch()) {
    $row[] = array(
      'image'                => $image,
      'username'                => $username,
      'postid'                => $postid,
      'subject'               => $subject,
      'rate'                  => $rate
    );
  }
  $stmt->close();
  if(empty($row)){
  return 0;
  }
  else{
  return ($row);
} 
}







?>