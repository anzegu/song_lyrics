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
if(!validateLen($avtor)){
    echo '<div class="errorM">Vnos je neveljaven!</div>';
        header( "Refresh:3; url=dodaj_a.php", true, 303);
}
else{    
    $result = mysqli_query($link, "select * from izvajalci where ime='$avtor'");
    if(mysqli_num_rows($result) == 0){
        $t = mysqli_query($link, "insert into izvajalci(ime)values('$avtor')");
        echo '<div class="errorM">Avtor/Izvajalec uspešno vpisan!</div>'.$t;
            header( "Refresh:3; url=dodaj.php", true, 303);
    }else{
        echo '<div class="errorM">Avtor/izvajalec je že vpisan!</div>';
            header( "Refresh:3; url=dodaj_a.php", true, 303);
    }
}
