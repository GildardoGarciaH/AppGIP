<?php

Class User {

    public function sendEmail($result, $identificador, $empresaCliente, $nombreMaquina, $nombreProyecto, $comentarios) {
        $this->result = $result;
        $this->identificador = $identificador;
        $this->empresaCliente = $empresaCliente;
        $this->nombreMaquina = $nombreMaquina;
        $this->nombreProyecto = $nombreProyecto;
        $this->comentarios = $comentarios;
        $num_rows = mysqli_num_rows($result);
        
        if($num_rows > 0) {
            while($db = mysqli_fetch_assoc($result)) {
                $email[] = $db['correo'];
            }

            $to      =  $email[0];
            $subject = "Nuevo Proyecto";
            $message = "Se ha generado un nuevo proyecto: {$identificador}\r\n \r\n Cliente: {$empresaCliente}\r\n Nombre de la Maquina: {$nombreMaquina}\r\n Nombre del Proyecto: {$nombreProyecto}\r\n Comentarios: {$comentarios}";
            $headers = "From: soporte@sacicorp.com";

            mail($to, $subject, $message, $headers);
        } else {
            return "inexistente";
        }
    }
}
?>