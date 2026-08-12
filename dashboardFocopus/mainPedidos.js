$(document).ready(function(){
    var tablaPedidos = $("#tablaPedidos").DataTable({
        "columnDefs":[{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
        }],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing":"Procesando...",
        }
    });

    $("#btnNuevo").click(function(){
        $("#formPedidos").trigger("reset");
        $(".modal-header").css("background-color", "green");
        $(".modal-title").text("Nuevo Pedido");
        $(".modal-header").css("color", "white");
        $("#modalCRUD").modal("show");
        pedido_id = null;
        opcion = 1; // Alta
    });

    var fila; // Capturar para editar o borrar el registro

    // EDITAR BOTON
    $(document).on("click", ".btnEditar", function(){
        fila = $(this).closest("tr");
        pedido_id = parseInt(fila.find('td:eq(0)').text());
        ClaveTransacion = fila.find('td:eq(1)').text();
        fecha = fila.find('td:eq(2)').text();
        estado = fila.find('td:eq(3)').text();
        PaypalDatos = fila.find('td:eq(4)').text();
        Correo = fila.find('td:eq(5)').text();
        Total = parseFloat(fila.find('td:eq(6)').text());
        Nombre = fila.find('td:eq(7)').text();
        Direccion = fila.find('td:eq(8)').text();

        $("#ClaveTransacion").val(ClaveTransacion);
        $("#fecha").val(fecha.replace(" ", "T")); // Reemplaza el espacio con 'T' para el campo datetime-local
        $("#estado").val(estado);
        $("#PaypalDatos").val(PaypalDatos);
        $("#Correo").val(Correo);
        $("#Total").val(Total);
        $("#Nombre").val(Nombre);
        $("#Direccion").val(Direccion);

        opcion = 2; // Modificar

        $(".modal-header").css("background-color", "purple");
        $(".modal-title").text("Editar Pedido");
        $(".modal-header").css("color", "white");
        $("#modalCRUD").modal("show");
    });

   // ELIMINAR BOTON
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this).closest("tr");
        pedido_id = parseInt(fila.find('td:eq(0)').text());
        opcion = 3; // borrar
        
        // Mostrar el modal de confirmación
        $("#confirmModal").modal("show");
    });

    // Función para eliminar el registro si se confirma
    $("#confirmYes").click(function() {
        $.ajax({
            url: "bd/crudPedidos.php",
            type: "POST",
            dataType: "json",
            data: {opcion: opcion, pedido_id: pedido_id},
            success: function(){
                tablaPedidos.row(fila).remove().draw();
            }
        });
        $("#confirmModal").modal("hide");
    });
    
    // Función para ocultar el modal de confirmación si se cancela
    $("#confirmNo, .close").click(function() {
        $("#confirmModal").modal("hide");
    });

    $("#formPedidos").submit(function(e){
    e.preventDefault();
    ClaveTransacion = $("#ClaveTransacion").val(); // Corregir aquí
    fecha = $.trim($("#fecha").val());
    estado = $.trim($("#estado").val());
    PaypalDatos = $.trim($("#PaypalDatos").val());
    Correo = $.trim($("#Correo").val());
    Total = $.trim($("#Total").val());
    Nombre = $.trim($("#Nombre").val());
    Direccion = $.trim($("#Direccion").val());

    $.ajax({
        url: "bd/crudPedidos.php",
        type: "POST",
        dataType: "json",
        data: {
            ClaveTransacion: ClaveTransacion, // Corregir aquí
            fecha: fecha, 
            estado: estado, 
            PaypalDatos: PaypalDatos, 
            Correo: Correo, 
            Total: Total, 
            Nombre: Nombre, 
            Direccion: Direccion, 
            pedido_id: pedido_id, 
            opcion: opcion
        },
        success: function(data){
            pedido_id = data[0].pedido_id;
            ClaveTransacion = data[0].ClaveTransacion;
            fecha = data[0].fecha;
            estado = data[0].estado;
            PaypalDatos = data[0].PaypalDatos;
            Correo = data[0].Correo;
            Total = data[0].Total;
            Nombre = data[0].Nombre;
            Direccion = data[0].Direccion;

            if(opcion == 1){
                tablaPedidos.row.add([pedido_id, ClaveTransacion, fecha, estado, PaypalDatos, Correo, Total, Nombre, Direccion]).draw();
            } else {
                tablaPedidos.row(fila).data([pedido_id, ClaveTransacion, fecha, estado, PaypalDatos, Correo, Total, Nombre, Direccion]).draw();
            }
        }
    });
    $("#modalCRUD").modal("hide");
});
    
   // VALIDACION DE NUMEROS
    $(document).ready(function(){
        // Función para validar el campo "Total" y mostrar un mensaje si no son números
        $("#Total").on("input", function() {
            var totalInput = $(this).val();
            var validNumber = /^\d*\.?\d*$/.test(totalInput);
            
            if (!validNumber) {
                $(this).val("");
                alert("Por favor, ingrese solo números en el campo 'Total'.");
            }
        });
    });
    
    //VALIDACION DE CORREO
    
});
