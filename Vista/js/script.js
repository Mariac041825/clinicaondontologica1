$(document).ready(function () {
    // Diálogo para agregar paciente
    $("#frmPaciente").dialog({
        autoOpen: false,
        height: 310,
        width: 400,
        modal: true,
        buttons: {
            "Insertar": function () {
                insertarPaciente();
                $(this).dialog('close');
            },
            "Cancelar": function () {
                $(this).dialog("close");
            }
        }
    });

    // Diálogo para agregar médico
    $("#frmMedico").dialog({
        autoOpen: false,
        height: 250,
        width: 400,
        modal: true,
        buttons: {
            "Guardar": function () {
                insertarMedico();
            },
            "Cancelar": function () {
                $(this).dialog("close");
            }
        },
        close: function () {
            $("#agregarMedico")[0].reset();
        }
    });

    // Botón para abrir formulario de edición de médico
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

    // Cargar horas cuando cambia médico o fecha
    $("#medico, #fecha").change(cargarHoras);
});


// 🧩 FUNCIONES AUXILIARES

function consultarPaciente() {
    var doc = $("#asignarDocumento").val().trim();
    if (doc !== "") {
        var url = "index.php?accion=consultarPaciente&documento=" + doc;
        $("#paciente").load(url);
    }
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
}

// Mostrar modal de médico vacío
function mostrarFormularioMedico() {
    $("#MedDocumento").val('');
    $("#MedNombres").val('');
    $("#MedApellidos").val('');
    $("#MedContrasena").val('');
    $("#frmMedico").dialog('open');
}

// Insertar médico vía AJAX
function insertarMedico() {
    $.ajax({
        url: "index.php?accion=agregarMedico",
        type: "POST",
        data: $("#agregarMedico").serialize(),
        success: function (response) {
            alert("Médico agregado correctamente");
            $("#frmMedico").dialog('close');
            location.reload();
        },
        error: function () {
            alert("Error al agregar el médico.");
        }
    });
}

// Cargar horas disponibles según médico y fecha
function cargarHoras() {
    if ($("#medico").val() == -1 || $("#fecha").val() === "") {
        $("#hora").html("<option value='-1' selected='selected'>--Seleccione la hora---</option>");
    } else {
        var queryString = "medico=" + $("#medico").val() + "&fecha=" + $("#fecha").val();
        var url = "index.php?accion=consultarHora&" + queryString;
        $("#hora").load(url);
    }
}

function consultarCitas() {
    var doc = $("#consultarDocumento").val().trim();
    if (doc !== "") {
        var url = "index.php?accion=consultarCitas&consultarDocumento=" + doc;
        $("#paciente2").load(url);
    }
}

function cancelarConsultar() {
    var doc = $("#cancelarDocumento").val().trim();
    if (doc !== "") {
        var url = "index.php?accion=cancelarCitas&cancelarDocumento=" + doc;
        $("#paciente3").load(url);
    }
}

function confirmarCancelar(numero) {
    if (confirm("¿Está seguro de cancelar la cita " + numero + "?")) {
        $.get("index.php", { accion: 'confirmarCancelar', numero: numero }, function (mensaje) {
            alert(mensaje);
            $("#cancelarConsultar").trigger("click");
        });
    }
}
