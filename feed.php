<div class="container-fluid">
    <div class="row">

        <!--Coluna Esq -->
        <div class="col-md-2 ads col-xs-12 margin-screen" style="width: 260px;margin-left: 55px;"></div>

        <!--Coluna central -->
        <div class="col-md-8 col-xs-12 margin-screen">
            <form class="white-bg" role="form" enctype="multipart/form-data" method="post" action="postProc.php">
                <div class="form-group" style="padding: 2rem 2rem 2rem 2rem; margin-bottom: 6rem;">
                    <textarea type="text"rows="6" class="form-style" id="new_post" name="new_post" placeholder="Share your thoughts..."></textarea>
                    <div class="spacer-xs"></div>
                    <!--Mudar type button para file, para submeter fotos-->
                    <button type="button" class="feed-btn" id="post_photo" name="post_photo" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-camera"></span> Add Photo
                    </button>
                    <button class="feed-btn" type="submit" value="submit" class="btn" style="float: right;">Submit Post</button>
                </div>

                <?php if(isset($_SESSION["post_success"])){
                    echo $_SESSION["post_success"];
                }?>

            </form>

<!--            <div>--><?php //var_dump($_SESSION["email"]) ?><!--</div>-->

            <?php
            // Ligação à BD 
            require_once('connections/connection.php');

            // Definir a query para selecionar todas as publicações
            $query_publicacoes = "SELECT * FROM publicacoes WHERE invalido = 1 ORDER BY idpublicacao DESC";

            // Extrair dados da BD 
            $result_publicacoes = mysqli_query($connect, $query_publicacoes);

            // Mostrar publibações
            while ($row_result_publicacoes =  mysqli_fetch_assoc($result_publicacoes)){ ?>

                <!--Blocos de feed-->
                <div class="white-bg bottom-space">
                    <div class="headerPost">
                        <div class="imgProfile">
                            <?php
                            $ref_nome = $row_result_publicacoes ["utilizadores_idutilizadores"];
                            $query_imagemUser = "SELECT imgPerfil FROM utilizadores WHERE idUtilizadores= $ref_nome";
                            $result_imgUser = mysqli_query($connect, $query_imagemUser);
                            $imagensUser_fetch = mysqli_fetch_assoc($result_imgUser);
                            $imagem_User = $imagensUser_fetch["imgPerfil"];
                             ?>
                            <img src="<?php echo $imagem_User; ?>" alt="userimg" class="img-rounded img-responsive"/>
<!--                            --><?php //var_dump($ref_nome); var_dump($imagem_User) ?>
                        </div>
                        <div class="namePost">
                            <!--<p>Pedro Cunha</p>-->
                            <?php
                            // Definir a query para selecionar o nome do proprietário da publicação

                            $query_nome_publicacoes = "SELECT nome FROM utilizadores WHERE idUtilizadores = $ref_nome";

                            // Extrair dados da BD 
                            $result_nome_publicacoes = mysqli_query($connect, $query_nome_publicacoes);
                            while ($row_result_nome_publicacoes =  mysqli_fetch_assoc($result_nome_publicacoes)) {
                                echo $row_result_nome_publicacoes["nome"];
                            }
                            $idPub = $row_result_publicacoes["idpublicacao"];

                            //$query_idImagens = "SELECT imagens_idImagens FROM publicacoes_has_imagens WHERE publicacao_idpublicacao= $idPub";
                            //$result_imgId = mysqli_query($connect, $query_idImagens);
                            //$imagens_fetch = mysqli_fetch_assoc($result_imgId);
                            //$imagens_idImagens = $imagens_fetch["imagens_idImagens"];

                            ?>
                        </div>
                        <div class="datePost">
                            <?php echo $row_result_publicacoes["data"] ?>
                        </div>
                    </div>
                    <div class="postLine"></div>
                    <div class="postContent">
                        <p><?php echo $row_result_publicacoes["texto"] ?></p>
                    </div>
                </div>
            <?php }?>
        </div>

        <!--Coluna drt -->
        <div class="col-md-2 ads col-xs-12 margin-screen" style="width: 260px;"></div>
    </div>

</div>

<?php if(isset($_SESSION["post_success"])){
    unset($_SESSION["post_success"]);
}?>