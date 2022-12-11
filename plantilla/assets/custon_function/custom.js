$(function () {
    "use strict";
	console.log("cargando funciones custom");
	$(".select2").select2();
});

$('#add_form').submit(function(e) {
	e.preventDefault();	
	var data = $('#add_form').serialize();
	var camino = $('#camino').val();
	if (camino == 'insertar')
	 {
	   $.ajax({
				type: 'ajax',
				method: 'post',
				url: 'insert_entrada',
				data: data,
				dataType: 'json',
				beforeSend: function() {
					 console.log("enviando....");
				  }
			   })
				.done(function(data){
				   if (data.comprobador){
					
					 $("#add_form")[0].reset();
					 $.toast({
							heading: '<?= $crud ?> Agregado',
							text: 'Se agregó correctamente la información.',
							position: 'top-right',
							loaderBg: '#ff6849',
							icon: 'success',
							hideAfter: 3500,
							stack: 6
						});
						$('#contenido_tbl').empty(); 

					} else {
					   $("#msg-error").show();
					   $("#list_errorsA").html(data.validacion);

				   } 
				   
				   
				})
				.fail(function(){
				   //sweetalertclickerror();
				   console.log(data);
				}) 
				.always(function(){
				  //refrescar_tbl();
				});
	   }else{
			 console.log("editar");
			  $.ajax({
				  type: 'ajax',
				  method: 'post',
				  url: url_up,
				  data: data,
				  dataType: 'json',
				  beforeSend: function() {
					  //sweetalert_proceso();
					  console.log("editando....");
					}
			   })
				.done(function(data){
				  //console.log(data);
				 if (data.comprobador){
					
					 $("#add_form")[0].reset();
					 $.toast({
							heading: '<?= $crud ?> Actualizado',
							text: 'Actualizó correctamente la información.',
							position: 'top-right',
							loaderBg: '#ff6849',
							icon: 'info',
							hideAfter: 3500,
							stack: 6
						});
					 ocultarErrores(); 
					} else {
					   $("#msg-error").show();
					   $("#list_errorsA").html(data.validacion);
					  } 
				})
				.fail(function(){
				   //sweetalertclickerror();
				}) 
				.always(function(){
				 // refrescar_tbl();
				});
			}          
});

//subir adjunto

$('.btn-file').on("change", function(evt){
	evt.preventDefault();
// declaro la variable formData e instancio el objeto nativo de javascript new FormData
var formData = new FormData(document.getElementById("add_form"));
// iniciar el ajax
$.ajax({
	url: "adj_entrada" ,
	// el metodo para enviar los datos es POST
	type: "POST",
	// colocamos la variable formData para el envio de la imagen
	data: formData,
	cache       : false,
	contentType: false,
	processData: false,
	dataType    : 'JSON',
	beforeSend: function(data)
	{
		
	 $('#cargando').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
	},
	success: function(data)
	{
	 
       $('.btn-file').addClass('btn btn-info');
	   $('#nombre_archivo').val(data.imagen); //agrego el nombre del archivo subido
	   $('#cargando').fadeOut("fast",function(){
	   $('#cargando').html('<i class="fa fa-check"> </i>');
		});
	   $('#cargando').fadeIn("slow");
	},
	error: function(err) { // if error occured			
		$('#msg-error').show();
		$("#list_errorsA").html("El archivo que intenta subir no está permitido");//err.responseText.error
		$('.btn-file').addClass('btn btn-danger');
		$('#cargando').html('<i class="fa fa-times-rectangle"> </i>');
		

       
    },
    complete: function() {
        $('.btn-file').addClass('btn btn-success');		
    },
});

});

function sweetalert_proceso() {
	$('#mensaje_error').html("Procesando");
	$('#mensaje_error').show().fadeIn().delay(5000).fadeOut('slow')
}

function sweetalertclick() {
	$('#mensaje_error').removeClass('alert-warning').addClass('alert-success')
	.show().fadeIn().delay(5000).fadeOut('slow')
	.html("<i class='icon fa fa-thumbs-up'></i>Datos Guardados");

}
function sweetalertclickerror(){
	$('#mensaje_error').html("Ha ocurrido un error");
	$('#mensaje_error').show().fadeIn().delay(5000).fadeOut('slow')
} 

$(document).on("click",".btn-inverse",function(){
	console.log('limpiar formulario');
	ocultarErrores();      
  });


  function ocultarErrores(){

	$("#msg-error").hide();
	$("#list_errorsA").empty();
	$('#tituloLabel').text(''); 
	$("#add_form")[0].reset(); 	
  }


  $(document).on("click",".btn-remove", function(){
	$(this).closest("tr").remove();
	//sumar();
});

















	
