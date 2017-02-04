<!--================= Library =================-->
<div class="container-fluid">
    <div class="row">
        <?php
        if( !isset($_SESSION)){session_start();}
        if(!isset ($_SESSION['login'])){
//    echo("NAO TEM LOGIN");
            header("location:login.php");
        }else if(isset($_SESSION['login'])) {
//    echo("TEM LOGIN");
        }
        require('vendor/autoload.php');
        require('connections/connection.php');

        $queryID = "SELECT idutilizadores FROM utilizadores WHERE email = ?";
        $stmtS = mysqli_prepare($connect, $queryID);
        mysqli_stmt_bind_param($stmtS, 's',$_SESSION["email"]);
        mysqli_stmt_bind_result($stmtS, $user_id);
        mysqli_stmt_execute($stmtS);
        mysqli_stmt_fetch($stmtS);
        mysqli_stmt_close($stmtS);

        $query="SELECT idbiblioteca, nome, imgURL, playtime  FROM bibliotecasteam INNER JOIN bibliotecasteam_has_utilizadores ON idbiblioteca=bibliotecasteam_idbibliotecasteam WHERE utilizadores_idutilizadores = $user_id";
        $stm=mysqli_query($connect,$query);
        while($result=mysqli_fetch_assoc($stm)) {

            ?>
            <div class="col-lg-3 spacer-md">

                <div class="container-fluid games-library img-responsive">
                    <img src="<?=$result["imgURL"]?>" title="<?=$result["nome"]?>" class="img-responsive">
                    <form class="btn-group" action="steam://run/<?= $result["idbiblioteca"] ?>">
                        <input type="submit" value="Play Now!" class="btn btn-steam">
                    </form>
                    <form class="btn-group" method="post" action="inicio.php?appid=<?=$result["idbiblioteca"]?>">
                        <input type="submit" value="News" class="btn btn-info">
                    </form>
                </div>
            </div>
            <?php
        }

        $query="SELECT idbibliotecabattle, nome, imgURL  FROM bibliotecabattle INNER JOIN utilizadores_has_bibliotecabattle ON idbibliotecabattle=bibliotecabattle_idbibliotecabattle WHERE utilizadores_idutilizadores = $user_id";
        $stm=mysqli_query($connect,$query);
        $arrayBattle=array("WoW","D3","S2","WTCG","Hero","Pro");
        $incrementa=0;
        while($result=mysqli_fetch_assoc($stm)) {
            $incrementa++
            ?>
            <div class="col-lg-3 spacer-md">

                <div class="container-fluid games-library img-responsive">
                    <img src="<?= "blizz/" . $incrementa . ".jpg"?>" title="<?=$result["nome"]?>" class="img-responsive">
                    <form class="btn-group" action="battlenet://run/<?= $arrayBattle[$result["idbiblioteca"]] ?>">
                        <input type="submit" value="Play Now!" class="btn btn-steam">
                    </form>

                </div>
            </div>
            <?php
        }
        ?>


    </div>
</div>
<div class="spacer-lg"></div>
