<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
    <link href="css/styles.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="img/fav-icon.png" >
    <title>Sistema GIP</title>
</head>

<body> 
    <div class="header">
        <img class="logo" src="img/saci.png" Width="200px" >
        <hr class="divider">  
            
        <div class="navbar">
            <p class="menu"><a href="cotizaciones.php">Cotizaciones</a></p>    
            <p class="menu"><a href="generador.php">Generador de identificadores</a></p>
            <p class="menu"><a href="gestiondedocumentos.php">Gestión de documentos</a></p>
            <p class="menu"><a href="monitoreodeproyectos.php">Monitoreo de proyectos</a></p>
            <p class="menu"><a href="proyectosinternos.php">Proyectos internos</a></p>
        </div>
    </div>

    <div class="content-background">
        <h1>Sistema Generador de Identificadores de Proyecto</h1>
            <div class="content">
                <form action="submit_form.php" method="POST">
                    <div class="left">  
                        <p class="info">Empresa cliente:</p>
                            <select id="input_empresaCliente" name="input_empresaCliente" class="left-section">
                                <option value="null">Selecciona una opción</option>
                            </select>
                        
                        <p class="info">No. de orden:</p>
                            <label for="fileUpload_noOrden" class="custom-file-upload" id="label_noOrden">Ningún archivo seleccionado...</label>    
                            <input type="file" id="fileUpload_noOrden" name="fileUpload_noOrden" autocomplete="off"></input>
                            <button id="Button_noOrden" name="Button_noOrden" class="secondaryButton">Mostrar</button>
                        
                        <p class="info">Nombre de la máquina/estación:</p>
                            <input type="text" id="input_nombreMaquina" name="input_nombreMaquina" class="left-section" autocomplete="off" maxlength="4"></input>

                        <p class="info">Nombre del proyecto:</p>
                            <input type="text" id="input_nombreProyecto" name="input_nombreProyecto" class="left-section" autocomplete="off"></input>
                        
                        <p class="info">Líder de proyecto:</p>
                            <input type="text" id="input_liderProyecto" name="input_liderProyecto" class="left-section" autocomplete="off"></input>

                        <p class="info">Comentarios:</p>
                            <input type="text" id="input_comentarios" name="input_comentarios" class="left-section"  autocomplete="off" textmode="MultiLine" maxlength="150"></input>
                        
                        <p class="info">Nuevo proyecto/Cambios en proyecto existente:
                            <input type="radio" id="input_si" name="radio_group" value="true" class="radioButton" autocomplete="off"><label for="si">Sí</label></input>
                            <input type="radio" id="input_no" name="radio_group" value="false" class="radioButton" checked><label for="no">No</label></input></p>

                        <div class="buttondiv">
                            <button type="submit" id="Button_generarProyecto" name="Button_generarProyecto" class="primaryButton">Generar proyecto</Button>        
                        </div>
                    </div>
                </form>
              

                <form action="submit_form.php" method="POST">
                    <div class="right">
                        <p class="info">Identificador de proyecto:</p>
                            <input type="text" id="input_identificadorProyecto" name="input_identificadorProyecto"  class="right-section" autocomplete="off"></input>
                            <button id="Button_buscarProyecto" name="Button_buscar" class="secondaryButton">Buscar</button>

                        <p class="info">Factura:</p>
                            <label for="fileUpload_factura" class="custom-file-upload">Ningún archivo seleccionado...</label>  
                            <input type="file" id="fileUpload_factura" name="FileUpload_factura" autocomplete="off" disabled="disabled"></input>
                            <button id="Button_factura" name="Button_factura" class="secondaryButton">Buscar</button>

                        <p class="info">Complemento de pago:</p>
                            <label for="fileUpload_complementoPago" class="custom-file-upload">Ningún archivo seleccionado...</label>  
                            <input type="file" id="fileUpload_complementoPago" name="FileUpload_complementoPago" autocomplete="off" disabled="disabled"></input>
                            <button id="Button_complementoPago" name="Button_complementoPago" class="secondaryButton">Buscar</button>

                        <div class="buttondiv">
                            <button type="submit" id="Button_cerrarProyecto" name="Button_cerrarProyecto" class="primaryButton">Cerrar proyecto</Button>
                        </div>
                    </div>
               </form>
            </div>
        </div>
    
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
  </body>
</html>
