<?php 
include_once 'povezava.php';
include_once 'header.php';

if($_SESSION['admin']==1){
$id = $_GET['suid'];
$sid = $_GET['sid'];

if(isset($_GET['suid'])&&isset($_GET['sid'])){

$result = mysqli_query($link, "delete from skladbe where id=$sid") or die('<div class="errorM">Napaka pri brisanju2!</div>');


$result2 = mysqli_query($link, "delete from skladbe_uporabniki where id=$id") or die('<div class="errorM">Napaka pri brisanju2!</div>');

echo '<div class="errorM">Uspešno izbrisano!</div>';
            header( "Refresh:3; url=index.php", true, 303);
}
}else{
    echo '<div class="errorM">Nisi administrator!</div>';
    header( "Refresh:3; url=index.php", true, 303);
}
include_once 'footer.php';