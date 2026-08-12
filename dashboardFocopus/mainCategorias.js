$(document).ready(function(){
   tablaCategorias=$("#tablaCategorias").DataTable({
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
    $("#formCamisetas").trigger("reset");
    categoria_id=null;
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
     categoria_id = parseInt(fila.find('td:eq(0)').text());
     nombre_categoria = fila.find('td:eq(1)').text();
     
    
     $("#nombre_categoria").val(nombre_categoria);

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
    categoria_id = parseInt(fila.find('td:eq(0)').text());
    opcion = 3; // borrar
    
    // Mostrar el modal de confirmación
    $("#confirmModal").modal("show");
    
    // Función para eliminar el registro si se confirma
    $("#confirmYes").click(function() {
        $.ajax({
            url: "bd/crudCategorias.php",
            type: "POST",
            dataType: "json",
            data: {opcion: opcion, categoria_id: categoria_id},
            success: function(){
                tablaCategorias.row(fila).remove().draw();
            }
        });
        $("#confirmModal").modal("hide");
    });
    
    // Función para ocultar el modal de confirmación si se cancela
    $("#confirmNo, .close").click(function() {
        $("#confirmModal").modal("hide");
    });
});
    
  $("#formCategorias").submit(function(e){
      e.preventDefault();
      nombre_categoria = $.trim($("#nombre_categoria").val());
      $.ajax({
          url:"bd/crudCategorias.php",
          type: "POST",
          dataType: "json",
          data: {nombre_categoria:nombre_categoria,categoria_id:categoria_id, opcion:opcion},
          success: function(data){
            console.log(data);
              categoria_id = data[0].categoria_id;
              nombre_categoria = data[0].nombre_categoria;
              
              
              if(opcion == 1){tablaCategorias.row.add([categoria_id,nombre_categoria]).draw();}
              else{ tablaCategorias.row(fila).data([categoria_id,nombre_categoria]).draw();}
                  
          }   
          
      });
      $("#modalCRUD").modal("hide"); 
  });
    
    
});