<?php
if( !isset($_SESSION)){session_start();}
if(!isset ($_SESSION['login'])){
//    echo("NAO TEM LOGIN");
    header("location:includes/hybridauth-2.8.0/hybridauth/login.php");
}else if(isset($_SESSION['login'])) {
//    echo("TEM LOGIN");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ALLiN Gaming</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Google Fonts => Ralleway-->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,200' rel='stylesheet' type='text/css'>
    <!-- Estilos -->
    <link href="assets/css/custom_styles.css" rel="stylesheet">
    <link href="assets/css/bootstrap_css/bootstrap.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="assets/site/favicon.png" type="image/x-icon">
</head>
<body>

<div class="perspective effect-rotate-left">
    <div class="container-perspective">
        <div class="outer-nav--return"></div>
        <div id="viewport" class="l-viewport">
            <div class="l-wrapper">
                <header class="header">
                    <a class="header--logo img-size" href="inicio.php">
                        <img src="assets/img/logotemp.png" alt="ALLiN">
                    </a>

                    <form class="search-bar-style" role="search"  action="search.php?" method="get" >
                        <div class="form-group">
                            <div class="input-group search-bar-size">
                                <input type="text" name="search_queue" id="search_queue" class="search-bar" placeholder="Search for some news, media or even friends">
                                <div class="input-group-addon search-bar-icon"><span class="glyphicon glyphicon-search"></span></div>
                                <!--passar tipo de pesquisa-->
                                <input type="hidden" hidden="hidden" name="search_type" id="search_type" value="1">
                                <div class="spacer-xs"></div>
                            </div>
                        </div>
                    </form>

                    <div style="margin-right: 2%; font-size: x-large">
                        <a href="inicio.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a>
                    </div>
                </header>

                <ul class="l-main-content main-content">
                    <li class="l-section section scroll-fix-line section--is-active">

                        <!--================================================ Caso Get 1 ==========================================================================-->


                        <?php if($_GET["search_type"] == 1){
                            require_once("connections/connection.php");

                            //print_r($_POST["search_queue"]);
                            $searchQueue = (string)$_GET["search_queue"];

                            //=========== Obtem resultados da pesquisa ==============
                            $query_search = "SELECT idUtilizadores, nome, email FROM utilizadores WHERE nome LIKE '%$searchQueue%' OR email LIKE '%$searchQueue%'";

                            $result_search = mysqli_query($connect, $query_search);
                            $row_search = mysqli_fetch_assoc($result_search);

                            //===================== Caso não haja resultados =============================================
                            if ($row_search == false || empty($row_search)){ ?>

                                <div class="container-fluid">
                                <div class="row">

                                <!--    coluna esquerda-->
                                <div class="col-md-2 col-xs-12 margin-screen ads" style="width: 260px; margin-left: 55px"></div>

                                <!--coluna central-->

                                <div class="col-md-8 col-xs-12 margin-screen">
                                    <!-- nav do search -->
                                    <ul class="nav nav-tabs">
                                        <li role="presentation" class="active"><a
                                                href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=1">People</a>
                                        </li>
                                        <li role="presentation"><a
                                                href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=2">Posts</a>
                                        </li>
                                        <li role="presentation"><a
                                                href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=3">Games</a>
                                        </li>
                                    </ul>

                                    <div class="white-bg bottom-space">

                                        <div class="headerPost">
                                            <h4> Resultados para "<?= $_GET["search_queue"]; ?>":</h4>
                                        </div>

                                        <hr>

                                        <div>
                                            <div class="alert alert-danger" style="margin: 0 2% 2% 2%">
                                                No users found for : " <?= $_GET["search_queue"]; ?> " !
                                            </div>
                                        </div>
                                        <div class="spacer-sm"></div>

                                        <hr>

                                    </div>
                                </div>
                                <!--        coluna direita-->
                                <div class="col-md-2 col-xs-12 ads margin-screen" style="width: 260px"></div>

                                <!--//===================== Resultados de pessoas =============================================-->

                            <?php }else if ($row_search == true){


                                require_once("connections/connection.php");

                                //print_r($_POST["search_queue"]);
                                $searchQueue = (string)$_GET["search_queue"];

                                //=========== Obtem resultados da pesquisa ==============
                                $query_search = "SELECT idUtilizadores, nome, email FROM utilizadores WHERE nome LIKE '%$searchQueue%' OR email LIKE '%$searchQueue%'";

                                $result_search = mysqli_query($connect, $query_search);
                                $row_search = mysqli_fetch_assoc($result_search);

                                ?>

                                <div class="container-fluid">
                                    <div class="row">

                                        <!--    coluna esquerda-->
                                        <div class="col-md-2 col-xs-12 ads margin-screen" style="width: 260px; margin-left: 55px"></div>

                                        <!--coluna central-->

                                        <div class="col-md-8 col-xs-12 margin-screen">

                                            <ul class="nav nav-tabs">
                                                <li role="presentation" class="active"><a
                                                        href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=1">People</a>
                                                </li>
                                                <li role="presentation"><a
                                                        href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=2">Posts</a>
                                                </li>
                                                <li role="presentation"><a
                                                        href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=3">Games</a>
                                                </li>
                                            </ul>

                                            <div class="white-bg bottom-space">
                                                <div class="headerPost">
                                                    <h4> Resultados para "<?= $_GET["search_queue"]; ?>":</h4>
                                                </div>

                                                <hr>

                                                <?php
                                                //========= Fetch para Array Associativo=====
                                                while ($row_search = mysqli_fetch_assoc($result_search)) {
                                                    ?>
                                                    <div class="headerPost">
                                                        <div class="postContentt">
                                                            <p><?php echo $row_search["nome"] ?></p>

                                                            <p><?php echo $row_search["email"]; ?></p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <!--        coluna direita-->
                                        <div class="col-md-2 col-xs-12 ads margin-screen" style="width: 260px"></div>

                                    </div>
                                </div>
                                </div>
                                </div>
                                <?php

                                //=====Fecha a ligação á BD=====
//                                        mysqli_close($connect);
                            }?>

                            <!--================================================ Caso Get 2 ==========================================================================-->



                        <?php }else if($_GET["search_type"] == 2){
                            require_once("connections/connection.php");

                            //print_r($_POST["search_queue"]);
                            $searchQueue = (string)$_GET["search_queue"];

                            //=========== Obtem resultados da pesquisa ==============
                            $query_search = "SELECT texto FROM publicacoes WHERE texto LIKE '%$searchQueue%'";

                            $result_search = mysqli_query($connect, $query_search);
                            $row_search = mysqli_fetch_assoc($result_search);

                            //===================== Caso não haja resultados =============================================
                            if ($row_search == false || empty($row_search)){ ?>

                                <div class="container-fluid">
                                <div class="row">

                                <!--    coluna esquerda-->
                                <div class="col-md-2 col-xs-12 margin-screen ads" style="width: 260px; margin-left: 55px"></div>

                                <!--coluna central-->

                                <div class="col-md-8 col-xs-12 margin-screen">
                                    <!-- nav do search -->
                                    <ul class="nav nav-tabs">
                                        <li role="presentation"><a
                                                href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=1">People</a>
                                        </li>
                                        <li role="presentation" class="active"><a
                                                href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=2">Posts</a>
                                        </li>
                                        <li role="presentation"><a
                                                href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=3">Games</a>
                                        </li>
                                    </ul>

                                    <div class="white-bg bottom-space">

                                        <div class="headerPost">
                                            <h4> Resultados para "<?= $_GET["search_queue"]; ?>":</h4>
                                        </div>

                                        <hr>

                                        <div>
                                            <div class="alert alert-danger" style="margin: 0 2% 2% 2%">
                                                No users found for : " <?= $_GET["search_queue"]; ?> " !
                                            </div>
                                        </div>
                                        <div class="spacer-sm"></div>

                                        <hr>

                                    </div>
                                </div>
                                <!--        coluna direita-->
                                <div class="col-md-2 col-xs-12 ads margin-screen" style="width: 260px"></div>

                                <!--//===================== Resultados de pessoas =============================================-->

                            <?php }else if ($row_search == true){


                                require_once("connections/connection.php");

                                //print_r($_POST["search_queue"]);
                                $searchQueue = (string)$_GET["search_queue"];

                                //=========== Obtem resultados da pesquisa ==============
                                $query_search = "SELECT texto FROM publicacoes WHERE texto LIKE '%$searchQueue%'";

                                $result_search = mysqli_query($connect, $query_search);
                                $row_search = mysqli_fetch_assoc($result_search);

                                ?>

                                <div class="container-fluid">
                                    <div class="row">

                                        <!--    coluna esquerda-->
                                        <div class="col-md-2 col-xs-12 ads margin-screen" style="width: 260px; margin-left: 55px"></div>

                                        <!--coluna central-->

                                        <div class="col-md-8 col-xs-12 margin-screen">

                                            <ul class="nav nav-tabs">
                                                <li role="presentation" ><a
                                                        href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=1">People</a>
                                                </li>
                                                <li role="presentation" class="active"><a
                                                        href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=2">Posts</a>
                                                </li>
                                                <li role="presentation"><a
                                                        href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=3">Games</a>
                                                </li>
                                            </ul>

                                            <div class="white-bg bottom-space">
                                                <div class="headerPost">
                                                    <h4> Resultados para "<?= $_GET["search_queue"]; ?>":</h4>
                                                </div>

                                                <hr>

                                                <?php
                                                //========= Fetch para Array Associativo=====
                                                while ($row_search = mysqli_fetch_assoc($result_search)) {
                                                    ?>
                                                    <div class="headerPost">
                                                        <div class="postContentt">
                                                            <p><?php echo $row_search["texto"] ?></p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <!--        coluna direita-->
                                        <div class="col-md-2 col-xs-12 ads margin-screen" style="width: 260px"></div>

                                    </div>
                                </div>
                                </div>
                                </div>
                                <?php

                                //=====Fecha a ligação á BD=====
                                //mysqli_close($connect);
                            }?>


                        <!--================================================ Caso Get 3 ==========================================================================-->



                        <?php }else if($_GET["search_type"] == 3){
                            require_once("connections/connection.php");

                            //print_r($_POST["search_queue"]);
                            $searchQueue = (string)$_GET["search_queue"];

                            //=========== Obtem resultados da pesquisa ==============
                            $query_search = "SELECT idbiblioteca, nome FROM bibliotecasteam WHERE idbiblioteca LIKE '%$searchQueue%' OR nome LIKE '%$searchQueue%'";

                            $result_search = mysqli_query($connect, $query_search);
                            $row_search = mysqli_fetch_assoc($result_search);

                            //===================== Caso não haja resultados =============================================
                            if ($row_search == false || empty($row_search)){ ?>

                                <div class="container-fluid">
                                <div class="row">

                                <!--    coluna esquerda-->
                                <div class="col-md-2 col-xs-12 margin-screen ads" style="width: 260px; margin-left: 55px"></div>

                                <!--coluna central-->

                                <div class="col-md-8 col-xs-12 margin-screen">
                                    <!-- nav do search -->
                                    <ul class="nav nav-tabs">
                                        <li role="presentation"><a
                                                href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=1">People</a>
                                        </li>
                                        <li role="presentation" ><a
                                                href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=2">Posts</a>
                                        </li>
                                        <li role="presentation" class="active"><a
                                                href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=3">Games</a>
                                        </li>
                                    </ul>

                                    <div class="white-bg bottom-space">

                                        <div class="headerPost">
                                            <h4> Resultados para "<?= $_GET["search_queue"]; ?>":</h4>
                                        </div>

                                        <hr>

                                        <div>
                                            <div class="alert alert-danger" style="margin: 0 2% 2% 2%">
                                                No users found for : " <?= $_GET["search_queue"]; ?> " !
                                            </div>
                                        </div>
                                        <div class="spacer-sm"></div>

                                        <hr>

                                    </div>
                                </div>
                                <!--        coluna direita-->
                                <div class="col-md-2 col-xs-12 ads margin-screen" style="width: 260px"></div>

                                <!--//===================== Resultados de pessoas =============================================-->

                            <?php }else if ($row_search == true){


                                require_once("connections/connection.php");

                                //print_r($_POST["search_queue"]);
                                $searchQueue = (string)$_GET["search_queue"];

                                //=========== Obtem resultados da pesquisa ==============
                                $query_search = "SELECT idbiblioteca, nome FROM bibliotecasteam WHERE idbiblioteca LIKE '%$searchQueue%' OR nome LIKE '%$searchQueue%'";

                                $result_search = mysqli_query($connect, $query_search);
                                $row_search = mysqli_fetch_assoc($result_search);

                                ?>

                                <div class="container-fluid">
                                    <div class="row">

                                        <!--    coluna esquerda-->
                                        <div class="col-md-2 col-xs-12 ads margin-screen" style="width: 260px; margin-left: 55px"></div>

                                        <!--coluna central-->

                                        <div class="col-md-8 col-xs-12 margin-screen">

                                            <ul class="nav nav-tabs">
                                                <li role="presentation" ><a
                                                        href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=1">People</a>
                                                </li>
                                                <li role="presentation" ><a
                                                        href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=2">Posts</a>
                                                </li>
                                                <li role="presentation" class="active"><a
                                                        href="search.php?search_queue=<?php $_GET["search_queue"] ?>&search_type=3">Games</a>
                                                </li>
                                            </ul>

                                            <div class="white-bg bottom-space">
                                                <div class="headerPost">
                                                    <h4> Resultados para "<?= $_GET["search_queue"]; ?>":</h4>
                                                </div>

                                                <hr>

                                                <?php
                                                //========= Fetch para Array Associativo=====
                                                while ($row_search = mysqli_fetch_assoc($result_search)) {
                                                    ?>
                                                    <div class="headerPost">
                                                        <div class="postContentt">
                                                            <p><?php echo $row_search["idbiblioteca"] ?></p>
                                                            <p><?php echo $row_search["nome"] ?></p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <!--        coluna direita-->
                                        <div class="col-md-2 col-xs-12 ads margin-screen" style="width: 260px"></div>

                                    </div>
                                </div>
                                </div>
                                </div>
                                <?php

                                //=====Fecha a ligação á BD=====
                                //mysqli_close($connect);
                            }
                        }?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <ul class="outer-nav">
        <li class="is-active">Home</li>
        <li>News</li>
        <li>Media</li>
        <li>Profile</li>
        <li>Library</li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-2.2.4.min.js"><\/script>')</script>
<script src="assets/js/functions-min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>


</body>
</html>