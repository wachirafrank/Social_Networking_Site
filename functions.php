<?php
$dbhost = 'localhost';
$dbname = 'anexistingdb';
$dbuser = 'robinsnest';
$dbpass = 'apassword';
$appname = "Robins Nest";
// mysqli_connect( [$host, $user, $password, $database, $port, $socket]);

$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die(mysqli_error($link));
mysqli_select_db($link, $dbname) or die(mysqli_error($link));

function createTable($name, $query){
  queryMysql($link,"CREATE TABLE IF NOT EXISTS $name($query)");
  echo  "Table '$name' created or already exists . <br />";
}

function queryMysql($link,$query){
  // mysqli_query() returns a boolean value true or false; true if query succeed.
  $result = mysqli_query($link,$query) or die(mysqli_error($link));
  return $result;
}
function destroySession(){
  $_SESSION = array();
  if(session_id() != ""  or isset($_COOKIE[ssesion_name()]) ){
    setcookie(session_name(), '' , time() - 2592000, '/');
  }
  session_destroy();
}

function showProfile($link,$user){
  if(file_exists("$user.jpg")){
    echo  "<img src ='$user.jpg' align='left'  />";
    $result = queryMysql($link,"SELECT * FROM profiles WHERE user='$user'");
    if(mysqli_num_rows($result)){
      $row = mysqli_fetch_row($result);
      echo stripslashes($row[1]) . "<br clear=left /> <br />";
    }
  }
}

function sanitizeString($link, $var){
  $var = strip_tags($var);
  $var = htmlentities($var);
  $var = stripslashes($var);
  $var = mysqli_real_escape_string($link, $var); //escapes a string making it MYSQL safe
  return $var;
}
