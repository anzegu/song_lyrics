<?php include_once 'povezava.php';
      include_once 'header.php';
      echo '<div id="in">';
if(isset($_SESSION['user_id'])){
    $result = mysqli_query($link, "select i.ime, su.id, naslov, a.ime as aime, s.id as sid from skladbe_uporabniki su inner join skladbe s on s.id=su.skladba_id inner join albumi a on a.id=s.album_id inner join izvajalci i on i.id=s.izvajalec_id where (uporabnik_id=".$_SESSION['user_id'].")");
    $row = mysqli_num_rows($result);
        if($row!=0){
            while($rows = mysqli_fetch_assoc($result)){
                $id=$rows['id'];
                $sid=$rows['sid'];
                echo "<a href='besedila.php?suid=$id&sid=$sid'>".$naslov = $rows['naslov']."</a><br>";
                echo $izvajalec = $rows['ime'].'<br>';
                echo $album = $rows['aime'].'<br><br>';                
            } 
        }
    
}else{
    echo '<div class="errorM">Nisi prijavljen!</div>';
    header( "Refresh:3; url=prijava.php", true, 303);
}
   echo '</div>';   