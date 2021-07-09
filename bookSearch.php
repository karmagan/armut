<?php
include('connect.php');
$search = $_GET["search"];
$searchField = $_GET["searchField"];
$sql  = "SELECT *  FROM `Books` where  `$searchField` LIKE '$search%' ";
$result = mysql_query($sql);
?>
<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLS FRAME=BOX>
	<tr>
		<th>Select</th>
		<th>Book No</th>
		<th>Title</th>
	</tr>
	<?php

	while ($row = mysql_fetch_array($result)) {
		printf("<tr><td><input type='radio' name=bookid value= %s /></td><td>%s</td> <td> %s </td></tr> ", $row['BookID'], $row['BookID'], $row['Title']);
	}
	?>
</table>