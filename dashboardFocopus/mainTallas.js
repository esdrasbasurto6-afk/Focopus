$(document).ready(function(){
   tablaTallas=$("#tablaTallas").DataTable({
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
    $("#formTallas").trigger("reset");
    talla_id=null;
    opcion = 1; //alta
    
    //estilo
    $(".modal-header").css("background-color", "green");
    $(".modal-title").text("Nueva Talla");
    $(".modal-header").css("color","white");
    $("#modalCRUD").modal("show");
    
    
});
    

    var fila;//capturar para editar o borrar el registro
    
//EDITAR BOTON
 $(document).on("click",".btnEditar", function(){
     fila = $(this).closest("tr");
     talla_id = parseInt(fila.find('td:eq(0)').text());
     nombre_talla = fila.find('td:eq(1)').text();
     
    
     $("#nombre_talla").val(nombre_talla);

     opcion = 2; //Modificar  
     
     //estilo
    $(".modal-header").css("background-color", "purple");
    $(".modal-title").text("Editar Talla");
    $(".modal-header").css("color","white");
    $("#modalCRUD").modal("show");
     
 });
    
// ELIMINAR BOTON
$(document).on("click", ".btnBorrar", function(){
    fila = $(this).closest("tr");
    talla_id = parseInt(fila.find('td:eq(0)').text());
    opcion = 3; // borrar
    
    // Mostrar el modal de confirmación
    $("#confirmModal").modal("show");
});

// Función para eliminar el registro si se confirma
$("#confirmYes").click(function() {
    $.ajax({
        url: "bd/crudTallas.php",
        type: "POST",
        dataType: "json",
        data: {opcion: opcion, talla_id: talla_id},
        success: function(){
            tablaTallas.row(fila).remove().draw();
        }
    });
    $("#confirmModal").modal("hide");
});

// Función para ocultar el modal de confirmación si se cancela
$("#confirmNo, .close").click(function() {
    $("#confirmModal").modal("hide");
});
    
    
  $("#formTallas").submit(function(e){
      e.preventDefault();
      nombre_talla = $.trim($("#nombre_talla").val());
      $.ajax({
          url:"bd/crudTallas.php",
          type: "POST",
          dataType: "json",
          data: {nombre_talla:nombre_talla,talla_id:talla_id, opcion:opcion},
          success: function(data){
            console.log(data);
              talla_id = data[0].talla_id;
              nombre_talla = data[0].nombre_talla;
              
              
              if(opcion == 1){tablaTallas.row.add([talla_id,nombre_talla]).draw();}
              else{ tablaTallas.row(fila).data([talla_id,nombre_talla]).draw();}
                  
          }   
          
      });
      $("#modalCRUD").modal("hide"); 
  });
    
    
}); 
