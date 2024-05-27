<?php

require_once "controladores/dashboard.controlador.php";
require_once "modelos/dashboard.modelo.php";

class AjaxDashboard{

    public function getDatosDashboard(){

        $datos = DashboardControlador::ctrGetDatosDashboard();

        echo json_encode($datos);
    }

}

if(isset($_POST['accion']) && $_POST['accion'] == 1){ //Ejecutar funcion ventas del mes (grafico de barras)

    $ventasMesActual = new AjaxDashboard();
    $ventasMesActual -> getVentasMesActual();

}else{
    $datos = new AjaxDashboard();
    $datos -> getDatosDashboard();
}