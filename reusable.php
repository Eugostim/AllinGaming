<?php
/**
 * Created by PhpStorm.
 * User: José Miguel
 * Date: 14/12/2016
 * Time: 15:24
 */

/**Notícias Steam para um determinado jogo (necessita appID)**/

$appID=4700;// receber o appid correto

date_default_timezone_set('GMT');
$news=json_decode(file_get_contents("https://api.steampowered.com/ISteamNews/GetNewsForApp/v2?appid=$appID"),true);
$n=$news["appnews"]["newsitems"];
for($i=0;$i<count($n);$i++){
    $titulo=$n[$i]["title"];
    $link=$n[$i]["url"];
    $conteudo=$n[$i]["contents"];
    $data=date("G:i d/m/Y",($n[$i]["date"]));

    //alterar codigo para mostrar as notícias

    echo "<br>",$titulo;
    echo"<br>".$data;
    echo"<br>".$conteudo;
    echo"<br>".$link;

}

/**----------------------FIM CODIGO NOTICIAS------------------------**/


/**Códigos para o STEAM CLIENT **/
//todos estes códigos iniciam o cliente e podem ser usados  num hyperlink qualquer

$steamID="";//receber o steamID correto

//+++++mais importantes a implementar
//correr um jogo através do cliente
echo "<a href='steam://run/$appID'>RUN</a>";
//adicionar um amigo na steam, no seu perfil através do seu id
echo "<br><a href='steam://friends/add$steamID'>ADDFRIEND</a>";
//enviar uma mensagem via steam, no seu perfil através do seu id
echo "<br><a href='steam://friends/message/$steamID'>MESSAGE</a>";


//----menos importantes a implementar
//Ver a própria biblioteca ou abrir a steam
echo "<br><a href='steam://open/games'>STEAMLIBRARY</a>";
//Ver o floater Amigos
echo "<br><a href='steam://open/friends'>FRIENDS</a>";
/**---------FIM DOS CÓDIGOS STEAM CLIENT---------**/


/**Códigos para BattleNET (uii! afinal eles registaram o URI HANDLER)**/
//se for só para abrir o battlenet não se mete o identificador no URI

//WoW
echo "<br><a href='battlenet://WoW'>WoW</a>";
//DiabloIII
echo "<br><a href='battlenet://D3'>DIABLO3</a>";
//StarCraft II
echo "<br><a href='battlenet://S2'>STARCRAFT2</a>";
//Hearthstone
echo "<br><a href='battlenet://WTCG'>HEARTHSTONE</a>";
//Heroes of the Storm
echo "<br><a href='battlenet://Hero'>HotS</a>";
//Overwatch Pro
echo "<br><a href='battlenet://Pro'>OVERWATCH</a>";
