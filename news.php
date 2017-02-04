<!--=================News=================-->
<div class="container-fluid">
    <div class="row">

        <!--Coluna Esq -->
        <div class="col-md-2 ads col-xs-12 margin-screen" style="width: 260px;margin-left: 55px;"></div>

        <!--Coluna central -->
        <div class="col-md-8 col-xs-12 margin-screen"">
        <?php
        $appID=$_GET["appid"];// receber o appid correto EDIT: CSGO FTW
        //        $appID=440;
        date_default_timezone_set('GMT');
        $news=json_decode(file_get_contents("https://api.steampowered.com/ISteamNews/GetNewsForApp/v2?appid=$appID"),true);
        $n=$news["appnews"]["newsitems"];
        for($i=0;$i<count($n);$i++) {
            $titulo = $n[$i]["title"];
            $link = $n[$i]["url"];
            $conteudo = $n[$i]["contents"];
            $data = date("G:i d/m/Y", ($n[$i]["date"]));

            //alterar codigo para mostrar as notícias

//            echo "<br>", $titulo;
//            echo "<br>" . $data;
//            echo "<br>" . $conteudo;
//            echo "<br>" . $link;

            ?>
            <div class="white-bg bottom-space">
                <div class="headerPost">
                    <div class="imgProfile">
                        <img src="assets/site/paac.png" alt="userimg" class="img-rounded img-responsive"/>
                    </div>
                    <div class="namePost">
                        <a href="<?= $link ?>"><?= $titulo ?></a>
                    </div>
                    <div class="datePost">
                        <p><?= $data ?></p>
                    </div>
                </div>
                <div class="postLine"></div>
                <div class="postContent">
                    <div class="container-fluid text-justify"><?= $conteudo ?></div>
                </div>
            </div>
            <?php
        }
        ?>

        <!--Coluna drt -->
        <div class="col-md-2 ads col-xs-12 margin-screen" style="width: 260px;"></div>
    </div>
</div>
