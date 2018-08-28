<?php
include_once 'povezava.php';
include_once 'header.php';
if(isset($_SESSION['user_id'])){
    echo '<div class="errorM">Si že prijavljen!</div>';
    header( "Refresh:3; url=index.php", true, 303);
}else{
?>
<div class="all">
    <h1 id="pn">REGISTRACIJA</h1>
<form action="registracija_izvedba.php" method="POST">
    <label id="u_ime">Uporabniško ime:</label><br>
    <input type="text" name="u_ime" required="required" pattern="[A-Za-z0-9]{4,}"/><br>
    <label id="email">E-pošta:</label><br>
    <input type="e_mail" name="e_mail" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"/><br>
    <label id="pass">Geslo:</label><br>
    <input type="password" name="pass" required="required" pattern=".{4,}"/><br>
    <label id="pass2">Ponovno vnesite geslo:</label><br>
    <input type="password" name="pass2" required="required" pattern=".{4,}" /><br>
    <input type="submit" value="Registriraj" class="button"/><br>
</form>

</div>

<?php }
include_once 'footer.php';