<?php
<?php // checkuser.php
include_once 'functions.php';
if (isset($_POST['user']))
{
$user = sanitizeString($link,$_POST['user']);
if (mysqli_num_rows(queryMysql($link,"SELECT * FROM members
WHERE user='$user'")))
echo "<span class='taken'>&nbsp;&#x2718; " .
"Sorry, this username is taken</span>";
else echo "<span class='available'>&nbsp;&#x2714; ".
"This username is available</span>";
}
 ?>
