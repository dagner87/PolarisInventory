 <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
               
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-body">
                                <select class="custom-select pull-right" id="id_area" name="id_area">
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
                                <h4 class="card-title">Empleados por Area</h4>
                                <div class="table-responsive m-t-20">
                                    <table class="table stylish-table" id="tbla">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Nombre y Cargo</th>
                                                <th>DNI</th>
                                                <th>Area</th>
                                                <th>Fecha Ingreso</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->

<!-- ======================Objetivo======================================== -->
<div id="obj_modal" class="modal bs-example-modal-lg fade in" 
         tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tituloLabel">Nuevo Objetivo</h4>
                <button type="button" class="close cerrar" data-dismiss="modal"  aria-hidden="true">×</button>
            </div>
          <form id="add_obj" action="" method="POST">  
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

<!-- =======================/Objetivo======================================= -->

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
                <div class="alert alert-danger"  id="msg-error" style="display: none;"> 
                   <i class="ti-face-sad"></i> 
                   <strong> ¡Importante!</strong>  
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    <div  id="list_errorsA"></div>
                </div>               
                  <div class="form-body">
                    <div class="row">
                          <div class="col-md-12">
                            <div class="card-body p-b-0">
                                
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs customtab2" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Objetivos</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Competencias</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages7" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Resumen</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content slimtest2">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                        <div class="p-20">


                                        <!-- Accordian -->
                                        <div id="accordion" class="nav-accordion " role="tablist" aria-multiselectable="true">
                                           
                                        
                                        </div>
                                    
                                        </div>
                                    </div>
                                    <div class="tab-pane  p-20" id="profile7" role="tabpanel">2</div>
                                    <div class="tab-pane p-20" id="messages7" role="tabpanel">3</div>
                                </div>
                            </div>
                              
                          </div>
                       </div>
                     
                      <!--/row-->
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



<div id="show_objmodal" class="modal bs-example-modal-lg fade in" 
         tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true" data-backdrop="static" data-keyboard="false">
       <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tituloObj">Objetivos</h4>
                <button type="button" class="close cerrar" data-dismiss="modal"  aria-hidden="true">×</button>
            </div>
               <input type="hidden" name="id_emp" id="id_emp">
            <div class="modal-body">
                <div class="alert alert-danger"  id="msg-error" style="display: none;"> 
                   <i class="ti-face-sad"></i> 
                   <strong> ¡Importante!</strong>  
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    <div  id="list_errorsA"></div>
                </div>               
                  <div class="form-body">
                    <div class="row">
                          <div class="col-md-12">
                             <button type="button" class="btn btn-info btn-rounded btn-new-obj" data-toggle="modal" 
                                     data-target="#obj_modal">Nuevo Objetivo
                            </button>
                            <table class="table stylish-table" id="tbla_obj">
                                <thead>
                                    <tr>
                                        <th>Accion</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                           
                          </div>
                       </div>
                     
                      <!--/row-->
                  </div>
            </div>
            <div class="modal-footer">
                 <button type="button"  id="btn-save-asoc_obj" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
                 <button type="button" class="btn btn-inverse cerrar" data-dismiss="modal">Cancelar</button>
            </div>
        
        </div>
        <!-- /.modal-content -->
      </div>
    <!-- /.modal-dialog -->
</div>

</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->

<script src="<?php echo base_url() ?>plantilla/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url() ?>plantilla/js/jquery.slimscroll.js"></script>
    <script type="text/javascript">
        

         $(document).ready(function() {
          var id = $('#id_area').val();
            load_emp_a(id);
            load_obj();

            $('.slimtest1').slimScroll({
                height: '250px'
            });

            $('.slimtest2').slimScroll({
                height: '600px'
            });


             $("input[name='evaluacion[]']").TouchSpin({
                min: 0,
                max: 100,
                step: 5,
                decimals: 0,
                boostat: 5,
                maxboostedstep: 5,
                postfix: '%'
            });

            $("input[name='ponderacion[]']").TouchSpin({
                min: 0,
                max: 100,
                step: 5,
                decimals: 0,
                boostat: 5,
                maxboostedstep: 5,
                postfix: '%'
            }); 

         });

        $(document).on("change","#id_area",function(){
            id = $(this).val();
            console.log(id);
            load_emp_a(id);
        });


/*-----------INSERTAR OBJETIVO ------------*/
      $('#add_obj').submit(function(e) {
        e.preventDefault();
        var url    = '<?php echo base_url() ?>insert_obj';
        var data = $('#add_obj').serialize();
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
           }    
      });

/*----------------/ INSERTAR OBJETIVO---------------------*/

        $(document).on("click",".eva-row-btn", function(){
            $('#show_modal').modal('show');
            var data = $(this).attr('data');
                info = data.split("*");
            $('#tituloLabel').text('Evaluar a '+info[1]+' '+info[2]);
             $.ajax({
                url:"<?php echo base_url(); ?>get_obj_emp",
                method:"get",
                data: {id:info[0]},
                success:function(data)
                {
                  console.log(data); 
                 $('#accordion').html(data);
                }
            })
        }); 

      $(document).on("click",".obj-row-btn", function(){
            $('#show_objmodal').modal('show');
            var data = $(this).attr('data');
                info = data.split("*");
            $('#tituloObj').text('Asociar Objetivos a '+info[1]+' '+info[2]);
            $('#id_emp').val(info[0]);
            load_obj(info[0]);
        }); 

      $(document).on("click",".item-select",function(){
         data = [];
         $('.item-select').each(function(){
             var chk = $(this);
            if(chk.prop('checked')){
             data.push(chk.val());
          
          }
        });
          console.log(data);
             
      });


      $(document).on("click","#btn-save-asoc_obj",function(){
          var id_emp =  $('#id_emp').val();
          var url_c    ='<?php echo base_url() ?>asoc_obj';
          console.log(data);
            if(data.length > 0) {
                 $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url_c,
                    data: {id_emp:id_emp,obj:data},
                    dataType: 'json',
                    beforeSend: function() {
                         console.log("asociando....");
                    }
                 })
                  .done(function(data){
                    console.log(data);
                    if (data.comprobador){
                       $('#show_objmodal').modal('hide');
                              $.toast({
                                  heading: 'Objetivo Asociado',
                                  text: 'Se agregó correctamente la información.',
                                  position: 'top-right',
                                  loaderBg: '#ff6849',
                                  icon: 'success',
                                  hideAfter: 3500,
                                  stack: 6
                              });
                             //load_emp_a();  
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
   

        function load_emp_a(id)
        {
           $.ajax({
                url:"<?php echo base_url(); ?>load_emp_a",
                method:"get",
                data: {id:id},
                success:function(data)
                {
                 $('#tbla tbody').html(data);
                }
            })
        }

       function load_obj(id)
        {
           $('#tbla_obj tbody').empty();
           $.ajax({
                url:"<?php echo base_url(); ?>load_emp_obj",
                method:"get",
                data: {id:id},
                success:function(data)
                {
                 $('#tbla_obj tbody').html(data);
                }
            })
        }



    </script>


