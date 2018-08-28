<?php
include_once 'povezava.php';
include_once 'header.php';

if($_SESSION['admin']==1){
if(isset($_GET['sid'])){
$id = $_GET['sid'];
if(isset($_SESSION['admin'])){      
if($_SESSION['admin']==1){
    $result = mysqli_query($link, "update skladbe set checked=1 where id=$id");
    echo '<div class="errorM">Besedilo preverjeno!</div>';
            header( "Refresh:3; url=check.php", true, 303);
}else{
    echo '<div class="errorM">Napaka pri preverjanju!</div>';
            header( "Refresh:3; url=check.php", true, 303);
         
    }
}
}
}else{
    echo '<div class="errorM">Nisi administrator!</div>';
    header( "Refresh:3; url=index.php", true, 303);
}
echo '<div id="in">';