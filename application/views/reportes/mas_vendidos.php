
  <div class="card-body">
    <h4 class="card-title">Listado de <?= $crud ?></h4>
    <div class="table-responsive m-t-40">
      
        <table id="tbl_contenedora" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Producto </th>
					<th>Genero </th>
					<th>Cantidad </th>	
			
                </tr>
            </thead>
            <tbody id="contenido_tbl">
              
            </tbody>
        </table>
    </div>
  </div>


  <div id="show_modal" class="modal bs-example-modal-lg fade in" 
         tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true" data-backdrop="static" data-keyboard="false">
    
    <!-- /.modal-dialog -->
</div>


 <script src="<?= base_url() ?>plantilla/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
 <script src="<?= base_url() ?>plantilla/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>



  <script>
    $(document).ready(function() {
       load_tabla();
       $('.textarea_editor').wysihtml5();
       
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
            url:"<?php echo base_url(); ?>prod_more_sell",
            method:"get",
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
