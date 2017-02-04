<!--================= NEWS =================-->
<div class="container-fluid">
    <div class="row">
        <?php
        require('vendor/autoload.php');
        require('connections/connection.php');

        $profile=$_SESSION["user_id"];//RECEBER ID DE USER proprio ou não

        $queryID = "SELECT * FROM utilizadores WHERE idutilizadores=?";
        $stmt = mysqli_prepare($connect, $queryID);
        mysqli_stmt_bind_param($stmt, 'i', $profile);
        mysqli_stmt_bind_result($stmt, $userID, $nome, $email, $idade, $genero, $imgPerfil, $steamID, $steamName, $steamImg, $battleTag, $battleName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        ?>

        <!--Coluna Esq -->
        <div class="col-md-2 col-xs-12 white-bg padding-profile margin-screen let-left">
            <div class="col-xs-12 profileImg margin-profile">
                <img src="<?= $imgPerfil ?>" alt="userimg" class="img-rounded img-responsive"/>
            </div>
            <div class="col-xs-12 margin-profile">
                <h4  style="font-weight: bold; color: #1D1D26;"><?= $nome?> <!--<span class="glyphicon glyphicon-pencil">--></h4><!-- icon de editar o nome -->
                <?php if($steamName!=""){
                    ?>
                    <small>Steam: <?=$steamName ?></small><br>
                    <?php
                }
                ?>
                <?php if($battleName!=""){
                    ?>
                    <small>BattleTag: <?=$battleName?></small><br>
                    <?php
                }
                ?>
                <small><cite title="Location">Portugal <i class="glyphicon glyphicon-map-marker"></i></cite></small>
                <p>
                    <i class="glyphicon glyphicon-envelope"></i> <?= $email ?>
                    <br />
                    <?php if ($idade!=""){?>
                    <i class="glyphicon glyphicon-gift"></i> <?= $idade ?>
                </p>
            <?php
            }
            ?>
                <!-- Quando estamos a ver o nosso perfil -->
                <?php
                if($_SESSION["userID"]!=$profile){
                    ?>
                    <!--                <button type="button" class="btn btn-default btn-sm">-->
                    <!--                    <span class="glyphicon glyphicon-camera"></span> Add Photo-->
                    <!--                </button>-->

                    <!--Quando estamos a ver o perfil do user-->
                    <form action="steam://friends/add<?= $steamID?>" class="btn-group">
                        <button type="button" class="btn btn-steam">
                            Add Friend on Steam
                        </button>
                    </form>
                    <form action="steam://friends/message<?= $steamID?>" class="btn-group">
                        <button type="button" class="btn btn-steam">
                            Message on Steam
                        </button>
                    </form>
                    <?php
                }
                ?>
            </div>
        </div>

        <!--Coluna central -->
        <div class="col-md-8 col-xs-12 margin-screen"">
        <?php
        // Definir a query para selecionar todas as publicações
        $query_publicacoes = "SELECT * FROM publicacoes WHERE invalido = 1 AND utilizadores_idutilizadores= $profile ORDER BY idpublicacao DESC LIMIT 10";

        // Extrair dados da BD?
        $result_publicacoes = mysqli_query($connect, $query_publicacoes);

        // Mostrar publibações
        while ($row_result_publicacoes =  mysqli_fetch_assoc($result_publicacoes)) {
            ?>

            <div class="white-bg bottom-space">
                <div class="headerPost">
                    <div class="imgProfile">
                        <img src="<?= $imgPerfil?>" alt="userimg" class="img-rounded img-responsive"/>
                    </div>
                    <div class="namePost">
                        <p><?= $nome?></p>
                    </div>
                    <div class="datePost">
                        <p><?= $row_result_publicacoes["data"] ?></p>
                    </div>
                </div>
                <div class="postLine"></div>
                <div class="postContent"><?php
                    $idPub = $row_result_publicacoes["idpublicacao"];
                    $queryImg="SELECT url FROM imagens WHERE publicacoes_idpublicacoes=?";
                    $stmt = mysqli_prepare($connect, $queryImg);
                    mysqli_stmt_bind_param($stmt, 'i',$idPub);
                    mysqli_stmt_bind_result($stmt, $imgUrl);
                    if(mysqli_stmt_execute($stmt)){
                        echo "<img src='".$imgUrl."'>";
                    }
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_close($stmt);
                    ?>
                    <p><?= $row_result_publicacoes["texto"]?></p>
                </div>
            </div>
            <?php
        }
        ?>




    </div>


    <!--Coluna drt -->
    <div class="col-md-2 ads col-xs-12 margin-screen" style="width: 300px;"></div>
</div>
</div>