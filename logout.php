<?php
if( !isset($_SESSION)){session_start();}
/**
 * Created by PhpStorm.
 * User: Fábio Silva
 * Date: 17/05/2016
 * Time: 16:07
 */

print_r($_POST); echo "<br><br>";
print_r($_SESSION); echo "<br><br>";

if (isset($_SESSION)) {
    session_unset();
}

if (isset ($_POST)){
    unset($_POST);
}

print_r($_POST); echo "<br><br>";
print_r($_SESSION); echo "<br><br>";

header("location: login.php"); //Feedback user