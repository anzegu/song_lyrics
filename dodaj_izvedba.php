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
    
$album = filter_input(INPUT_POST, 'album');
$ime = filter_input(INPUT_POST, 'ime');
$zanr = filter_input(INPUT_POST, 'zanr');
$avtor = filter_input(INPUT_POST, 'avtor');

/*if(!validateLen($album)){
    echo '<div class="errorM">Vnos za album je neveljaven!</div>';
            header( "Refresh:3; url=dodaj.php", true, 303);
}
else if(!validateLen($zanr)){
    echo '<div class="errorM">Vnos za zanr je neveljaven!</div>';
            header( "Refresh:3; url=dodaj.php", true, 303);
}
else if(!validateLen($avtor)){
    echo '<div class="errorM">Vnos za avtorja/izvajalca je neveljaven!</div>';
            header( "Refresh:3; url=dodaj.php", true, 303);
}*/
if(!validateLen($ime)){
    echo '<div class="errorM">Vnos za naslov pesmi je neveljaven!</div>';
            header( "Refresh:3; url=dodaj.php", true, 303);
}
else{
    $result = mysqli_query($link, 'select * from skladbe where (naslov="'.$ime.'")and(zanr_id='.$zanr.')and(album_id='.$album.')');
    if(mysqli_num_rows($result) != 0){
        echo '<div class="errorM">Besedilo za to pesem je že dodano! Če ste zasledili napako v že dodanem besedilu, kontaktirajte administratorja.</div>';
            header( "Refresh:10; url=dodaj.php", true, 303);
    }else{    
    $target_dir = "besedila/";
    $target_file = $target_dir.$avtor."-".$album."-".basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 10000) {
        echo '<div class="errorM">Datoteka je prevelika!</div>';        
       header( "Refresh:3; url=dodaj.php", true, 303);
       die();
    }
    // Allow certain file formats
    if($imageFileType != "txt") {
        echo '<div class="errorM">Datoteka ni tipa txt!</div>';
            header( "Refresh:3; url=dodaj.php", true, 303);
            die();
    }
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<div class='errorM'>Datoteka ". basename( $_FILES["fileToUpload"]["name"]). " je bila uspešno dodana!</div>";
            $result = mysqli_query($link, 'insert into skladbe(zanr_id, album_id, izvajalec_id, naslov) values('.$zanr.', '.$album.', '.$avtor.',"'.$ime.'")');
            $skladba_id = mysqli_insert_id($link);            
            $result3 = mysqli_query($link, "insert into skladbe_uporabniki(uporabnik_id, skladba_id, url) values(".$_SESSION['user_id'].", $skladba_id, '$target_file')");
            header( "Refresh:3; url=dodano.php", true, 303);
        } else {
            echo '<div class="errorM">Napaka pri nalaganju!</div>';
            header( "Refresh:3; url=dodaj.php", true, 303);
        }
    }
}
