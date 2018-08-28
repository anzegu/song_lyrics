<?php include_once 'povezava.php';session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Lyrics</title>
    </head>
    <body>
        <ul id="abc">
            <li><a href="abcs.php?id=a">A</a></li>
            <li><a href="abcs.php?id=b">B</a></li>
            <li><a href="abcs.php?id=c">C</a></li>
            <li><a href="abcs.php?id=d">D</a></li>
            <li><a href="abcs.php?id=e">E</a></li>
            <li><a href="abcs.php?id=f">F</a></li>
            <li><a href="abcs.php?id=g">G</a></li>
            <li><a href="abcs.php?id=h">H</a></li>
            <li><a href="abcs.php?id=i">I</a></li>
            <li><a href="abcs.php?id=j">J</a></li>
            <li><a href="abcs.php?id=k">K</a></li>
            <li><a href="abcs.php?id=l">L</a></li>
            <li><a href="abcs.php?id=m">M</a></li>
            <li><a href="abcs.php?id=n">N</a></li>
            <li><a href="abcs.php?id=o">O</a></li>
            <li><a href="abcs.php?id=p">P</a></li>
            <li><a href="abcs.php?id=q">Q</a></li>
            <li><a href="abcs.php?id=r">R</a></li>
            <li><a href="abcs.php?id=s">S</a></li>           
            <li><a href="abcs.php?id=t">T</a></li>
            <li><a href="abcs.php?id=u">U</a></li>
            <li><a href="abcs.php?id=v">V</a></li>
            <li><a href="abcs.php?id=w">W</a></li>
            <li><a href="abcs.php?id=x">X</a></li>
            <li><a href="abcs.php?id=y">Y</a></li>
            <li><a href="abcs.php?id=z">Z</a></li>
            <li style="margin-left: 23%;"><form method="post" action="abcs.php"><input type="text" name="search" style="margin-top:5px; padding: 5px; border: 3px solid white;" required/><input type="submit" value="Išči" class="button" style="width: 50px; margin-left: 2px; border-radius: 1px; height: 22px; padding: 0px;"/></form></li>
        </ul>
        <ul id="menu">                        
            <li><a href="index.php" class="active">Domov</a></li>              
            
            <?php if(isset($_SESSION['user_id'])){            
              echo  '<li><a href="odjava.php">Odjava</a></li>'                
                .'<a href="spremeni.php" style="float: right; margin:12px 8px 0 0;"><img src="slike/options20x20.png"></a>'     
                .'<li style="float: right; font-weight: 900; margin:11.5px 11.5px 0 11.5px;">'.$_SESSION['u_ime'].'</li>'   
                    .'<li style="float: right;"><a href="dodaj.php" class="active">Dodaj</a></li>'
                   .'<li style="float: right;"><a href="dodano.php">Dodano</a></li>';}
                  else {
                echo '<li><a href="registracija.php">Registracija</a></li>'
                    .'<li><a href="prijava.php">Prijava</a></li>';}  
                    
                   if(isset($_SESSION['admin'])){ 
                       $querry = "select * from skladbe where checked=0";
                       $result = mysqli_query($link, $querry);
                       $row = mysqli_num_rows($result);
                       echo  '<li><a href="baza.php">Baza</a></li>';
                       echo  '<li><a href="check.php">Preveri <b style="color: black;">'.$row.'</b></a></li>';
                   }
                    
            ?>
        </ul> 
