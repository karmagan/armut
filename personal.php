<?php
include('connect.php');




$sql = "SELECT *  FROM Staff where teacherNo='$teacher' ";

$result = mysql_query($sql);
$row = mysql_fetch_array($result);

echo '<form action="personalUpdate.php" method="post" onSubmit="popupform(this, \'join\',\'meritsCorrection\')">';
echo '<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLS FRAME=BOX>';

printf('<tr><td>Name</td><td>%s</td></tr><tr><td>Surname</td><td>%s</td></tr><tr><td>ID No</td><td><input  size="30" type="text" name="id" value="%s" /></td></tr><tr><td>Password</td><td><input  size="30" type="password" name="password" value="%s" /></td></tr>', $row['Name'], $row['Surname'], $row['ID #'], $row['Password']);
printf('<tr><td>Address</td><td><input size="30" type="text" name="address" value="%s" /></td></tr><tr><td>e-Mail</td><td><input  size="30" type="text" name="email" value="%s" /></td></tr><tr><td>Cell Phone No</td><td><input type="text" size="30"  name="cellphone" value="%s" /></td></tr>', $row['Address'], $row['email'], $row['Cell']);

echo '<tr><td colspan="2" text-align="center"><input type="submit" value="Update Personal Information"></td></tr></table></form>';
