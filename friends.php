<?php
include_once 'header.php';
// exit if we are not logged in
if (!$loggedin) die();

if (isset($_GET['view'])) $view = sanitizeString($link,$_GET['view']);
else $view = $user;

if ($view == $user){

  $name1 = $name2 = "Your";
  $name3 = "You are";
    // var_dump($name1, $name2,$view, $name3);
} else {
  $name1 = "<a href='members.php?view=$view'>$view</a>'s";
  $name2 = "$view's";
  $name3 = "$view is";
  // var_dump($name1, $name2,$view, $name3);
}
echo "<div class='main'>";
// Uncomment this line if you wish the user's profile to show here
// showProfile($link,$view);
$followers = array(); //save all friends
$following = array(); //save all followers

// retrieve followers
$result = queryMysql($link,"SELECT * FROM friends WHERE user='$view'");
$num = mysqli_num_rows($result);
for ($j = 0 ; $j < $num ; ++$j){
  $row = mysqli_fetch_row($result);
  $followers[$j] = $row[1];
}
// var_dump($followers);

// retrieve following ..
$result = queryMysql($link,"SELECT * FROM friends WHERE friend='$view'");
$num = mysqli_num_rows($result);
for ($j = 0 ; $j < $num ; ++$j){
  $row = mysqli_fetch_row($result);
  $following[$j] = $row[0];
}

$mutual = array_intersect($followers, $following);
$followers = array_diff($followers, $mutual);
$following = array_diff($following, $mutual);
$friends = FALSE;

if (sizeof($mutual)){
  echo "<span class='subhead'>$name2 mutual friends</span><ul>";
  foreach($mutual as $friend)
  echo "<li><a href='members.php?view=$friend'>$friend</a>";
  echo "</ul>";
  $friends = TRUE;
}

if (sizeof($followers)){
  var_dump($name2);
  echo "<span class='subhead'>$name2 followers</span><ul>";
  foreach($followers as $friend)
  echo "<li><a href='members.php?view=$friend'>$friend</a>";
  echo "</ul>";
  $friends = TRUE;
}

if (sizeof($following)){
  var_dump($name3);
  echo "<span class='subhead'>$name3 following</span><ul>";
  foreach($following as $friend)
  echo "<li><a href='members.php?view=$friend'>$friend</a>";
  echo "</ul>";
  $friends = TRUE;
}

if (!$friends) echo "<br />You don't have any friends yet.<br /><br />";
echo "<a class='button' href='messages.php?view=$view'>" .
"View $name2 messages</a>";
 // var_dump($name2);

?>
</div><br /></body></html>
