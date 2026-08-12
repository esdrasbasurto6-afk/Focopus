$(document).ready(function(){
   tablaColores=$("#tablaColores").DataTable({
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
    $("#formColores").trigger("reset");
    color_id=null;
    opcion = 1; //alta
    
    //estilo
    $(".modal-header").css("background-color", "green");
    $(".modal-title").text("Nueva Camisa");
    $(".modal-header").css("color","white");
    $("#modalCRUD").modal("show");
    
    
});
    

    var fila;//capturar para editar o borrar el registro
    
//EDITAR BOTON
 $(document).on("click",".btnEditar", function(){
     fila = $(this).closest("tr");
     color_id = parseInt(fila.find('td:eq(0)').text());
     nombre_color = fila.find('td:eq(1)').text();
     
    
     $("#nombre_color").val(nombre_color);

     opcion = 2; //Modificar  
     
     //estilo
    $(".modal-header").css("background-color", "purple");
    $(".modal-title").text("Editar Categoria");
    $(".modal-header").css("color","white");
    $("#modalCRUD").modal("show");
     
 });
    
// ELIMINAR BOTON
$(document).on("click", ".btnBorrar", function(){
    fila = $(this).closest("tr");
    color_id = parseInt(fila.find('td:eq(0)').text());
    opcion = 3; // borrar
    
    // Mostrar el modal de confirmación
    $("#confirmModal").modal("show");
    
    // Función para eliminar el registro si se confirma
    $("#confirmYes").click(function() {
        $.ajax({
            url: "bd/crudColores.php",
            type: "POST",
            dataType: "json",
            data: {opcion: opcion, color_id: color_id},
            success: function(){
                tablaColores.row(fila).remove().draw();
            }
        });
        $("#confirmModal").modal("hide");
    });
    
    // Función para ocultar el modal de confirmación si se cancela
    $("#confirmNo, .close").click(function() {
        $("#confirmModal").modal("hide");
    });
});


    
    
  $("#formColores").submit(function(e){
      e.preventDefault();
      nombre_color = $.trim($("#nombre_color").val());
      $.ajax({
          url:"bd/crudColores.php",
          type: "POST",
          dataType: "json",
          data: {nombre_color:nombre_color,color_id:color_id, opcion:opcion},
          success: function(data){
            console.log(data);
              color_id = data[0].color_id;
              nombre_color = data[0].nombre_color;
              
              
              if(opcion == 1){tablaColores.row.add([color_id,nombre_color]).draw();}
              else{ tablaColores.row(fila).data([color_id,nombre_color]).draw();}
                  
          }   
          
      });
      $("#modalCRUD").modal("hide"); 
  });
    
    
});