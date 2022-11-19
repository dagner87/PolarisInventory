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
					 $('#show_modal').modal('hide');
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




	
