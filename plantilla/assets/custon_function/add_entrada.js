$("#id_producto_entrada").on("change",function(){
	let data = $(this).val();
			//console.log(data);
	var option = $(this).find(':selected')[0];//obtiene el producto seleccionado
	$(option).attr('disabled', 'disabled'); // y lo desabilita para no volverlo a seleccionar

   if (data !='') {
	   infoproducto = data.split("*");
	   html = "<tr>";
	   html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
	   html += "<td><input type='text' name='cantidades[]' value='' class='cantidades' required data-parsley-minlength='2'></td>";

	   html += "<td><input type='text' name='precios_costo[]' value='' class='cantidades' required data-parsley-minlength='2'></td>";
	   html += "<td><input type='hidden' name='importes[]' value=''><p>0.00</p></td>";
	   html += "<td><button type='button' class='btn btn-danger btn-remove'><span class='fa fa-remove'></span></button></td>";

	   html += "</tr>";
	   $("#tb-entradas tbody").append(html);
	   $("#btn-agregar-entrada").val(null);

   }else{
	   alert("seleccione un producto...");
   }
});
