<?php
include_once 'povezava.php';
include_once 'header.php';
?>
<div class="all">
    
<form action="dodaj_izvedba.php" method="POST" enctype="multipart/form-data" >
    <label id="avtor">Avtor/Izvajalec:</label><a href="dodaj_a.php" class="ap"><br>Ni avtorja/izvajalca? Dodaj!</a><br>
    <?php
        echo '<select name="avtor" required>';
        $query=  mysqli_query($link, "select id, ime from izvajalci order by ime");
        echo '<option value="">Izberi</option>';
        while ($row = mysqli_fetch_array($query)) {
            $id = $row['id'];
            $fn = $row['ime'];
            echo "<option value='$id' required>$fn</option>";
        }
        echo '</select><br>'; 
        ?>
    <label id="album">Album:</label><a href="dodaj_al.php" class="ap"><br>Ni albuma? Dodaj!</a><br>
        <?php
        echo '<select name="album" required>';
        $query=  mysqli_query($link, "select id, ime from albumi order by ime");
        echo '<option value="">Izberi</option>';
        while ($row = mysqli_fetch_array($query)) {
            $id = $row['id'];
            $fn = $row['ime'];
            echo "<option value='$id' required>$fn</option>";
        }
        echo '</select><br>'; 
        ?>
    <label id="zanr">Žanra:</label><br>
    <?php
        echo '<select name="zanr" required>';
        $query=  mysqli_query($link, "select id, ime from zanri");
        echo '<option value="">Izberi</option>';
        while ($row = mysqli_fetch_array($query)) {
            $id = $row['id'];
            $fn = $row['ime'];
            echo "<option value='$id' required>$fn</option>";
        }
        echo '</select><br>'; 
        ?>
    <label id="pass2">Ime:</label><br>
    <input type="text" name="ime" required="required"  /><br>
    <label id="Besedilo">Besedilo:</label><br>
    <input type="file" name="fileToUpload" required/> <br>
    <input type="submit" value="upload" class="button"/><br>
</form>

</div>

<?php include_once 'footer.php';