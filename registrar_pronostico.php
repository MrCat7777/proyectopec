<?php
require_once 'controllers/PronosticoController.php';
$controller = new PronosticoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->guardarPronostico($_POST);
} else {
    $controller->mostrarFormularioPronostico();
}
?>