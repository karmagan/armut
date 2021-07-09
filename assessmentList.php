<fieldset>
    See the Assessments per grade:

    <br>
    <?php for ($i = -2; $i <= 12; $i++) {
        echo "<button onclick=\"search(this.value,'assessment','SubClass')\" value=$i>$i</button>";
    }
    ?>
</fieldset>
<div id="searchResult"></div>