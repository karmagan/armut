Date
<select name="dateyear" size="0">
    <?php echo '<option value=' . date("Y") . '>' . date("Y") . '</option>'; ?>
    <option value="2011">2011</option>
    <option value="2012">2012</option>
</select>


<select name="datemonth" size="0">
    <?php echo '<option value=' . date("m") . '>' . date("F") . '</option>'; ?>
    <option value="1">January</option>
    <option value="2">February</option>
    <option value="3">March</option>
    <option value="4">April</option>
    <option value="5">May</option>
    <option value="6">June</option>
    <option value="7">July</option>
    <option value="8">August</option>
    <option value="9">September</option>
    <option value="10">October</option>
    <option value="11">November</option>
    <option value="12">December</option>
</select>

<select name="dateday" size="0">
    <?php echo '<option value=' . date("d") . '>' . date("d") . '</option>';
    for ($i = 1; $i < 32; $i++) {
        printf('<option value="%s">%s</option>', $i, $i);
    }   ?>

</select>