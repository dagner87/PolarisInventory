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


$(document).on("click",".btn-remove", function(){
	$(this).closest("tr").remove();
	sumar_venta();
});


$(document).on("keyup","#contenido_tbl input.cantidades", function(){
	//let cantidad = $(this).val();
	let cantidad = $(this).closest("tr").find("td:eq(1)").children("input").val();
	let precio = $(this).closest("tr").find("td:eq(2)").children("input").val();
	let importe = cantidad * precio;
	console.log({cantidad}, "*" ,{precio});
	$(this).closest("tr").find("td:eq(3)").children("p").text(importe.toFixed(2));
	$(this).closest("tr").find("td:eq(3)").children("input").val(importe.toFixed(2));
	sumar_venta();
});

function sumar_venta(){
	total = 0;
	$("tbody tr").each(function(){
		total = total + Number($(this).find("td:eq(3)").text());
	});
	$("input[name=total]").val(total.toFixed(2));
} 
