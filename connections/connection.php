<?php
/**
 * Created by PhpStorm.
 * User: José Miguel
 * Date: 06/12/2016
 * Time: 14:36
 */

//$host = "labmm.clients.ua.pt";
//$user = "deca_15L4_27_dbo";
//$pass = "QtRm7y";
//$db = "deca_15L4_27";

$host = "localhost";
$user = "root";
$pass = "";
$db = "steambattlenet";

global $connect;
$connect = new mysqli($host,$user,$pass,$db) or die("THE DATABASE IS DEAD");
mysqli_set_charset($connect,"utf8");