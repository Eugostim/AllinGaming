<?php
if( !isset($_SESSION)){session_start();}
if(!isset ($_SESSION['login'])){
//    echo("NAO TEM LOGIN");
    header("location:login.php");
}


require("connections/connection.php");
$queryID = "SELECT idutilizadores FROM utilizadores WHERE email = ?";
$stmtS = mysqli_prepare($connect, $queryID);
mysqli_stmt_bind_param($stmtS, 's',$_SESSION["email"]);
mysqli_stmt_bind_result($stmtS, $user_id);
mysqli_stmt_execute($stmtS);
mysqli_stmt_fetch($stmtS);
mysqli_stmt_close($stmtS);

$_SESSION["user_id"]=$user_id;

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

                    <div class="header--nav-toggle">
                        <span></span>
                    </div>
                </header>

                <ul class="l-main-content main-content">
                    <?php
                    if(!isset($_GET["appid"])){
                    ?>
                    <li class="l-section section scroll-fix-line section--is-active">

                        <?php include("feed.php") ?>

                    </li>
<!--                    <li class="l-section section scroll-fix-line">-->
<!---->
<!--                        --><?php //include("news.php");
                        }else{
                        ?>
<!--                    <li class="l-section section scroll-fix-line">-->

                        <?php include("feed.php") ?>

                    </li>
<!--                    <li class="l-section section scroll-fix-line section--is-active">-->
<!---->
<!--                        --><?php //include("news.php");
                        }
//                        ?>
<!---->
<!--                    </li>-->
<!--                    <li class="l-section section scroll-fix-line">-->
<!---->
<!--                        --><?php //include("media.php")?>
<!---->
<!--                    </li>-->
                    <li class="l-section section scroll-fix-line">

                        <?php include("profile.php")?>

                    </li>
                    <li class="l-section section scroll-fix-line">
                        <?php include ("library.php");?>

                    </li>
                  </li>
                </ul>
            </div>
        </div>
    </div>
    <ul class="outer-nav">
        <li class="is-active">Home</li>
<!--        <li>News</li>-->
<!--        <li>Media</li>-->
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
