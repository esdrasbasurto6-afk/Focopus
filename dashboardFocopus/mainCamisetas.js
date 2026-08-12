$(document).ready(function(){
    tablaCamiseta=$("#tablaCamiseta").DataTable({
     "columnDefs":[{
         "targets": -1,
         "data":null,
         "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarCamiseta'>Editar</button><button class='btn btn-danger btnBorrarCamiseta'>Borrar</button></div></div>"  
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
     
 $("#btnNuevoCamiseta").click(function(){
     $("#formCamisetas").trigger("reset");
     camiseta_id=null;
     opcion = 1; //alta
     
     //estilo
     $(".modal-header").css("background-color", "green");
     $(".modal-title").text("Nueva Camisa");
     $(".modal-header").css("color","white");
     $("#modalCRUDCamiseta").modal("show");
 });
     
 
     var fila;//capturar para editar o borrar el registro
     
 //EDITAR BOTON
  $(document).on("click",".btnEditarCamiseta", function(){
      fila = $(this).closest("tr");
      camiseta_id = parseInt(fila.find('td:eq(0)').text());
      nombre = fila.find('td:eq(1)').text();
      precio = parseInt(fila.find('td:eq(2)').text());
      categoria_id = parseInt(fila.find('td:eq(3)').text());
      imagen = fila.find('td:eq(4)').text();
      Descripcion = fila.find('td:eq(5)').text();
     
      $("#nombre").val(nombre);
      $("#precio").val(precio);
      $("#categoria_id").val(categoria_id);
      $("#imagen").val(imagen);
      $("#Descripcion").val(Descripcion);
 
      opcion = 2; //Modificar  
      
      //estilo
     $(".modal-header").css("background-color", "purple");
     $(".modal-title").text("Editar Camisa");
     $(".modal-header").css("color","white");
     $("#modalCRUDCamiseta").modal("show");
  });
     
 // ELIMINAR BOTON
 $(document).on("click", ".btnBorrarCamiseta", function(){
     fila = $(this).closest("tr");
     camiseta_id = parseInt(fila.find('td:eq(0)').text());
     opcion = 3; // borrar
     
     // Mostrar el modal de confirmación
     $("#confirmModalCamiseta").modal("show");
     
     // Función para eliminar el registro si se confirma
     $("#confirmYesCamiseta").click(function() {
         $.ajax({
             url: "bd/crudCamisetas.php",
             type: "POST",
             dataType: "json",
             data: {opcion: opcion, camiseta_id: camiseta_id},
             success: function(){
                 tablaCamiseta.row(fila).remove().draw();
             }
         });
         $("#confirmModalCamiseta").modal("hide");
     });
     
     // Función para ocultar el modal de confirmación si se cancela
     $("#confirmNoCamiseta, .close").click(function() {
         $("#confirmModalCamiseta").modal("hide");
     });
 });
 
 $("#formCamisetas").submit(function(e){
       e.preventDefault();
       nombre = $.trim($("#nombre").val());
       precio = $.trim($("#precio").val());
       imagen = $.trim($("#imagen").val());
       Descripcion = $.trim($("#Descripcion").val());
       categoria_id = $("#categoria_id").val();
       $.ajax({
           url:"bd/crudCamisetas.php",
           type: "POST",
           dataType: "json",
           data: {nombre:nombre, precio:precio, categoria_id:categoria_id, imagen:imagen, Descripcion:Descripcion, camiseta_id:camiseta_id, opcion:opcion},
           success: function(data){
             console.log(data);
               camiseta_id = data[0].camiseta_id;
               nombre = data[0].nombre;
               precio = data[0].precio;
               categoria_id = data[0].categoria_id;
               imagen= data[0].imagen;
               Descripcion= data[0].Descripcion;
               
               if(opcion == 1){tablaCamiseta.row.add([camiseta_id,nombre,precio,categoria_id,imagen,Descripcion]).draw();}
               else{ tablaCamiseta.row(fila).data([camiseta_id,nombre,precio,categoria_id,imagen,Descripcion]).draw();}
                   
           }   
       });
       $("#modalCRUDCamiseta").modal("hide"); 
 });
 });
 