<?php 
include_once 'povezava.php';
include_once 'header.php';

echo '<div id="in">';

if(isset($_SESSION['admin'])==1){
    $result = mysqli_query($link, 'select * from uporabniki');
    echo '<h4>Uporabniki</h4><table border="1"><tr><td>id</td><td>u_ime</td><td>geslo<td>e_mail<td>admin';
    $row = mysqli_num_rows($result);
        if($row!=0){
            while($rows = mysqli_fetch_assoc($result)){
                $id=$rows['id'];
                echo '<tr><td><a href="izbris_u.php?id='.$id.'" onclick="return confirm(\'Prepričani?\')">'.$id.'</a>';
                echo '<td>'.$ime = $rows['u_ime'];
                echo '<td>'.$gelo = $rows['geslo'];
                echo '<td>'.$email = $rows['e_mail'];
                echo '<td>'.$admin = $rows['admin'];   
            } 
        }
        echo '</table><br>';
        
    $result = mysqli_query($link, 'select * from skladbe');
    echo '<h4>Skladbe</h4><table border="1"><tr><td>id</td><td>zanr_id</td><td>album_id<td>izvajalec_id<td>naslov<td>checked';
    $row = mysqli_num_rows($result);
        if($row!=0){
            while($rows = mysqli_fetch_assoc($result)){
                echo '<tr><td>'.$id=$rows['id'];
                echo '<td>'.$ime = $rows['zanr_id'];
                echo '<td>'.$gelo = $rows['album_id'];
                echo '<td>'.$email = $rows['izvajalec_id'];
                echo '<td>'.$admin = $rows['naslov'];   
                echo '<td>'.$admin = $rows['checked'];  
            } 
        }
        echo '</table><br>';
        
    $result = mysqli_query($link, 'select * from izvajalci');
    echo '<h4>Izvajalci</h4><table border="1"><tr><td>id</td><td>ime';
    $row = mysqli_num_rows($result);
        if($row!=0){
            while($rows = mysqli_fetch_assoc($result)){
                $id=$rows['id'];
                echo '<tr><td><a href="izbris_i.php?id='.$id.'" onclick="return confirm(\'Prepričani?\')">'.$id.'</a>';
                echo '<td>'.$ime = $rows['ime']; 
            } 
        }
        echo '</table>';
        
        echo '</table><br>';
        
    $result = mysqli_query($link, 'select * from albumi');
    echo '<h4>Albumi</h4><table border="1"><tr><td>id</td><td>ime';
    $row = mysqli_num_rows($result);
        if($row!=0){
            while($rows = mysqli_fetch_assoc($result)){
                $id=$rows['id'];
                echo '<tr><td><a href="izbris_a.php?id='.$id.'" onclick="return confirm(\'Prepričani?\')">'.$id.'</a>';
                echo '<td>'.$ime = $rows['ime']; 
            } 
        }
        echo '</table>';
        
        echo '</table><br>';
        
    $result = mysqli_query($link, 'select * from skladbe_uporabniki');
    echo '<h4>Uporabniki_skladbe</h4><table border="1"><tr><td>id</td><td>uporabnik_id<td>skladba_id<td>url';
    $row = mysqli_num_rows($result);
        if($row!=0){
            while($rows = mysqli_fetch_assoc($result)){
                echo '<tr><td>'.$id=$rows['id'];
                echo '<td>'.$ime = $rows['uporabnik_id']; 
                echo '<td>'.$ime = $rows['skladba_id']; 
                echo '<td>'.$ime = $rows['url']; 
            } 
        }
        echo '</table>';
  

} else{
    echo '<div class="errorM">Nisi administrator!</div>';
    header( "Refresh:3; url=index.php", true, 303);
}    
        echo '</div>';