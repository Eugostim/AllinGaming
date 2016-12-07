<?php
/**
 * Created by PhpStorm.
 * User: José Miguel
 * Date: 06/12/2016
 * Time: 14:36
 */

//$host = "mysql-sa.mgmt.ua.pt";
//$user = "deca-allg-dbo";
//$pass = "sWwWuZA6KsIkkvgw";
//$db = "deca-allg";

$host = "localhost";
$user = "root";
$pass = "";
$db = "steambattlenet";

global $connect;
$connect = new mysqli($host,$user,$pass,$db) or die("THE DATABASE IS DEAD");
mysqli_set_charset($connect,"utf8");