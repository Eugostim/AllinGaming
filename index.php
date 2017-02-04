<?php
/**
 * Created by PhpStorm.
 * User: José Miguel
 * Date: 26/09/2016
 * Time: 16:54
 */

if( !isset($_SESSION)){session_start();}

require('vendor/autoload.php');
require_once ('connections/connection.php');
ini_set('max_execution_time', 300);


/**ESTA PÁGINA DESTINA-SE A ROTINAS E TASKS E NÃO DEVE EM MOMENTO ALGUM SER MOSTRADA AO UTILIZADOR**/

/**Codigo para inserir jogos steam na base de dados**/

?>
    <form method="post" action="?ask">
        <input type="submit" title="CRIAR O INFERNO STEAM!!">
    </form>
<?php


if (isset($_GET["ask"])) {
    $hell=json_decode(file_get_contents("https://api.steampowered.com/ISteamApps/GetAppList/v2"),true);
    $lilhell=$hell["applist"];
    $heaven=$lilhell["apps"];

    for($i=0;$i<count($heaven);$i++){
        $selected=$heaven[$i];
        $appID=$selected["appid"];
        $gameName=$selected["name"];
        $query = "INSERT INTO bibliotecasteam(idbiblioteca, nome) VALUES(?,?)";
        $games_insert = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($games_insert, 'is', $appID, $gameName);
        mysqli_stmt_execute($games_insert);
        mysqli_stmt_close($games_insert);

    }
    /**------------------------**/

//========== Obter a hash em vigor para validar se o utilizador tem permissões para editar o username =========
//    $query = "INSERT INTO bibliotecasteam(idbiblioteca, nome) VALUES(?,?)";
//    $games_insert = mysqli_prepare($connect, $query);
//    mysqli_stmt_bind_param($games_insert, 'is', $appID, $gameName);
//    mysqli_stmt_execute($games_insert);
//    mysqli_stmt_close($games_insert);
}
///**STEAM**/
///**----------------------------baseado no exemplo do LightOpenId-----------------------------*/
//http://steamcommunity.com/openid
//require 'includes/lightopenid/openid.php';
//
//$client = new \Zyberspace\SteamWebApi\Client('45FF2974E9ED6B469B97294BC24666AC');
//
//$_STEAMAPI = "45FF2974E9ED6B469B97294BC24666AC";
//
//try
//{
//    $openid = new LightOpenID('http://localhost/Lab5/SteamBattleNet/index.php');
//    if(!$openid->mode)
//    {
//        if(isset($_GET['login']))
//        {
//            $openid->identity = 'http://steamcommunity.com/openid';
//            header('Location: ' . $openid->authUrl());
//        }
//        ?>
    <!--        <form action="?login" method="post">-->
    <!--            <input type="image" src="https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_01.png">-->
    <!--        </form>-->
    <!--        --><?php
//    }
//    elseif($openid->mode == 'cancel')
//    {
//        echo 'Login cancelado';
//    }
//    else
//    {
//        if($openid->validate())
//        {
//            $id = $openid->identity;
//            // identity is something like: http://steamcommunity.com/openid/id/76561197960435530
//            // we only care about the unique account ID at the end of the URL.
//            $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
//            preg_match($ptn, $id, $matches);
//            echo "Login bem sucedido (steamID: $matches[1])\n";
//
//            $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$_STEAMAPI&steamids=$matches[1]";
//            $json_object= file_get_contents($url);
//            $json_decoded = json_decode($json_object);
//
//            foreach ($json_decoded->response->players as $player)
//
//            $steamid=$player->steamid;
//            {
//                echo "
//                    <br/>Player ID: $player->steamid
//                    <br/>Player Name: $player->personaname
//                    <br/>Profile URL: $player->profileurl
//                    <br/>SmallAvatar: <img src='$player->avatar'/>
//                    <br/>MediumAvatar: <img src='$player->avatarmedium'/>
//                    <br/>LargeAvatar: <img src='$player->avatarfull'/>
//                    ";
//            }
//
//        }
//        else
//        {
//            echo "Utilizador sem Login efetuado.\n";
//        }
//    }
//}
//catch(ErrorException $e)
//{
//    echo $e->getMessage();
//}
//
///**----------------------------FIM LIGHTOPENID STEAM-----------------------------*/

//$ISteamApps = new Zyberspace\SteamWebApi\Interfaces\ISteamApps($client);
//$appList = $ISteamApps->GetAppListV2();


//$ISteamUser = new \Zyberspace\SteamWebApi\Interfaces\ISteamUser($client);
//$steamUser = $ISteamUser->GetPlayerSummariesV2('76561197960361544');

//$IPlayerService = new Zyberspace\SteamWebApi\Interfaces\IPlayerService($client);
//$library = $IPlayerService->GetOwnedGamesV1('76561198026318678',false,true,null);
//var_dump($library);

//no man's sky news
//$ISteamNews = new Zyberspace\SteamWebApi\Interfaces\ISteamNews($client);
//$news = $ISteamNews->GetNewsForAppV2(275850);
//print_r($news);


if(isset($_GET["code"])) {


    require('vendor/autoload.php');
    require('includes/blizzard-api-oauth-master/Client.php');
    require('includes/blizzard-api-oauth-master/GrantType/IGrantType.php');
    require('includes/blizzard-api-oauth-master/GrantType/AuthorizationCode.php');

    $client_id = 'c7ecz58d75qgq3fb3wu6rg9spyn7e5z5';
    $client_secret = 'awt7GCwyPNCqp9SpWtfYN2dKfPaKcSf9';
    $region = 'EU';
    $locale = 'pt';
    $redirect_uri = 'https://localhost/Lab5/SteamBattleNet/index.php';

    $client = new OAuth2\Client($client_id, $client_secret, $region, $locale, $redirect_uri);

    $params = array('code' => $_GET['code'], 'auth_flow' => 'auth_code', 'redirect_uri' => $client->redirect_uri);
    $response = $client->getAccessToken($client->baseurl[$client->region]['TOKEN_ENDPOINT'], 'authorization_code', $params);
    $client->setAccessToken($response['result']['access_token']);
    $response = $client->fetch('user', array('source' => 'account'));
    echo '<pre>';
    print_r($response);
    echo '</pre>';

    $r = $response['result'];
    $battleID = $r["id"];
    $battleName = substr($r["battletag"], 0, -5);
    $ref = substr($r['battletag'], -4, 4);
//echo $battleName;
    header('Location:login.php?id=' . $battleID . '&name=' . $battleName . '&ref=' . $ref);
}