<?php

Class Client {
    public $nombre = array();
    public $clave = array();

    public function getClientInfo($result) {
        $this->result = $result;
           
        while($db = mysqli_fetch_assoc($result)) {
            $nombre[] = $db['nombre'];
            $clave[] = $db['clave'];
        }
        
        echo json_encode(array($nombre, $clave));
    }
}
?>