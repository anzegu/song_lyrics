<?php 
include_once 'header.php';

if(isset($_SESSION['user_id'])){
    echo '<div class="errorM">Si že prijavljen!</div>';
    header( "Refresh:3; url=index.php", true, 303);
}else{
	# Autoload the required files
	require_once __DIR__ . '/vendor/autoload.php';

	# Set the default parameters
	$fb = new Facebook\Facebook([
	  'app_id' => '1325507990891833',
	  'app_secret' => 'cf1dbc1fbf2874b79084db0430b54811',
	  'default_graph_version' => 'v2.5',
	]);
	$redirect = 'http://localhost:8080/Lyrics/prijava.php';


	# Create the login helper object
	$helper = $fb->getRedirectLoginHelper();

	# Get the access token and catch the exceptions if any
	try {
	  $accessToken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  // When Graph returns an error
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  // When validation fails or other local issues
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}
        $permissions  = ['email'];
        $loginUrl = $helper->getLoginUrl($redirect,$permissions);
        if (isset($accessToken)) {
	  	// Logged in!
	 	// Now you can redirect to another page and use the
  		// access token from $_SESSION['facebook_access_token'] 
  		// But we shall we the same page

		// Sets the default fallback access token so 
		// we don't have to pass it to each request
		$fb->setDefaultAccessToken($accessToken);

		try {
		  $response = $fb->get('/me?fields=email,name');
		  $userNode = $response->getGraphUser();
		}catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
                $id = $userNode->getId();
                $ime = $userNode->getName();
                $email = $userNode->getProperty('email');
                $query = "select id from uporabniki where id=$id";
                $result = mysqli_query($link, $query);
                $row = mysqli_num_rows($result);
                if($row<1){
                    $query = "insert into uporabniki(id, u_ime, geslo, e_mail)values($id, '$ime', '', '$email')";
                    echo $query;
                    $result = mysqli_query($link, $query);
                }
        $_SESSION['user_id'] = $id;
        $_SESSION['u_ime'] = $ime;
        $_SESSION['email'] = $email;	
        header("Location: index.php");
	}
        
        //Steam
        
        require 'lightopenid/openid.php';
$_STEAMAPI = "CD92BF529064A6AC0E45EDF1A2777062";
try 
{
    $openid = new LightOpenID('http://localhost:8080/Lyrics/index.php/');
    if(!$openid->mode) 
    {
        if(isset($_GET['login'])) 
        {
            $openid->identity = 'http://steamcommunity.com/openid/?l=english';    // This is forcing english because it has a weird habit of selecting a random language otherwise
            header('Location: ' . $openid->authUrl());
        }
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
                header("Location: index.php");

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
<div id="pri">

    <h1 id="pn">PRIJAVA</h1>
<form action="prijava_pre.php" method="POST">
<label>E-Pošta:</label><br><input type="email" name="email" /><br>
<label>Geslo:</label><br><input type="password" name="pass" /><br>
<a href="registracija.php" class="ap">Še nimate računa?</a><br>
<input type="submit" value="Prijava" class="button"/><br>
<input type="reset" value="Prekliči" class="button"/><br>
            <?php echo '
<a href="'.$loginUrl.'" class="ap" style="color: blue;">Vpišite se s Facebook računom</a><br>';?>
</form>
    <form action="?login" method="post">
        <input id="none" type="image"  src="http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_small.png">
</form>

</div>

<?php }
include_once 'footer.php';