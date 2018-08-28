<?php
include_once 'povezava.php';
include_once 'header.php';
?>
<div class="all">
<form action="dodaj_al_i.php" method="POST">
    <label id="avtor">Avtor/Izvajalec:<a href="dodaj_a.php" class="ap"><br>Ni avtorja? Dodaj!</a></label><br>
    <?php
        echo '<select name="avtor" required>';
        $query=  mysqli_query($link, "select id, ime from izvajalci");
        echo '<option value="">Izberi</option>';
        while ($row = mysqli_fetch_array($query)) {
            $id = $row['id'];
            $fn = $row['ime'];
            echo "<option value='$id' required>$fn</option>";
        }
        echo '</select><br>'; 
        ?>
    <label id="avtor">Album:</label><br>
    <input type="text" name="album" required/><br>
    <input type="submit" value="upload" class="button"/><br>
</form>
</div>