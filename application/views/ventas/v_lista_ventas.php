
  <div class="card-body">
    <h4 class="card-title">Listado de <?= $crud ?></h4>
    <div class="table-responsive m-t-40">
      <div class="modal-header">
        <!--  -->
      </div>
        <table id="tbl_contenedora" class="table table-bordered table-striped">
            <thead>
                <tr>
             		<th>Fecha</th>
					<th>Cliente</th>
					<th>Medio de Pago</th>
					<th>Total </th>
					<th>Detalle </th>
					<th>Acción</th>                  
                </tr>
            </thead>
            <tbody id="contenido_tbl">
              
            </tbody>
        </table>
    </div>
  </div>



	<script src="<?php echo base_url();?>plantilla/assets/custon_function/eliminar_registros.js"></script>

  <script>
    $(document).ready(function() {
		
			load_tabla();	
       
    });

   

	$(document).on("click",".cerrar",function(){
		console.log('cancele el modal');
				$("#msg-error").hide();
				$("#list_errorsA").empty();
		$('#camino').val();
		$('#tituloLabel').text(''); 
		$("#add_form")[0].reset();       
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
            url:"<?php echo base_url(); ?>get_ventas",
            method:"post",
            success:function(data)
            {
             $('#contenido_tbl').html(data);
               var table = $('#tbl_contenedora').DataTable({
                 responsive: true,
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

	$(document).on("click",".anular-row-btn",function(){
		var id = $(this).attr('data');
		console.log("anular venta", id);
	swal({   
	  title: "¿Estás seguro?",   
	  text: " La Venta será Eliminada de forma permanente!",   
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
		  url: 'anular_venta',
		  data: {id: id},
		  async: false,
		  dataType: 'json',
		  success: function(data){
			//console.log(data);
			if (data.comprobador) {
			 swal("Elimiando! ","la Venta ha sido Eliminada.", "success");  
			 refrescar_tbl();
		   }
		 },
		 error: function(){
		  alert('No se pudo Eliminar');
		}
	  }); 
	  } else {     
		swal("Cancelado "," la Venta  está segura", "error");   
	  } 
	});

});


</script>
