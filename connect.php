<?php
session_start();
$user = $_SESSION['user'];
$passwd = $_SESSION['passwd'];
$link = mysql_connect('', '', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('', $link);

$sql = "SELECT *  FROM Staff WHERE Username = '$user' AND Password='$passwd' ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$count = mysql_num_rows($result);

if ($count == 1) {

    $teacher = $row['TeacherNo'];
    $myemail = $row['email'];
    $mycell = $row['Cell'];
} else {

    echo "<div style='text-align: center; font-size:200%;'> You have entered a<br>wrong password<br>Go Back<br>to <strong><a href='index.php'>LOGIN</a></strong> screen</div>";

    exit;
}
