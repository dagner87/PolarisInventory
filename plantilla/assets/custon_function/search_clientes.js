
	$(document).on("click",".showClientes",function(){
	   var cliente = $('#cliente').val();  
	   $.ajax({
			   type: 'ajax',
			   method: 'post',
			   url: 'buscar_cliente',
			   data: {cliente:cliente},
			   async: false,
			   dataType: 'json',
			   success: function(data){
				  $('#resultado').html(data.nombre_cliente);
				                 
			   },
			   error: function(){
				 alert('No se pudo cargar los datos');
			   }
	    });
	
	});
 
