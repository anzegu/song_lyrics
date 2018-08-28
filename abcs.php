<?php 
include_once 'povezava.php';
include_once 'header.php';



echo '<div id="in">';
if(isset($_GET['id'])){
    $id = $_GET['id'];
$result = mysqli_query($link, 'select i.ime, su.id as id, naslov, a.ime as aime, s.id as sid from skladbe_uporabniki su inner join skladbe s on s.id=su.skladba_id inner join albumi a on a.id=s.album_id inner join izvajalci i on i.id=s.izvajalec_id where (upper(naslov) like "'.$id.'%") and checked=1 order by naslov');
if(mysqli_num_rows($result)==0){
     echo '<div class="errorM">Ni rezultatov</div>';
            header( "Refresh:10; url=index.php", true, 303);
}else{
    $row = mysqli_num_rows($result);
        if($row!=0){
            while($rows = mysqli_fetch_assoc($result)){
                $id=$rows['id'];
                $sid=$rows['sid'];
                echo "<a href='besedila.php?suid=$id&sid=$sid'>".$naslov = $rows['naslov']."</a>&nbsp;";
                        if(isset($_SESSION['admin'])) {  echo '<a href="izbris.php?suid='.$id.'&sid='.$sid.'" onclick="return confirm(\'Prepričani?\')">X<br>';       }      
            } 
        }    
    }
}
if(isset($_POST['search'])){
$ids = $_POST['search'];    
    $result = mysqli_query($link, 'select i.ime, su.id as id, naslov, a.ime as aime, s.id as sid from skladbe_uporabniki su inner join skladbe s on s.id=su.skladba_id inner join albumi a on a.id=s.album_id inner join izvajalci i on i.id=s.izvajalec_id where (upper(naslov) like "%'.$ids.'%") and checked=1 order by naslov');
if(mysqli_num_rows($result)==0){
     echo '<div class="errorM">Ni rezultatov</div>';
            header( "Refresh:10; url=index.php", true, 303);
}else{
    $row = mysqli_num_rows($result);
        if($row!=0){
            while($rows = mysqli_fetch_assoc($result)){
                $id=$rows['id'];
                $sid=$rows['sid'];
                echo "<a href='besedila.php?suid=$id&sid=$sid'>".$naslov = $rows['naslov']."</a>&nbsp;";
                        if(isset($_SESSION['admin'])) {echo "<a href='izbris.php?suid=$id&sid=$sid'>X<br>";        }      
            } 
        }    
    }
}
echo '</div>';