$(document).ready(function() {

    document.getElementById("Button_generarProyecto").addEventListener("click", generarProyecto);
    document.getElementById("Button_buscarProyecto").addEventListener("click", buscarProyecto);
    document.getElementById("Button_cerrarProyecto").addEventListener("click", cerrarProyecto);
    document.getElementById("Button_noOrden").addEventListener("click", mostrarArchivo);

    
    const action = 'cargarClientes';
        $.ajax({
            url : '/AppGIP-Pruebas/submit_form.php',
            type : "POST",
            data : {action : action},

            success: function(response) {
                var select = document.getElementById("input_empresaCliente");
                var info = JSON.parse(response);

                for(var i = 0; i < info[0].length; i++) {
                    var option = info[0][i];
                    var element = document.createElement("option");
                    element.textContent = option;
                    option = info[1][i];
                    element.value = option;
                    select.appendChild(element);
                }
            },

            error: function(error) {
                alert("error");
            }
        });
    
    function mostrarArchivo() {
        const fakePath = $('#fileUpload_noOrden').val().split("\\");
        temp = fakePath.length;
        archivo = fakePath[temp - 1]; 

        if(temp > 1) {
            document.getElementById('label_noOrden').innerHTML = archivo;
        }
    }

    function generarProyecto() {
        const action = 'generarProyecto';
        const empresaCliente = $("#input_empresaCliente option:selected").text();
        const valorEmpresaCliente = $("#input_empresaCliente").val();
        const fakePath = $('#fileUpload_noOrden').val().split("\\");
        const nombreMaquina = $('#input_nombreMaquina').val();
        const nombreProyecto = $('#input_nombreProyecto').val();
        const liderProyecto = $('#input_liderProyecto').val();
        const comentarios = $('#input_comentarios').val();
        var existenCambios;

        temp = fakePath.length;
        noOrden = fakePath[temp - 1];

        if (document.getElementById('input_si').checked) {
            existenCambios = document.getElementById('input_si').value;
          } else {
              existenCambios = document.getElementById('input_no').value;
          }
            
        if(noOrden != undefined) {
            if(valorEmpresaCliente != "null" && nombreMaquina.length != 0 && nombreProyecto.length != 0 && liderProyecto.length != 0) {
                $.ajax({
                    url : 'submit_form.php',
                    type : "POST",
                    data : {action : action, empresaCliente : empresaCliente, valorEmpresaCliente : valorEmpresaCliente, noOrden : noOrden, nombreMaquina : nombreMaquina, nombreProyecto : nombreProyecto, liderProyecto : liderProyecto, comentarios : comentarios, existenCambios : existenCambios},

                    success: function(response) {
                        var respuesta = JSON.parse(response);
                        
                        if(respuesta == "noOrden existente") {
                            alert("El numero de Orden ya existe");   
                        } else {
                            alert("Proyecto generado exitosamente " + response);
                            parent.window.location.reload(true);
                        }
                    },

                    error: function(error) {
                        alert("error");
                    }
                });
            } else {
                alert("Favor de llenar todos los campos requeridos");
            }
        } else {
            alert("Favor de adjuntar una orden de compra");
        }
    }

    function buscarProyecto() {
        const action = 'buscarProyecto';
        const identificadorProyecto = $('#input_identificadorProyecto').val();

        if(identificadorProyecto.length != 0) {
            $.ajax({
                url : 'submit_form.php',
                type : "POST",
                data : {action : action, identificadorProyecto : identificadorProyecto},

                success: function(response) {
                    var info = JSON.parse(response);

                    if(info == "noData"){
                        alert("El identificador no existe");
                    } else {  
                        console.log(info);
                        document.getElementsByName('input_empresaCliente')[0].options[0].innerHTML = info[0];
                        document.getElementById('label_noOrden').innerHTML = info[1];
                        document.getElementById("input_nombreMaquina").value = info[2];
                        document.getElementById("input_nombreProyecto").value = info[3];
                        document.getElementById("input_liderProyecto").value = info[4];
                    }
                },

                error: function(error) {
                    alert("error");
                }
            });
        } else {
            alert("Favor de introducir un identificador de proyecto.");
        }
    }

    function cerrarProyecto() {
        const action = 'cerrarProyecto';
        alert("cerrar");
    }
});