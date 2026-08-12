$(document).ready(function(){
    var detalle_pedido_id; // Declarar la variable aquí
   tablaDetalles=$("#tablaDetalles").DataTable({
    "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
    }],
        //Para cambiar el lenguaje a español
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
    detalle_pedido_id=null;
    opcion = 1; //alta
    
    //estilo
    $(".modal-header").css("background-color", "green");
    $(".modal-title").text("Nuevo Detalle");
    $(".modal-header").css("color","white");
    $("#modalCRUD").modal("show");
    
    
});
    

    var fila;//capturar para editar o borrar el registro
    
//EDITAR BOTON
$(document).on("click",".btnEditar", function(){
    fila = $(this).closest("tr");
    detalle_pedido_id = parseInt(fila.find('td:eq(0)').text());
     pedido_id = parseInt(fila.find('td:eq(1)').text());
     camiseta_id = parseInt(fila.find('td:eq(2)').text());
     talla_id = parseInt(fila.find('td:eq(3)').text());
     color_id = parseInt(fila.find('td:eq(4)').text());
     cantidad = parseInt(fila.find('td:eq(5)').text());
     precio_unitario = parseInt(fila.find('td:eq(6)').text());

     
     
    
       $("#pedido_id").val(pedido_id);
       $("#camiseta_id").val(camiseta_id);
       $("#talla_id").val(talla_id);
       $("#color_id").val(color_id);
       $("#cantidad").val(cantidad);
       $("#precio_unitario").val(precio_unitario);
     
     

     opcion = 2; //Modificar  
     
     //estilo
    $(".modal-header").css("background-color", "purple");
    $(".modal-title").text("Editar Detalle");
    $(".modal-header").css("color","white");
    $("#modalCRUD").modal("show");
     
 });
    
// ELIMINAR BOTON
$(document).on("click", ".btnBorrar", function(){
    fila = $(this).closest("tr");
    detalle_pedido_id = parseInt(fila.find('td:eq(0)').text());
    opcion = 3; // borrar
    
    // Mostrar el modal de confirmación
    $("#confirmModal").modal("show");
    
    // Función para eliminar el registro si se confirma
    $("#confirmYes").click(function() {
         $.ajax({
        url: "bd/crudDetallesPedido.php",
        type: "POST",
        dataType: "json",
        data: {opcion: opcion, detalle_pedido_id: detalle_pedido_id},
        success: function(){
                tablaDetalles.row(fila).remove().draw();
            }
        });
        $("#confirmModal").modal("hide");
    });
    
    // Función para ocultar el modal de confirmación si se cancela
    $("#confirmNo, .close").click(function() {
        $("#confirmModal").modal("hide");
    });
});


    
    
  $("#formPedidos").submit(function(e){
      e.preventDefault();
      pedido_id = $.trim($("#pedido_id").val());
      camiseta_id = $("#camiseta_id").val();
      talla_id = $("#talla_id").val();
      color_id = $("#color_id").val();
      cantidad = $.trim($("#cantidad").val());
      precio_unitario = $.trim($("#precio_unitario").val());
     //detalle_pedido_id = $.trim($("#detalle_pedido_id").val());
      
      
      $.ajax({
          url:"bd/crudDetallesPedido.php",
          type: "POST",
          dataType: "json",
          data: {
                pedido_id: pedido_id,
                camiseta_id: camiseta_id,
                talla_id: talla_id,
                color_id: color_id,
                cantidad: cantidad,
                precio_unitario: precio_unitario,
                detalle_pedido_id: detalle_pedido_id, // Aquí se envía el detalle_pedido_id
                opcion: opcion
            },

          success: function(data){
              console.log(data);
              detalle_pedido_id = data[0].detalle_pedido_id;
              pedido_id = data[0].pedido_id;
              camiseta_id = data[0].camiseta_id;
              talla_id = data[0].talla_id;
              color_id = data[0].color_id;
              cantidad = data[0].cantidad;
              precio_unitario = data[0].precio_unitario;
              
              
              if(opcion == 1){tablaDetalles.row.add([detalle_pedido_id, pedido_id, camiseta_id, talla_id, color_id, cantidad, precio_unitario]).draw();}
              else{ tablaDetalles.row(fila).data([detalle_pedido_id, pedido_id, camiseta_id, talla_id, color_id, cantidad, precio_unitario]).draw();}
                  
          }   
          
      });
      $("#modalCRUD").modal("hide"); 
  });
    
    
});