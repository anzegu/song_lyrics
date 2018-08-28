<?php
include_once 'povezava.php';
include_once 'header.php';

require 'lightopenid/openid.php';
$_STEAMAPI = "CD92BF529064A6AC0E45EDF1A2777062";
try 
{
    $openid = new LightOpenID('http://localhost:8080/Lyrics/steamlogin.php/');
    if(!$openid->mode) 
    {
        if(isset($_GET['login'])) 
        {
            $openid->identity = 'http://steamcommunity.com/openid/?l=english';    // This is forcing english because it has a weird habit of selecting a random language otherwise
            header('Location: ' . $openid->authUrl());
        }
?>
<form action="?login" method="post">
    <input type="image" src="http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_small.png">
</form>
<?php
    } 
    elseif($openid->mode == 'cancel') 
    {
        echo 'User has canceled authentication!';
    } 
    else 
    {
        if($openid->validate()) 
        {
                $id = $openid->identity;
                // identity is something like: http://steamcommunity.com/openid/id/76561197960435530
                // we only care about the unique account ID at the end of the URL.
                $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
                preg_match($ptn, $id, $matches);
                echo "User is logged in (steamID: $matches[1])\n";

                $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$_STEAMAPI&steamids=$matches[1]";
                $json_object= file_get_contents($url);
                $json_decoded = json_decode($json_object);

                foreach ($json_decoded->response->players as $player)
                {
                    echo "
                    <br/>Player ID: $player->steamid
                    <br/>Player Name: $player->personaname
                    <br/>Profile URL: $player->profileurl
                    <br/>SmallAvatar: <img src='$player->avatar'/> 
                    <br/>MediumAvatar: <img src='$player->avatarmedium'/> 
                    <br/>LargeAvatar: <img src='$player->avatarfull'/> 
                    ";
                }
                $query = "select id from uporabniki where id=$player->steamid";
                echo $query;
                $result = mysqli_query($link, $query);
                $row = mysqli_num_rows($result);
                if($row<1){
                    $query = "insert into uporabniki(id, u_ime, geslo, e_mail)values($player->steamid, '$player->personaname', '', '')";
                    echo $query;
                    $result = mysqli_query($link, $query);
                }
                $_SESSION['user_id'] = $player->steamid;
                $_SESSION['u_ime'] = $player->personaname;	
                //header("Location: index.php");

        } 
        else 
        {
                echo "User is not logged in.\n";
        }
    }
} 
catch(ErrorException $e) 
{
    echo $e->getMessage();
}
?>