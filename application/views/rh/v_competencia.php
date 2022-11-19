
  <div class="card-body">
    <h4 class="card-title">Listado de <?= $crud ?></h4>
    <div class="table-responsive m-t-40">

      <div class="button-group">
        <button type="button" class="btn waves-effect waves-light btn-rounded  btn-info btn-success btn-add-emp" data-toggle="modal" data-target="#show_modal">Nueva <?= $crud ?></button>
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
                <h4 class="modal-title" id="tituloLabel"></h4>
                <button type="button" class="close cerrar" data-dismiss="modal"  aria-hidden="true">×</button>
            </div>
          <form id="add_form" action="" method="POST">  
            <div class="modal-body">
                <div class="alert alert-danger"  id="msg-errorc" style="display: none;"> 
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
<!-- modal-dialog -->
  <div id="j_are_modal" class="modal bs-example-modal-lg fade in" 
         tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Definir Jefe Area</h4>
                    <button type="button" class="close cerrar" data-dismiss="modal"  aria-hidden="true">×</button>
                </div>
              <form id="asoc_jefearea" action="" method="POST">  
                 <input type="hidden" name="camino_asoc" id="camino_asoc" value="">
                 <input type="hidden" name="id_asocJa" id="id_asocJa" value="">
                <div class="modal-body">
                    <div class="alert alert-danger"  id="msg-error1" style="display: none;"> 
                       <i class="ti-face-sad"></i> 
                       <strong> ¡Importante!</strong>  
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        <div  id="list_errorsAsociar"></div>
                    </div> 
                      <div class="form-body">
                          <div class="row p-t-20">
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Area</label>
                                        <select class="form-control custom-select" id="id_area" name="id_area" 
                                        data-placeholder="Seleccione Area" tabindex="1">
                                         <option value="" style="color:red" disabled selected>Seleccione Area *</option >
                                        <?php if(!empty($areas))
                                                {
                                                  foreach($areas as $row):
                                                  ?>  
                                                  <option value="<?= $row->id ?>">
                                                    <?= $row->descripcion ?></option>

                                                 <?php  
                                                    endforeach;  
                                                }
                                                 ?>
                                            
                                          
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Jefe de Area</label>
                                        <select class="form-control custom-select" id="id_jefe" name="id_jefe" 
                                          data-placeholder="Seleccione Jefe de Area" tabindex="1">
                                           <option value="" style="color:red" disabled selected>Seleccione Jefe de Area*</option >
                                            <?php if(!empty($empleados))
                                                {
                                                  foreach($empleados as $row):
                                                  ?>  
                                                  <option value="<?= $row->id ?>">
                                                    <?= $row->nombre.' '.$row->apellidos  ?></option>

                                                 <?php  
                                                    endforeach;  
                                                }
                                                 ?>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                             <!--/row-->
                          </div>
                          <div class="row">
                               <div class="col-lg-12">
                                 <table id="tbl-jare" class="table table-bordered table-striped table-hover">
                                  <thead>
                                      <tr>
                                          <th>Area</th>
                                          <th>Jefe</th>
                                          <th>Accion</th>
                                      </tr>
                                  </thead>
                                  <tbody id="contenido_jare">
                                    <tr id="mensaje_tbl">
                                        <td colspan="3"> 
                                        <div class="alert alert-warning">No hay ningun registro seleccionado</div>
                                        </td>
                                     
                                    </tr>
                                 
                                  </tbody>
                              </table>
                            </div>   
                            </div>
                      </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
                     <button type="button" class="btn btn-inverse cerrar_tbl" data-dismiss="modal">Cancelar</button>
                </div>
              </form>



            </div>
            <!-- /.modal-content -->
        </div>
       
  </div>
 <!-- /.modal-dialog -->




 <script src="<?= base_url() ?>plantilla/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
 <script src="<?= base_url() ?>plantilla/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
 <script src="<?= base_url() ?>plantilla/assets/plugins/tinymce/tinymce.min.js"></script>



  <script>
    $(document).ready(function() {
       load_tabla();
       $('.textarea_editor').wysihtml5();
       
    });

    $('#add_form').submit(function(e) {
      e.preventDefault();
      var url    = '<?php echo base_url() ?>insert_comp';
      var url_up = '<?php echo base_url() ?>update_comp';
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
                       //$('#show_modal').modal('hide');
                       $("#add_form")[0].reset();
                       $('#msg-errorc').hide().fadeOut('slow');
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
                         $("#msg-errorc").show();
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
      $('#tituloLabel').text('Nueva <?= $crud ?>');        
    });

     $(document).on("click",".cerrar",function(){
      console.log('cancele el modal');
      $('#camino').val();
      $('#tituloLabel').text(''); 
      $("#add_form")[0].reset();       
    });

     $(document).on("click",".cerrar_tbl",function(){
      console.log('cancele el modal');
      var html ='<td colspan="3"><div class="alert alert-warning">No hay ningún registro seleccionado</div></td>';
     $("#contenido_jare").html(html);       
    });

    $("#id_area").on("change",function(){
       var option  = $(this).find(':selected')[0];//obtiene el producto seleccionado
       $(this).find('select :first').attr("disabled",'true');
       $(this).attr("required", "true");
       $(option).attr('disabled', 'disabled'); // y lo desabilita para no volverlo a seleccionar 
    }); 

     $('#asoc_jefearea').submit(function(e) {
            e.preventDefault();
            var url = '<?php echo base_url() ?>asoc_jefearea';
            var data = $('#asoc_jefearea').serialize();
           // var camino_asoc = $('#camino_asoc').val();
            var camino_asoc = 'insertar';
            if (camino_asoc == 'insertar')
               {
                console.log("insertar");

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
                             if (data.comprobador){
                                  console.log(data.comprobador);
                                /* $('#insetprodModal').modal('hide');
                                   $('#existencia').removeClass('has-error');
                                   $('#id_producto').removeClass('has-error');

                                  $.toast({
                                      heading: 'Producto Agregado',
                                      text: 'Se agregó corectamente la información.',
                                      position: 'top-right',
                                      loaderBg: '#ff6849',
                                      icon: 'success',
                                      hideAfter: 3500,
                                      stack: 6
                                  });
                                */
                                refrescar_tbl();
                                }else {
                                   console.log(data.comprobador);
                                  //$('#mensaje').show().fadeIn().delay(5000).fadeOut('slow');
                                }
                             
                          })
                          .fail(function(){
                           
                          }) 
                          .always(function(){
                           
                          });


               }


         
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
                url: '<?php echo base_url() ?>get_comp',
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
            url: '<?php echo base_url() ?>delete_comp',
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


   $("#id_jefe").on("change",function(){
         $(this).find('select :first').attr("disabled",'true');
         $(this).attr("required", "true");
         var id_jefe = $(this).val();
         var id_area = $('select[name="id_area"] option:selected').val();
         console.log(id_jefe);
         var option       = $(this).find(':selected')[0];//obtiene el producto seleccionado
         var nombreArea   =  $('select[name="id_area"] option:selected').text();
         var nombreJefe   =  $('select[name="id_jefe"] option:selected').text();
         $(option).attr('disabled', 'disabled'); // y lo desabilita para no volverlo a seleccionar
        if (id_jefe !='') {
            html = "<tr>";
            html += "<td><input type='hidden' name='idareas[]' value='"+id_area+"'>"+nombreArea+"</td>";
            html += "<td><input type='hidden' name='idjefes[]' value='"+id_jefe+"'>"+nombreJefe+"</td>";
            html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>";
            html += "</tr>";
            
            $("#mensaje_tbl").closest("tr").remove();
            $("#contenido_jare").append(html);
           
          }else{
            alert("seleccione un un jefe de Area...");
          }
    });

   $(document).on("click",".btn-remove-producto", function(){
        $(this).closest("tr").remove();
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
            url:"<?php echo base_url(); ?>load_comp",
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
