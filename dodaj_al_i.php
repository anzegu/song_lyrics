<?php
include_once 'povezava.php';
include_once 'header.php';

function validate($val){
    return !preg_match('/[^A-Za-z0-9]/', $val);
}
function validateLen($vali){
    if(strlen($vali) >= 1){
        return true;
    }else{
        return false;
    }
}

$avtor = filter_input(INPUT_POST, 'avtor');
$album = filter_input(INPUT_POST, 'album');
if(!validateLen($album)){
    echo '<div class="errorM">Vnos je neveljaven!</div>';
        header( "Refresh:3; url=dodaj_al.php", true, 303);
}
else{    
    $result = mysqli_query($link, 'select id from albumi where ime="'.$album.'"');
    if(mysqli_num_rows($result) == 0){
        mysqli_query($link, 'insert into albumi(ime) values("'.$album.'");'); 
        echo '<div class="errorM">Album uspešno vpisan!</div>';
            header( "Refresh:3; url=dodaj.php", true, 303);
    }else{
        echo '<div class="errorM">Album je že vpisan!</div>';
            header( "Refresh:3; url=dodaj_al.php", true, 303);
    }
}
