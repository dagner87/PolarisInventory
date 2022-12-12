$(function () {
    "use strict";
	console.log("cargando funciones Detalle Ventas");	
});


$(document).on("click",".btn-detalle",function(){	
	var data = $(this).attr('data');
        info = data.split("*");
         $('#tituloLabel').text('Cliente: '+info[1]);	
		$('#show_modal').modal('show');		
		   $.ajax({
		   url:"view_detalleV",
		   method:"get",
		   data: {id:info[0]},
		   success:function(data)
		   {
			 //console.log(data); 
			$('#tbl-detalle').html(data);
		   }
	   })

});







