<?php
include_once 'povezava.php';
include_once 'header.php';

if($_SESSION['admin']==1){
if(isset($_GET['id'])){
$id = $_GET['id'];
$query = mysqli_query($link, "delete from uporabniki where id=$id");

echo '<div class="errorM">Uspešno izbrisano!</div>';
header( "Refresh:3; url=baza.php", true, 303);
}
}else{
    echo '<div class="errorM">Nisi administrator!</div>';
    header( "Refresh:3; url=index.php", true, 303);
}
include_once 'footer.php';