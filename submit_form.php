<?php
include "Models/DataObject.php";
include "Models/Client.php";
include "Models/Project.php";
include "Models/User.php";

$dataObj = new dataObject();
$project = new Project();

    if($_POST) {
        switch(true) {
            case $_POST['action'] == 'cargarClientes':
                $client = new Client();
                $sql = "SELECT nombre,clave FROM clientes";
                $result = $dataObj->execSql($sql);
                $client->getClientInfo($result);
            break;

            case $_POST['action'] == 'generarProyecto':
                $user = new User();
                
                $empresaCliente = $_POST['empresaCliente'];
                $valorEmpresaCliente = $_POST['valorEmpresaCliente'];
                $noOrden = $_POST['noOrden'];
                $nombreMaquina = $_POST['nombreMaquina'];
                $nombreProyecto = $_POST['nombreProyecto'];
                $liderProyecto = $_POST['liderProyecto'];
                $comentarios = $_POST['comentarios'];
                $existenCambios = $_POST['existenCambios'];
             
                $sql = "SELECT no_orden FROM gip WHERE no_orden = '$noOrden'";
                $result = $dataObj->execSql($sql);
                $existance = $project->checkExistance($result);

                if($existance == "false") {
                    $sql = "SELECT identificador FROM gip WHERE nombre_maquina = '$nombreMaquina'";
                    $result = $dataObj->execSql($sql);
                    $identificador = $project->defineSerialNumber($result, $valorEmpresaCliente, $nombreMaquina, $existenCambios);
                    
                    $sql = "SELECT correo FROM usuarios WHERE nombre = '$liderProyecto'";
                    $result = $dataObj->execSql($sql);
                    $user->sendEmail($result, $identificador, $empresaCliente, $nombreMaquina, $nombreProyecto, $comentarios);

                    $sql = "INSERT INTO gip (empresa_cliente, no_orden, nombre_maquina, nombre_proyecto, lider_proyecto, comentarios, identificador) VALUES ('$empresaCliente', '$noOrden', '$nombreMaquina', '$nombreProyecto', '$liderProyecto', '$comentarios', '$identificador')";
                    $result = $dataObj->execSql($sql);
                    echo json_encode($identificador);
                    
                    $folderPath = $project->defineFilePathLocation($empresaCliente, $nombreMaquina, $identificador, $existenCambios);
                    
                } else {
                    echo json_encode("noOrden existente");
                }
            break;

            case $_POST['action'] == 'buscarProyecto':
                $identificadorProyecto = $_POST['identificadorProyecto'];
            
                $sql = "SELECT * FROM gip WHERE identificador = '$identificadorProyecto'";
                $result = $dataObj->execSql($sql);
                $projectInfo = $project->searchProject($result);
            break;

            case 'cerrarProyecto':
                echo("cerrando");
            break;
        }  
    } else {
        echo("error");
    }
?>
