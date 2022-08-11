<?php
require "config.php";
require "funciones.class.php";
require "vars.php";

$funciones = new funciones($mysqli);
$modulo = isset($_GET['modulo']) ? $_GET['modulo'] : "inicio";

require 'app/index.php';


?>