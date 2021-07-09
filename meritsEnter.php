<fieldset>
    <p><b>Start typing a name in the input field below:</b></p>
    <form>
        You can search by First name: <input type="text" onkeyup="search(this.value,'merit','FirstName')" size="20" />
        <br />OR You can see students in Grade:
        <select onchange="search(this.value,'merit','Grade')" />
        <option>select</option>
        <?php for ($i = -2; $i <= 12; $i++) {
            echo "<option value=$i>$i";
        }
        ?>
        </select>
    </form>
</fieldset>
<div id="searchResult"></div>