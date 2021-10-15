$(document).ready(function() {
var actividad_id, opcion;
opcion = 4;
    
tablaUsuarios = $('#tablaUsuarios').DataTable({  
    "ajax":{            
        "url": "bd/crud.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "actividad_id"},
        {"data": "tipo"},
        {"data": "nombre"},
        {"data": "hora"},
        {"data": "fecha"},
        {"data": "expositor"},
        {"data": "ambiente"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
    ]
});

var fila; //captura la fila, para editar o eliminar
//submit para el Alta y Actualización
$('#formUsuarios').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    tipo = $.trim($('#tipo').val());    
    nombre = $.trim($('#nombre').val());
    hora = $.trim($('#hora').val());    
    fecha = $.trim($('#fecha').val());    
    expositor = $.trim($('#expositor').val());
    ambiente = $.trim($('#ambiente').val());                          
        $.ajax({
          url: "bd/crud.php",
          type: "POST",
          datatype:"json",    
          data:  {actividad_id:actividad_id, tipo:tipo, nombre:nombre, hora:hora, fecha:fecha, expositor:expositor ,ambiente:ambiente,opcion:opcion},    
          success: function(data) {
            tablaUsuarios.ajax.reload(null, false);
           }
        });			        
    $('#modalCRUD').modal('hide');											     			
});
        
 

//para limpiar los campos antes de dar de Alta una Persona
$("#btnNuevo").click(function(){
    opcion = 1; //alta           
    actividad_id=null;
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
    actividad_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
    tipo = fila.find('td:eq(1)').text();
    nombre = fila.find('td:eq(2)').text();
    hora = fila.find('td:eq(3)').text();
    fecha = (fila.find('td:eq(4)').text());
    expositor = (fila.find('td:eq(5)').text());
    ambiente = (fila.find('td:eq(6)').text());
    $("#tipo").val(tipo);
    $("#nombre").val(nombre);
    $("#hora").val(hora);
    $("#fecha").val(fecha);
    $("#expositor").val(expositor);
    $("#ambiente").val(ambiente);
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Usuario");		
    $('#modalCRUD').modal('show');		   
});

//Borrar
$(document).on("click", ".btnBorrar", function(){
    fila = $(this);           
    actividad_id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
    opcion = 3; //eliminar        
    var respuesta = confirm("¿Está seguro de borrar el registro "+actividad_id+"?");                
    if (respuesta) {            
        $.ajax({
          url: "bd/crud.php",
          type: "POST",
          datatype:"json",    
          data:  {opcion:opcion, actividad_id:actividad_id},    
          success: function() {
              tablaUsuarios.row(fila.parents('tr')).remove().draw();                  
           }
        });	
    }
 });
     
});    