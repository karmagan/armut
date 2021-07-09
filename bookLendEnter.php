<?php include('connect.php'); ?>



<form action="bookLendInsert.php" method="post" onSubmit="popupform(this, 'join')">
    <table>
        <tr>
            <td>For Lending a Book Search by Book name:</td>
            <td> <input type="text" onkeyup="search(this.value,'book','Title')" size="20" \></td>
        </tr>
        <tr>
            <td colspan='2'>
                <div id="searchResult"></div>
            </td>
        </tr>
        <tr>
            <td>Student Name </td>
            <td><input type="text" onkeyup="search(this.value,'stu','Firstname','searchResult2')" size="20" \></td>
        </tr>
        <tr>
            <td colspan='2'>
                <div id="searchResult2"></div>
            </td>
        </tr>
    </table>

    <center>

        <?php include('date.php'); ?>
        <br><input type="submit" value="Submit" />
    </center><br>
</form>