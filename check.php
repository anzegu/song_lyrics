<?php
include_once 'povezava.php';
include_once 'header.php';

if(isset($_SESSION['admin'])){      
if($_SESSION['admin']==1){
    $result = mysqli_query($link, "select i.ime, su.id as id, naslov, a.ime as aime, s.id as sid from skladbe_uporabniki su inner join skladbe s on s.id=su.skladba_id inner join albumi a on a.id=s.album_id inner join izvajalci i on i.id=s.izvajalec_id where checked=0 order by naslov");
echo '<div id="in">';
$row = mysqli_num_rows($result);
    if($row!=0){
        while($rows = mysqli_fetch_assoc($result)){
            $id=$rows['id'];
            $sid=$rows['sid'];
            echo "<a href='besedila.php?suid=$id&sid=$sid'>".$naslov = $rows['naslov']."</a>&nbsp;";
                    echo '<a href="check_p.php?suid='.$id.'&sid='.$sid.'" onclick="return confirm(\'Prepričani?\')">Preveri<br>';              
        } 
    }  
}
}else{
    echo '<div class="errorM">Nisi administrator!</div>';
    header( "Refresh:3; url=index.php", true, 303);
}
echo '</div>';