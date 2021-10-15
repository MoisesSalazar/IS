$(document).ready(function() {
var evento_id, opcion;
opcion = 4;
    
tablaUsuarios = $('#tablaUsuarios').DataTable({  
    "ajax":{            
        "url": "bd/crud.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "evento_id"},
        {"data": "titulo"},
        {"data": "descripcion"},
        {"data": "categoria"},
        {"data": "fecha"},
        {"data": "tipo"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
    ]
});

var fila; //captura la fila, para editar o eliminar
//submit para el Alta y Actualización
$('#formUsuarios').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    titulo = $.trim($('#titulo').val());    
    descripcion = $.trim($('#descripcion').val());
    categoria = $.trim($('#categoria').val());    
    fecha = $.trim($('#fecha').val());    
    tipo = $.trim($('#tipo').val());                        
        $.ajax({
          url: "bd/crud.php",
          type: "POST",
          datatype:"json",    
          data:  {evento_id:evento_id, titulo:titulo, descripcion:descripcion, categoria:categoria, fecha:fecha, tipo:tipo, opcion:opcion},    
          success: function(data) {
            tablaUsuarios.ajax.reload(null, false);
           }
        });			        
    $('#modalCRUD').modal('hide');											     			
});
        
 

//para limpiar los campos antes de dar de Alta una Persona
$("#btnNuevo").click(function(){
    opcion = 1; //alta           
    evento_id=null;
    $("#formUsuarios").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta de Usuario");
    $('#modalCRUD').modal('show');	    
});

//Editar        
$(document).on("click", ".btnEditar", function(){		        
    opcion = 2;//editar
    fila = $(this).closest("tr");	        
    evento_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
    titulo = fila.find('td:eq(1)').text();
    descripcion = fila.find('td:eq(2)').text();
    categoria = fila.find('td:eq(3)').text();
    fecha = (fila.find('td:eq(4)').text());
    tipo = (fila.find('td:eq(5)').text());
    
    $("#titulo").val(titulo);
    $("#descripcion").val(descripcion);
    $("#categoria").val(categoria);
    $("#fecha").val(fecha);
    $("#tipo").val(tipo);
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Usuario");		
    $('#modalCRUD').modal('show');		   
});

//Borrar
$(document).on("click", ".btnBorrar", function(){
    fila = $(this);           
    evento_id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
    opcion = 3; //eliminar        
    var respuesta = confirm("¿Está seguro de borrar el registro "+evento_id+"?");                
    if (respuesta) {            
        $.ajax({
          url: "bd/crud.php",
          type: "POST",
          datatype:"json",    
          data:  {opcion:opcion, evento_id:evento_id},    
          success: function() {
              tablaUsuarios.row(fila.parents('tr')).remove().draw();                  
           }
        });	
    }
 });
     
});    