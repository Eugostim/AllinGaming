<?php
if( !isset($_SESSION)){session_start();}
//if( !isset ($_SESSION["idUser"]) ){header("location:login.php");} //Guardar um id de ustiizadnor no login para fazer verificação

// Ligação à BD 
require("connections/connection.php");

$descricao = htmlspecialchars($_POST["new_post"], ENT_QUOTES); // Validação contra SQL injection!

$user_id=$_SESSION["user_id"];

// Guarda a Data numa variavel
date_default_timezone_set('Europe/Lisbon');
$date = date('Y-m-d H:i:s');
$date_short= date('Y-m-d');

//===========Inserir ================
$query = "INSERT INTO publicacoes (texto, data, utilizadores_idutilizadores)  VALUES (?, ?, ?)";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, 'ssi', $descricao, $date, $user_id);

mysqli_stmt_execute($stmt);
printf("%d Row inserted.\n", $stmt->affected_rows);
mysqli_stmt_close($stmt);




//insereção de imagens nos posts
if($_FILES["post_photo"]["name"]!="") {


    $query = "SELECT max(idImagens) FROM imagens";
    $queryMax = mysqli_query($connect, $query);
    $idMaxFetch = mysqli_fetch_row($queryMax);
    $imgId = $idMaxFetch[0] + 1;




    $target_dir = "assets/img/";
    $target_file = $target_dir . $_FILES["post_photo"]["name"];
    $imageFileType = urlinfo($target_file, urlINFO_EXTENSION);
    $target_file = $target_dir . $imgId;
    $uploadOk = 1;

// Check if image file is a actual image or fake image
    if (isset($_POST["post"])) {
        $check = getimagesize($_FILES["post_photo"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["post_photo"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    switch ($imageFileType) {
        case "jpg":
            $imgId = $imgId . ".jpg";
            break;
        case "png":
            $imgId = $imgId . ".png";
            break;
        case "jpeg":
            $imgId = $imgId . ".jpeg";
            break;
        case "gif":
            $imgId = $imgId . ".gif";
            break;
    }

    $target_file = $target_dir . $imgId;

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["post_photo"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["post_photo"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


    $href = "assets/img/" . $imgId;
    $foto = "INSERT INTO imagens (url, utilizadores_idUtilizadores) VALUES (?, ?)";
    $foto_insert = mysqli_prepare($connect, $foto);
    mysqli_stmt_bind_param($foto_insert, 'si', $href, $user_id);
    mysqli_stmt_execute($foto_insert);

    $imgPubId =$connect->insert_id;

    mysqli_stmt_close($foto_insert);


//if (isset($idEvento)) {
//    $evento = "UPDATE imagens SET eventos_ideventos = ? WHERE idImagens = ?";
//    $evento_insert = mysqli_prepare($connect, $foto);
//    mysqli_stmt_bind_param($evento_insert, 'ii', $idEvento, $imgId);
//    mysqli_stmt_execute($evento_insert);
//    mysqli_stmt_close($evento_insert);
//}


    $queryPub = "SELECT max(idpublicacao) FROM publicacoes";
    $queryMaxPub = mysqli_query($connect, $queryPub);
    $idMaxPubFetch = mysqli_fetch_row($queryMaxPub);
    $idPublicacao = $idMaxPubFetch[0];

    echo "idPublicacao=".$idPublicacao ." img=". $imgPubId;
    $relation = "INSERT INTO publicacoes_has_imagens (publicacao_idpublicacao, imagens_idimagens) VALUES (?, ?)";
    $relation_insert = mysqli_prepare($connect, $relation);
    mysqli_stmt_bind_param($relation_insert, 'ii', $idPublicacao, $imgPubId);
    mysqli_stmt_execute($relation_insert);
    printf("%d Row inserted.\n", $relation_insert->affected_rows);
    mysqli_stmt_close($relation_insert);

}



//================== Feedback ==========
$_SESSION["post_success"] = "<div class='alert alert-success'><p class='text-center'><span class='glyphicon glyphicon-exclamation-sign'>&nbsp</span><b> Posted Successfully </b></p></div>";

//======= redireciona =========
header('Location: inicio.php');

//var_dump($_SESSION);


