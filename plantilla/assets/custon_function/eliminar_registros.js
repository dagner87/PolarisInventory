$(function () {
    "use strict";
	console.log("cargando funciones custom");
});


  $(document).on("click",".btn-remove", function(){
	$(this).closest("tr").remove();
	//sumar();
});


/*-----Eliminar -----*/ 

$(document).on("click",".eliminar-row-btn",function(){
	var id = $(this).attr('data');
	swal({   
	  title: "¿Estás seguro?",   
	  text: " La entrada será Eliminará de forma permanente!",   
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
			 swal("Elimiando! ","la Entrada ha sido Eliminada.", "success");  
			 refrescar_tbl();
		   }
		 },
		 error: function(){
		  alert('No se pudo Eliminar');
		}
	  }); 
	  } else {     
		swal("Cancelado "," la Entrada  está segura", "error");   
	  } 
	});

});






	
