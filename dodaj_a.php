<?php
include_once 'povezava.php';
include_once 'header.php';
?>
<div class="all">
<form action="dodaj_a_i.php" method="POST">
    <label id="avtor">Avtor/Izvajalec:</label><br>
    <input type="text" name="avtor" required/><br>
    <input type="submit" value="upload" class="button"/><br>
</form>
</div>