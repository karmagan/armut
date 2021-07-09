<?php
session_start();
session_destroy();
?>

<head>
	<title>.: Login :.</title>
	<link rel="icon" href="icon.gif" type="image/gif" />
	<style type="text/css">
		fieldset {
			background: lightyellow;
			width: 300px;
		}
	</style>
</head>

<body>
	<div style="width:400px;margin: auto">
		<fieldset style="background:#6495ed;text-align:center">
			<fieldset>
				<table>
					<tr>
						<td>
							<img src="" alt="Logo">
						</td>
						<td>
							<div style="font-size: larger;text-align: center"><strong>School</strong></div>

							<div style="font-size: larger;text-align: center">Student Record Database</div>

							<div style="font-size: smaller;text-align: center">Teacher's Console</div>
						</td>
					</tr>
				</table>
			</fieldset>
			<br>Please enter your user name and password:
			<br><br>
			<fieldset>
				<form action="menu.php" method="post">
					<table>
						<tr>
							<td>USERNAME:</td>
							<td><input type="text" name="id" value="" style="width:150px" /></td>
							<td>LOGIN</td>
						</tr>
						<tr>
							<td>PASSWORD:</td>
							<td><input type="password" name="passwd" value="" style="width:150px"></td>
							<td>
								<input type="image" src="icons/dialog-ok-apply.png" />
							</td>
						</tr>
					</table>


				</form>
			</fieldset>
		</fieldset>
	</div>
</body>