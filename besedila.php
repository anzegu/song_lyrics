<?php 
include_once 'povezava.php';
include_once 'header.php';

$id = $_GET['suid'];
$sid = $_GET['sid'];

echo '<div id="content">';

$result = mysqli_query($link, "select i.ime, su.id, naslov, a.ime as aime, s.id as sid, url from skladbe_uporabniki su inner join skladbe s on s.id=su.skladba_id inner join albumi a on a.id=s.album_id inner join izvajalci i on i.id=s.izvajalec_id where (su.id=$id)");

    $row = mysqli_num_rows($result);
        if($row!=0){
            while($rows = mysqli_fetch_assoc($result)){
                echo '<h2>"'.$naslov = $rows['naslov'].'"</h2>';
                echo '<h3>-'.$izvajalec = $rows['ime'].'-</h3>';
                echo '<h4>('.$album = $rows['aime'].')</h4>';                
            } 
        }
$result = mysqli_query($link, "select i.ime, su.id, naslov, a.ime as aime, s.id as sid, url from skladbe_uporabniki su inner join skladbe s on s.id=su.skladba_id inner join albumi a on a.id=s.album_id inner join izvajalci i on i.id=s.izvajalec_id where (su.id=$id)");

$besedilo = mysqli_fetch_array($result);

$file = fopen($besedilo['url'],"r");
while(! feof($file))
  {
  echo fgets($file). "<br />";
  }
fclose($file);
echo '</div>';