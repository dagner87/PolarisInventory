
  <style>
		.modal-lg {
    max-width: 80% !important;
    max-height: 100vh;
		heigth: 90%;
}
	</style>
	
	
	
	
	<div class="card-body">
    <h4 class="card-title">Listado de <?= $crud ?></h4>
    <div class="table-responsive m-t-40">
      <div class="modal-header">
        <!--  -->
      </div>
        <table id="tbl_contenedora" class="table table-bordered table-striped">
            <thead>
                <tr>
              		<th>Fecha entrada </th>
									<th>#Factura Provedor</th>							
									<th>Proveedor</th>
									<th>Total</th>							
									<th>Doc Respaldo </th>
									<th>Acción</th>                  
                </tr>
            </thead>
            <tbody id="contenido_tbl">
              
            </tbody>
        </table>
    </div>
  </div>



	 <!-- sample modal content -->
	 <div id="show_modal" class="modal fade bs-example-modal-lg"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg">
					<div class="modal-content">
							<div class="modal-header">
									<h4 class="modal-title" id="tituloLabel">Factura de Proveedor </h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
							<iframe style="width: 100%; height: 450px;"  class="frame" id="frame" src=""></iframe>
							</div>
							<div class="modal-footer">
									<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
							</div>
					</div>
					<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
	</div>
	</div>	
	<!-- /.modal -->



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


		$(document).on("click",".attach",function(){
     let  doc_respaldo =  $(this).attr('data');
		   console.log(doc_respaldo);
		   $("#show_modal").modal('show');
		   $("#frame").attr("src", "assets/respaldos/"+doc_respaldo);			
			
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
            url:"<?php echo base_url(); ?>get_entradas",
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


</script>
