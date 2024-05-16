<!-- BARRA DE NAVEGACION-->
<?php include('layouts/header.php')?>


<?php

require_once "controllers/plantilla.controlador.php";

$plantilla = new PlantillaControlador();
$plantilla -> CargarPlantilla();
