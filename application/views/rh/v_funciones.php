
  <div class="card-body">
    <h4 class="card-title">Listado de <?= $crud ?></h4>
    <div class="table-responsive m-t-40">
      <div class="modal-header">
         <button type="button" class="btn btn-info btn-rounded btn-add-emp" data-toggle="modal" 
         data-target="#show_modal">Nueva <?= $crud ?></button>
      </div>
        <table id="tbl_contenedora" class="table table-bordered table-striped">
            <thead>
                <tr>
                   <th>Nombre</th>
                   <th>Descripcion</th>
                   <th>Acción</th>                  
                </tr>
            </thead>
            <tbody id="contenido_tbl">
              
            </tbody>
        </table>
    </div>
  </div>


  <div id="show_modal" class="modal bs-example-modal-lg fade in" 
         tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tituloLabel">Nuevo Objetivo</h4>
                <button type="button" class="close cerrar" data-dismiss="modal"  aria-hidden="true">×</button>
            </div>
          <form id="add_form" action="" method="POST">  
            <div class="modal-body">
                <div class="alert alert-danger"  id="msg-error" style="display: none;"> 
                   <i class="ti-face-sad"></i> 
                   <strong> ¡Importante!</strong>  
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    <div  id="list_errorsA"></div>
                </div> 

                 <input type="hidden" name="camino" id="camino" value="<?= $camino ?>">
                 <input type="hidden" name="id" id="id" value="">
                  <div class="form-body">
                      <div class="row p-t-20">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="control-label">Nombre</label>
                                  <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Escriba el nombre">
                                  <small class="form-control-feedback"> </small> </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="control-label">Descripcion</label>
                                    <textarea class="textarea_editor form-control" id="descripcion" name="descripcion" 
                                              rows="10" placeholder="Descripcion del Objetivo"></textarea>
                                     
                                   </textarea>
                                  
                              </div>
                          </div>
                      </div>
                      
                      
                  </div>
            </div>
            <div class="modal-footer">
                 <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
                 <button type="button" class="btn btn-inverse cerrar" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


 <script src="<?= base_url() ?>plantilla/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
 <script src="<?= base_url() ?>plantilla/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>



  <script>
    $(document).ready(function() {
       load_tabla();
       $('.textarea_editor').wysihtml5();
       
    });

    $('#add_form').submit(function(e) {
      e.preventDefault();
      var url    = '<?php echo base_url() ?>insert_fun';
      var url_up = '<?php echo base_url() ?>update_fun';
      var data = $('#add_form').serialize();
      var camino = $('#camino').val();
      if (camino == 'insertar')
       {
         $.ajax({
                  type: 'ajax',
                  method: 'post',
                  url: url,
                  data: data,
                  dataType: 'json',
                  beforeSend: function() {
                       console.log("enviando....");
                    }
                 })
                  .done(function(data){
                    //console.log(data);
                     if (data.comprobador){
                       $('#show_modal').modal('hide');
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
                        refrescar_tbl(); 

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
         }else{
               console.log("editar");
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url_up,
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        //sweetalert_proceso();
                        console.log("editando....");
                      }
                 })
                  .done(function(data){
                    //console.log(data);
                   if (data.comprobador){
                       $('#show_modal').modal('hide');
                       $("#add_form")[0].reset();
                       $.toast({
                              heading: '<?= $crud ?> Actualizado',
                              text: 'Actualizó correctamente la información.',
                              position: 'top-right',
                              loaderBg: '#ff6849',
                              icon: 'info',
                              hideAfter: 3500,
                              stack: 6
                          });
                       refrescar_tbl(); 
                      } else {
                         $("#msg-error").show();
                         $("#list_errorsA").html(data.validacion);
                        } 
                  })
                  .fail(function(){
                     //sweetalertclickerror();
                  }) 
                  .always(function(){
                   // refrescar_tbl();
                  });
              }          
     });

    $(document).on("click",".btn-add-emp",function(){
      $('#camino').val("insertar");
      $('#tituloLabel').text('Nuevo <?= $crud ?>');        
    });

     $(document).on("click",".cerrar",function(){
      console.log('cancele el modal');
      $('#camino').val();
      $('#tituloLabel').text(''); 
      $("#add_form")[0].reset();       
    });
   
    
    /*----Editar  ----- */

    $(document).on("click",".edit-row-btn", function(){
        $('#tituloLabel').text('Editar <?= $crud ?>');
        $('#show_modal').modal('show');
        var id = $(this).attr('data');
        $('#camino').val("editar");
        $('#id').val(id);
        $.ajax({
                type: 'ajax',
                method: 'get',
                url: '<?php echo base_url() ?>get_fun',
                data: {id: id},
                async: false,
                dataType: 'json',
                success: function(data){
                   $('#nombre').val(data.nombre);
                   $('#descripcion').val(data.descripcion); 
                   $('#descripcion').data("wysihtml5").editor.setValue(data.descripcion);                 
                },
                error: function(){
                  alert('No se pudo cargar los datos');
                }
        });
        
    }); 
   /*-----Eliminar -----*/ 

   $(document).on("click",".eliminar-row-btn", function(){
      var id = $(this).attr('data');
      swal({   
        title: "¿Estás seguro?",   
        text: " El <?= $crud ?> será Eliminará de forma permanente!",   
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
            url: '<?php echo base_url() ?>delete_fun',
            data: {id: id},
            async: false,
            dataType: 'json',
            success: function(data){
              console.log(data);
              if (data.comprobador) {
               swal("Elimiando! ","El <?= $crud ?> ha sido Eliminado.", "success");  
               refrescar_tbl();
             }
           },
           error: function(){
            alert('No se pudo Eliminar');
          }
        }); 
        } else {     
          swal("Cancelado "," <?= $crud ?>  está seguro", "error");   
        } 
      });

  });

    function refrescar_tbl()
    {
       if ($.fn.DataTable.isDataTable('#tbl_contenedora')) {
          table = $('#tbl_contenedora').DataTable();
          table.destroy();
          load_tabla();
          } else {
                 load_tabla();
                 }
    } 
    function load_tabla()
    {
        $.ajax({
            url:"<?php echo base_url(); ?>load_funciones",
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
