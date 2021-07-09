<fieldset>
    See the Weekletters per grade:
    <br \>
    <?php for ($i = 6; $i <= 12; $i++) {
        echo "<button onclick=\"search(this.value,'weeklyPrint','Grade')\" value=$i>$i</button>";
    }
    ?>
</fieldset>
<div id="searchResult"></div>