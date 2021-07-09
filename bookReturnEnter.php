<?php include('connect.php'); ?>

<fieldset>
    For Book Returning Search by First name: <input type="text" onkeyup="search(this.value,'bookReturn','FirstName')" size="20" />
</fieldset>
<br>
<div id="searchResult"></div>