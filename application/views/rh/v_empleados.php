
  <div class="card-body">
    <h4 class="card-title">Listado de <?= $crud ?></h4>
    <div class="table-responsive m-t-40">
      <div class="modal-header">
         <button type="button" class="btn btn-info btn-rounded btn-add-emp" data-toggle="modal" 
         data-target="#show_modal">Nuevo <?= $crud ?></button>
      </div>
        <table id="tbl_contenedora" class="table table-bordered table-striped">
            <thead>
                <tr>
                   <th>Nombre</th>
                   <th>Apellidos</th>
                   <th>DNI</th>
                   <th>Area</th>
                   <th>Cargo</th>
                   <th>fecha Ingreso</th>                  
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
                <h4 class="modal-title" id="tituloLabel">Nuevo Empleado</h4>
                <button type="button" class="close cerrar" data-dismiss="modal"  aria-hidden="true">×</button>
            </div>
          <form id="add_emp" action="<?php echo base_url() ?>empleado/insert_emp" method="POST">  
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
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="control-label">Nombre</label>
                                  <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Escriba el nombre">
                                  <small class="form-control-feedback"> </small> </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="control-label">Apellidos</label>
                                  <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Escriba el apellido">
                                  <small class="form-control-feedback"> </small> 
                              </div>
                          </div>
                      </div>
                      <!--/row-->
                      <div class="row">

                        <div class="col-md-6">
                              <div class="form-group">
                                  <label class="control-label">DNI</label>
                                  <input type="text" id="dni" name="dni" class="form-control" placeholder="Escriba dni">
                                  <small class="form-control-feedback"> </small> </div>
                          </div>
                        
                          <!--/span-->
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="control-label">Fecha Inicio</label>
                                  <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" placeholder="dd/mm/yyyy">
                              </div>
                          </div>
                          <!--/span-->
                      </div>
                      <!--/row-->
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="control-label">Area</label>
                                  <select class="form-control custom-select" id="id_area"  name="area"  data-placeholder="Choose a Category" tabindex="1">
                                     <?php if(!empty($areas))
                                      {
                                        $select = "";
                                        foreach($areas as $row):
                                           echo '<option value="'.$row->id.'">'.$row->descripcion.'</option>';
                                        endforeach;
                                      } ?>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="control-label">Cargo</label>
                                  <select class="form-control custom-select" id='id_cargo'  name="cargo" data-placeholder="Seleccione Cargo" tabindex="1">
                                      <option value="" style="color:red" disabled selected>Seleccione Cargo *</option >
                                     
                                  </select>
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



  <script>
    $(document).ready(function() {
       load_Emp();
       
    });

    $('#add_emp').submit(function(e) {
      e.preventDefault();
      var url    = '<?php echo base_url() ?>empleado/insert_emp';
      var url_up = '<?php echo base_url() ?>empleado/update_emp';
      var data = $('#add_emp').serialize();
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
                       $("#add_emp")[0].reset();
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
                       $("#add_emp")[0].reset();
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
      $('#tituloLabel').text('Nuevo Empleado');        
    });

     $(document).on("click",".cerrar",function(){
      console.log('cancele el modal');
      $('#camino').val();
      $('#tituloLabel').text(''); 
      $("#add_emp")[0].reset();       
    });
   
    $(document).on("change","#id_area",function(){
        id_area = $(this).val();
        console.log(id_area);
        $.ajax({
              type: 'ajax',
              method: 'get',
              url: '<?php echo base_url() ?>empleado/getCargoArea',
              data: {id_area:id_area},
              async: false,
              dataType: 'json',
            success: function(data){
                console.log(data);
                var html = '';
                var i;
                var dataProducto ='';
                html +='<option value="" style="color:red" disabled selected>Seleccione Cargo *</option >';
                for(i=0; i<data.length; i++){
                    html +='<option value="'+data[i].id+'"</option>'+data[i].nombre+'</option>';
                  }
                $('#id_cargo').html(html);
            },
            error: function(){
                 alert('No hay datos que mostrar');
              }
        });
    });
    /*----Editar  ----- */

    $(document).on("click",".edit-row-btn", function(){
        $('#tituloLabel').text('Editar Empleado');
        $('#show_modal').modal('show');
        var id = $(this).attr('data');
        $('#camino').val("editar");
        $('#id').val(id);
        $.ajax({
                type: 'ajax',
                method: 'get',
                url: '<?php echo base_url() ?>empleado/getdatos_emp',
                data: {id: id},
                async: false,
                dataType: 'json',
                success: function(data){
                   $('#nombre').val(data.datos_emp.nombre);
                   $('#apellidos').val(data.datos_emp.apellidos);
                   $('#dni').val(data.datos_emp.dni);
                   $('#fecha_ingreso').val(data.datos_emp.fecha_ingreso);
                   $('select[name=id_area]').val(data.datos_emp.id_area).attr('selected','selected');
                   //armo el select dependiente
                    select(data);
                },
                error: function(){
                  alert('No se pudo cargar los datos');
                }
        });
        
    }); 

    function select(data)
    {
      var html = '';
      var i;
      var datos = data.datos_cargos;
     // console.log(data);
      html +='<option value="" style="color:red" disabled selected>Seleccione Cargo *</option >';
      for(i = 0; i < datos.length; i++){
         if (data.datos_emp.id_cargo == datos[i].id) {
             html +='<option value="'+datos[i].id+'" selected>'+datos[i].nombre+'</option>';
            }
            html +='<option value="'+datos[i].id+'"</option>'+datos[i].nombre+'</option>';
        }
      $('#id_cargo').html(html);
    }


   /*-----Eliminar -----*/ 

   $(document).on("click",".eliminar-row-btn", function(){
      var id = $(this).attr('data');
      swal({   
        title: "¿Estás seguro?",   
        text: "La venta será Eliminará de forma permanente!",   
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
            url: '<?php echo base_url() ?>empleado/delete_emp',
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
          console.log("estoy dentro el if");
          load_Emp();
          } else {
               console.log("estoy en el else");
              load_Emp();
              }
    } 
    function load_Emp()
    {
        $.ajax({
            url:"<?php echo base_url(); ?>empleado/load_empleados",
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
