<?php
    include_once 'povezava.php';
    include_once 'header.php';
    
    function validate($val){
        return !preg_match('/[^A-Za-z0-9]/', $val);
    }
    function validateLen($vali){
        if(strlen($vali) >= 4){
            return true;
        }else{
            return false;
        }
    }
    $query = "select * from uporabniki where u_ime='".filter_input(INPUT_POST, 'u_ime')."'";
        $result = mysqli_query($link, $query);
        $row = mysqli_num_rows($result);
        if($row!=0){
            echo '<div class="errorM">Uporabniško ime je zasedeno!</div>';
            header( "Refresh:3; url=registracija.php", true, 303);
        }
    $query = "select * from uporabniki where e_mail='".filter_input(INPUT_POST, 'e_mail')."'";
        $result = mysqli_query($link, $query);
        $row = mysqli_num_rows($result);
        if($row!=0){
            echo '<div class="errorM">E-Pošta je zasedena!</div>';
            header( "Refresh:3; url=registracija.php", true, 303);
        }    
    if(filter_input(INPUT_POST, 'pass') !== filter_input(INPUT_POST, 'pass2')){
        echo '<div class="errorM">Gesli se ne ujemata!</div>';
        sleep(3);
        header( "Refresh:3; url=registracija.php", true, 303);
    }
    else{    
        $filter_e = filter_input(INPUT_POST, 'e_mail');
        $filter_u = filter_input(INPUT_POST, 'u_ime');
        $filter_p = filter_input(INPUT_POST, 'pass');
        $valid = validate($filter_u);
        $validLen = validateLen($filter_u);
        $validLenPass = validateLen($filter_p);
        if(!filter_var($filter_e, FILTER_VALIDATE_EMAIL)){
            echo '<div class="errorM">E-pošta je neveljavna!</div>';
            header( "Refresh:3; url=registracija.php", true, 303);
        }
        else if(!$valid || !$validLen){
            echo '<div class="errorM">Uporabniško ime je neveljavno!</div>';
            header( "Refresh:3; url=registracija.php", true, 303);
        }
        else if(!$validLenPass){
            echo '<div class="errorM">Geslo je neveljavno!</div>';
            header( "Refresh:3; url=registracija.php", true, 303);
        }       
        else{          
            $filter_p = $salt.$filter_p;
            $filter_p = sha1($filter_p);

            $query = "INSERT INTO uporabniki(u_ime, e_mail, geslo) VALUES('$filter_u','$filter_e','$filter_p')";
            mysqli_query($link, $query) or die('<div class="errorM">Prišlo je do napake pri vnosu v bazo.</div>');
            echo '<div class="errorM">Registracija uspešna!</div>';
            header( "Refresh:3; url=prijava.php", true, 303);      
            }
    }
?>