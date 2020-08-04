<?php

Class Project {

    public function checkExistance($result) {
        $this->result = $result;
        $num_rows = mysqli_num_rows($result);
   
        if($num_rows == 0) {
            return "false";
        } else {
            return "true";
        }
    }

    public function defineSerialNumber($result, $valorEmpresaCliente, $nombreMaquina, $existenCambios) {
        $this->result = $result;
        $this->valorEmpresaCliente = $valorEmpresaCliente;
        $this->nombreMaquina = $nombreMaquina;
        $this->existenCambios = $existenCambios;
        
        switch (true) {
            case $existenCambios == "false":
                $identificadores = array();
                $num_rows = mysqli_num_rows($result);

                if($num_rows > 0) {
                    while($db = mysqli_fetch_assoc($result)) {
                        $identificadores[] = $db['identificador'];
                    }
                    
                    return $identificadores[$num_rows - 1];
                } else {
                    $identificador = "{$valorEmpresaCliente}-{$nombreMaquina}001";
                    return $identificador;
                }
            break;

            case $existenCambios == "true":
                $identificadores = array();
                $num_rows = mysqli_num_rows($result);

                if($num_rows > 0) {
                    while($db = mysqli_fetch_assoc($result)) {
                        $identificadores[] = $db['identificador'];
                    }

                    $lastIdentificador = $identificadores[$num_rows-1];
                    $identificadorSplit = explode("00" , $lastIdentificador);
                    $number = intval($identificadorSplit[1]);
                    $newNumber = strval($number + 1);
                    $identificador = "{$identificadorSplit[0]}00{$newNumber}";
                    return $identificador;
                } else {
                    $identificador = "{$valorEmpresaCliente}-{$nombreMaquina}001";
                    return $identificador;
                }
            break;
        }
    }

    public function defineFilePathLocation($empresaCliente, $nombreMaquina, $identificador, $existenCambios) {
        $this->empresaCliente = $empresaCliente;
        $this->nombreMaquina = $nombreMaquina;
        $this->identificador = $identificador;
        $this->existenCambios = $existenCambios;

        if($existenCambios ==  "true") {
            $path = "C:\Users\Gildardo Garcia\Documents\App-GIP/{$empresaCliente}/{$nombreMaquina}/{$identificador}/Administracion";
        
            if (!mkdir($path, 0777, true)) {
                die('Failed to create folders...');
            }  
        }
    }

    public function searchProject($result) {
        $this->result = $result;
        $projectInfo = array();
        $num_rows = mysqli_num_rows($result);
        
        if($num_rows > 0) {
            while($db = mysqli_fetch_assoc($result)) {
                $projectInfo[] = $db['empresa_cliente'];
                $projectInfo[] = $db['no_orden'];
                $projectInfo[] = $db['nombre_maquina'];
                $projectInfo[] = $db['nombre_proyecto'];
                $projectInfo[] = $db['lider_proyecto'];
            }

            echo json_encode($projectInfo);
        } else {
            echo json_encode("noData");
        }
    }
}
?>