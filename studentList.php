<fieldset><b>Start typing a name in the input field below:</b>
    <form>
        Search by First name: <input type="text" onkeyup="search(this.value,'student','FirstName')" size="20" />

        Search by Grade: <input type="text" onkeyup="search(this.value,'student','Grade')" size="20" />

    </form>
</fieldset>
<div id="searchResult"></div>