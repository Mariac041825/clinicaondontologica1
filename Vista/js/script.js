$(document).ready(function () {
    
    $("#frmPaciente").dialog({
        autoOpen: false,
        height: 310,
        width: 400,
        modal: true,
        buttons: {
            "Insertar": insertarPaciente,
            "Cancelar": cancelar
        }
    });

  
    $("#frmMedico").dialog({
        autoOpen: false,
        height: 250,
        width: 400,
        modal: true,
        buttons: {
            "Guardar": insertarMedico, 
            "Cancelar": cancelar
        },
        close: function () {
           
            $("#agregarMedico")[0].reset();
        }
    });

    $("#modalPaciente").dialog({
        autoOpen: false,
        height: 250,
        width: 400,
        modal: true,
        buttons: {
            "Guardar": insertarMedico, 
            "Cancelar": cancelar
        },
        close: function () {
           
            $("#agregarMedico")[0].reset();
        }
    });







   
    $('.editar-medico').click(function (e) {
        e.preventDefault();
        var idMedico = $(this).data('id');

        $.ajax({
            url: 'index.php',
            method: 'GET',
            data: { accion: 'modificarMedico', id: idMedico },
            success: function (respuesta) {
                $('#ventana-modal').html(respuesta);
                $('#ventana-modal').dialog({
                    modal: true,
                    width: 500,
                    height: 200,
                    buttons: {
                        "Cerrar": function () {
                            $(this).dialog("close");
                        }
                    }
                });
            },
            error: function () {
                alert('Error al cargar el formulario');
            }
        });
    });








}); 
function consultarPaciente() {
    var url = "index.php?accion=consultarPaciente&documento=" + $("#asignarDocumento").val();
    $("#paciente").load(url, function () { });
}

function mostrarFormulario() {
    var documento = $("#asignarDocumento").val();
    $("#PacDocumento").val(documento);
    $("#frmPaciente").dialog('open');
}

function insertarPaciente() {
    var queryString = $("#agregarPaciente").serialize();
    var url = "index.php?accion=ingresarPaciente&" + queryString;
    $("#paciente").load(url);
    $("#frmPaciente").dialog('close');
}


function mostrarFormularioMedico() {
    $("#MedDocumento").val('');
    $("#MedNombres").val('');
    $("#MedApellidos").val('');

    $("#frmMedico").dialog('open');
    
}

function iniciosesionpaciente(){
     $("#modalPaciente").dialog('open');
}


function insertarMedico() {
  

    $.ajax({
        url: "index.php?accion=agregarMedico", 
        type: "POST", 
        data: $("#agregarMedico").serialize(), 
        success: function (response) {
            alert(response); 
            $("#frmMedico").dialog('close'); 
            location.reload(); 
        },
        error: function () {
            alert("Error al agregar el médico."); 
        }
    });
}

/**
 * Función genérica para cerrar diálogos.
 * 'this' se refiere al elemento del diálogo que la llamó.
 */
function cancelar() {
    $(this).dialog('close');
}

// --- El resto de tus funciones ---
function cargarHoras() {
    if ($("#medico").val() == -1 || $("#fecha").val() == "") {
        $("#hora").html("<option value='-1' selected='selected'>--Seleccione la hora---</option>");
    } else {
        var queryString = "medico=" + $("#medico").val() + "&fecha=" + $("#fecha").val();
        var url = "index.php?accion=consultarHora&" + queryString;
        $("#hora").load(url);
    }
}
function seleccionarHora() {
    if ($("#medico").val() == -1) {
        alert("Debe seleccionar un médico");
    } else if ($("#fecha").val() == "") {
        alert("Debe seleccionar una fecha");
    }
}
function consultarCitas() {
    url = "index.php?accion=consultarCitas&consultarDocumento=" +
        $("#consultarDocumento").val();
    $("#paciente2").load(url);
}
function cancelarConsultar() {
    url = "index.php?accion=cancelarCitas&cancelarDocumento=" +
        $("#cancelarDocumento").val();
    $("#paciente3").load(url);
}
function confirmarCancelar(numero) {
    if (confirm("¿Está seguro de cancelar la cita " + numero + "?")) {
        $.get("index.php", { accion: 'confirmarCancelar', numero: numero }, function (mensaje) {
            alert(mensaje);
        });
    }
    $("#cancelarConsultar").trigger("click");
}