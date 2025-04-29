<?php
session_start();

$requestUri = $_SERVER["REQUEST_URI"];
$basePath = '/eysphp/public/';
$route = str_replace($basePath, '', $requestUri);
$route = strtok($route, '?'); // Quitar parámetros GET

// Mostrar menú si no hay ruta específica
if ($route == '') {
    echo "<h1>Menú principal</h1>";
    echo "<ul>";
    echo "<li><a href='sexo/index'>Administrar Sexo</a></li>";
    echo "<li><a href='persona/index'>Administrar Persona</a></li>";
    echo "<li><a href='direccion/index'>Administrar Dirección</a></li>";
    echo "<li><a href='telefono/index'>Administrar Teléfono</a></li>";
    echo "<li><a href='estadocivil/index'>Administrar Estado Civil</a></li>";
    echo "</ul>";
    exit; // No continuar ejecutando abajo
}

// Aquí decides qué controlador usar
switch (true) {
    case str_starts_with($route, 'sexo'):
        require_once '../app/controllers/SexoController.php';
        $controller = new SexoController();
        break;
    case str_starts_with($route, 'persona'):
        require_once '../app/controllers/PersonaController.php';
        $controller = new PersonaController();
        break;
    case str_starts_with($route, 'direccion'):
        require_once '../app/controllers/DireccionController.php';
        $controller = new DireccionController();
        break;
    case str_starts_with($route, 'telefono'):
        require_once '../app/controllers/TelefonoController.php';
        $controller = new TelefonoController();
        break;
    case str_starts_with($route, 'estadocivil'):
        require_once '../app/controllers/EstadoCivilController.php';
        $controller = new EstadoCivilController();
        break;
    default:
        echo "Error 404: Página no encontrada.";
        exit;
}

// Aquí ejecutas acciones específicas
switch ($route) {
    case 'sexo':
    case 'sexo/index':
    case 'persona':
    case 'persona/index':
    case 'direccion':
    case 'direccion/index':
    case 'telefono':
    case 'telefono/index':
    case 'estadocivil':
    case 'estadocivil/index':
        $controller->index();
        break;

    case 'sexo/edit':
    case 'persona/edit':
    case 'direccion/edit':
    case 'telefono/edit':
    case 'estadocivil/edit':
        if (isset($_GET['id'])) {
            $controller->edit($_GET['id']);
        } else {
            echo "Error: Falta el ID para editar.";
        }
        break;

    case 'sexo/eliminar':
    case 'persona/eliminar':
    case 'direccion/eliminar':
    case 'telefono/eliminar':
    case 'estadocivil/eliminar':
        if (isset($_GET['id'])) {
            $controller->eliminar($_GET['id']);
        } else {
            echo "Error: Falta el ID para eliminar.";
        }
        break;

    case 'sexo/update':
    case 'persona/update':
    case 'direccion/update':
    case 'telefono/update':
    case 'estadocivil/update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->update();
        }
        break;

    case 'sexo/delete':
    case 'persona/delete':
    case 'direccion/delete':
    case 'telefono/delete':
    case 'estadocivil/delete':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->delete();
        }
        break;

    default:
        echo "Error 404: Página no encontrada.";
        break;
}
