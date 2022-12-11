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
