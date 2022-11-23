$(function () {
    "use strict";
	console.log("cargando funciones custom");
});

$('#add_form').submit(function(e) {
	e.preventDefault();
	//var url    = '<?php echo base_url() ?>insert_entrada';
	var url_up = '<?php echo base_url() ?>update_prod';
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
					 refrescar_tbl(); 
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
  //var base_url    = '<?php echo base_url() ?>adj_entrada';
		
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
		$('.btn-file').addClass('btn btn-danger');
		$('#cargando').html('<i class="fa fa-times-rectangle"> </i>');
		$("#list_errorsA").html(err.responseText.error);//err.responseText.error
		

       
    },
    complete: function() {
        $('.btn-file').addClass('btn btn-success');
		//$("#msg-error").hide();
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
   /*-----Eliminar -----*/ 

   $(document).on("click",".eliminar-row-btn", function(){
	var id = $(this).attr('data');
	swal({   
	  title: "¿Estás seguro?",   
	  text: " El <?= $crud ?> será Eliminará de forma permanente!",   
	  type: "warning",   
	  showCancelButton: true,   
	  confirmButtonColor: "#DD6B55",   
	  confirmButtonText: "¡Sí, Anuladar!",   
	  cancelButtonText: "No, cancelar!",   
	  closeOnConfirm: false,   
	  closeOnCancel: false 
	}, function(isConfirm){   
	  if (isConfirm) {   
		$(this).closest("tr").remove();
		$.ajax({
		  type: 'ajax',
		  method: 'get',
		  url: 'delete_entrada',
		  data: {id: id},
		  async: false,
		  dataType: 'json',
		  success: function(data){
			//console.log(data);
			if (data.comprobador) {
			 swal("Elimiando! ","El <?= $crud ?> ha sido Eliminado.", "success");  
			 refrescar_tbl();
		   }
		 },
		 error: function(){
		  alert('No se pudo Eliminar');
		}
	  }); 
	  } else {     
		swal("Cancelado "," <?= $crud ?>  está seguro", "error");   
	  } 
	});

});






	
