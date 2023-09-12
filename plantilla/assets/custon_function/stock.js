$(function () {
    "use strict";
	console.log("cargando funciones stock");
	load_tabla();
	$('.textarea_editor').wysihtml5();
});




	 $(document).on("change",".stock", function(){
			 let stock = $(this).val();			
			 let data  = $(this).attr("data-id");
			 let  info = data.split("*");
			 console.log(info);
			 let id = info[0];	
			  $('#tituloLabel').text('Producto : '+info[1]);
			  $('#stock-id').val(id);			
			// $("#cantidad").attr("max", stock);
			 $('#stock_ajust').modal('show');
			//console.log(stock);
			//console.log(id);
		 });


		 $('#stock_form').submit(function(e) {
			e.preventDefault();	
			var data = $('#stock_form').serialize();
			
			   $.ajax({
						type: 'ajax',
						method: 'post',
						url: 'update_stock',
						data: data,
						dataType: 'json',
						beforeSend: function() {
							 console.log("enviando....");
						  }
					   })
						.done(function(data){
						   if (data.comprobador){
							console.log(data);							
							 $("#stock_form")[0].reset();
							
							 $.toast({
									heading: 'Ajuste de Stock',
									text: 'Se agregó correctamente la información.',
									position: 'top-right',
									loaderBg: '#ff6849',
									icon: 'success',
									hideAfter: 3500,
									stack: 6
								});
								$('#stock_ajust').hide(); 
								 
		
							} else {
							   //$("#msg-error").show();
							  // $("#list_errorsA").html(data.validacion);
		
						   } 
						   
						   
						})
						.fail(function(){
						   //sweetalertclickerror();
						   console.log(data);
						}) 
						.always(function(){
						  //refrescar_tbl();
						});	 
			 
		});		 
				 



 function refrescar_tbl()
 {
	if ($.fn.DataTable.isDataTable('#tbl_contenedora')) {
	   table = $('#tbl_contenedora').DataTable();
	   table.destroy();
	   console.log("estoy dentro el if");
	   load_tabla();
	   } else {
			console.log("estoy en el else");
		   load_tabla();
		   }
 } 

 
 function load_tabla()
 {
	 $.ajax({
		 url:"lista_stocks",
		 method:"post",
		 success:function(data)
		 {
		  $('#contenido_tbl').html(data);
			var table = $('#tbl_contenedora').DataTable({
			  responsive: true,
			  autoFill: true,
			  //scrollY: 500,
			 // paging: false,
			  language: {
						   "lengthMenu": "Mostrar _MENU_ registros por pagina",
						   "zeroRecords": "No se encontraron resultados en su busqueda",
						   "searchPlaceholder": "Buscar registros",
						   "info": "Mostrando  _START_ al _END_ de un total de  _TOTAL_ registros",
						   "infoEmpty": "No existen registros",
						   "infoFiltered": "(filtrado de un total de _MAX_ registros)",
						   "search": "Buscar:",
						   "paginate": {
										 "first": "Primero",
										 "last": "Último",
										 "next": "Siguiente",
										 "previous": "Anterior"
									   },
				 }
			});
		  
		 }
	 })
 }


















	
