<?php
    //aktivacije seje
    session_start();
    
    include_once 'povezava.php';
    //sprejmemo podatke od login.php
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    //posolimo password
    $pass = $salt.$pass;
    //zakodiramo password
    $pass = sha1($pass);
    
    $query = sprintf("SELECT * FROM uporabniki 
                      WHERE e_mail = '$email' AND
                      geslo = '$pass'",
             mysqli_real_escape_string($link, $email));
    //pošljem podatke v bazo
    $result = mysqli_query($link, $query);
    
    if (mysqli_num_rows($result) == 1) {
        //vse je ok
        $user = mysqli_fetch_array($result);
        //v sejo si shranim id uporabnika
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['u_ime'] = $user['u_ime'];
        $_SESSION['email'] = $user['e_mail'];
        if($user['admin']==1){
        $_SESSION['admin'] = $user['admin'];}
        
        //vse je ok, preusmeritev na index
        header("Location: index.php");
        die();
    }
    else {
        //napaka v podatkih, preusmeritev nazaj na login 
        echo $query;
        header("Refresh 3; url=prijava.php");
        die();
       
    }
?>