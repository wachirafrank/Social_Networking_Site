<?php
// start a session before any html is sent
session_start();
echo  "<!DOCTYPE html> \n <html> <head> <script src='OSC.js'> </script>";
include 'functions.php';
$userstr = '(Guest)';
if(isset($_SESSION['user'])){
  // read session var $user
  $user  = $_SESSION['user'];
  $loggedin = true;
  $userstr = "($user)";
}
else { //we aren't logged in yet
  $loggedin = false;
  // var_dump($loggedin);
}

echo "<title> $appname$userstr</title> <link rel='stylesheet'".
"href='styles.css' type='text/css' />" .
"</head> </body> <div class='appname'>$appname$userstr</div>";
// var_dump($appname, $userstr);
// show this menu items if we are logged in.
if($loggedin){
  echo "<br> <ul class='menu'>" .
  "<li> <a href='members.php?view=$user'>Home</a></li>".
  "<li> <a href='members.php'>Members</a></li>".
  "<li> <a href='friends.php'>Friends</a></li>".
  "<li> <a href='messages.php?'>Messages</a></li>".
  "<li> <a href='profile.php'>Edit Profile</a></li>".
  "<li> <a href='logout.php'>Logout</a></li></ul><br />";
}
else { //show this links if we aren't logged in
  echo ("<br /> <ul class='menu'>".
  "<li> <a href='index.php'> Home </a></li>" .
  "<li> <a href='signup.php'>Signup </a></li>" .
  "<li> <a href='login.php'> Logon </a></li></ul><br />" .
  "<span class='info'>&#8658; You must be logged in to view this page </span><br /> <br />");
}
