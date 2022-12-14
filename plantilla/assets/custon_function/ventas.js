$(function () {
    "use strict";
	console.log("cargando funciones Ventas");

	
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
				url: 'insert_venta',
				data: data,
				dataType: 'json',
				beforeSend: function() {
					 console.log("enviando....");
				  }
			   })
				.done(function(data){
				   if (data.comprobador){
					console.log(data);
					
					 $("#add_form")[0].reset();
					 $("#num_correlativo").html("Nueva venta: #"+data.numero_correlativo);
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
	 }		  
});


$(".select2").select2();
$("#id_producto_entrada").on("change",function(){
   let data = $(this).val();
		  
   var option = $(this).find(':selected')[0];//obtiene el producto seleccionado
   $(option).attr('disabled', 'disabled'); // y lo desabilita para no volverlo a seleccionar

  if (data !='') {
	  console.log(data);
	  infoproducto = data.split("*");
	  
	  html = "<tr>";
	  html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
	  html += "<td><input type='text' name='cantidades[]'  value='"+infoproducto[2]+"' class='cantidades' required data-parsley-minlength="+infoproducto[2]+"></td>";

	  html += "<td><input type='text' name='precios_venta[]' value='' class='cantidades' required data-parsley-minlength='2'></td>";
	  html += "<td><input type='hidden' name='importes[]' value=''><p>0.00</p></td>";
	  html += "<td><button type='button' class='btn btn-danger btn-remove'><span class='fa fa-remove'></span></button></td>";

	  html += "</tr>";
	  $("#tb-entradas tbody").append(html);
	  $("#btn-agregar-entrada").val(null);

  }else{
	  alert("seleccione un producto...");
  }
});


