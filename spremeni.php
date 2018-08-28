<?php
include_once 'povezava.php';
include_once 'header.php';

if(isset($_SESSION['user_id'])){
?>
<div id="pri">

    <h1 id="pn">SPREMEMBA IMENA IN GELSA</h1>
<form action="spremeni_i.php" method="POST">
    <label id="u_ime">Uporabniško ime:</label><br>
    <input type="text" name="u_ime" required="required" pattern="[A-Za-z0-9]{4,}"/><br>
    <label id="pass">Geslo:</label><br>
    <input type="password" name="pass" required="required" pattern=".{4,}"/><br>
    <label id="pass2">Ponovno vnesite geslo:</label><br>
    <input type="password" name="pass2" required="required" pattern=".{4,}" /><br>
<input type="submit" value="Posodbi" class="button"/><br>
<input type="reset" value="Prekliči" class="button"/><br>
</form>


</div>
<?php }else{
    echo '<div class="errorM">Nisi prijavljen!</div>';
    header( "Refresh:3; url=prijava.php", true, 303);
}
 include_once 'footer.php';