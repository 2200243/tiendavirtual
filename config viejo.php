<?php


$servidor = "localhost";
$basedatos = "desarollo_aplicaciones";
$usuario = "2200243";
$password = "";
$mysqli= new mysqli($servidor,$usuario,$password,$basedatos);


if ($mysqli->connect_errno) {
    echo $mysqli->connect_errno;
}

$urlweb = "http://localhost/tiendavirtual/";
?>