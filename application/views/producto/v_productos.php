
  <div class="card-body">
    <h4 class="card-title">Listado de <?= $crud ?></h4>
    <div class="table-responsive m-t-40">
      <div class="modal-header">
         <button type="button" class="btn btn-info btn-rounded btn-add-new" data-toggle="modal" 
         data-target="#show_modal">Nuevo <?= $crud ?></button>
      </div>
        <table id="tbl_contenedora" class="table table-bordered table-striped">
            <thead>
                <tr>
                   <th>Nombre</th>	
									 <th>Peso Neto </th>
									 <th>Estado </th>
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
        <div class="modal-content ">
            <div class="modal-header ">
                <h4 class="modal-title" id="tituloLabel"></h4>
                <button type="button" class="close cerrar" data-dismiss="modal"  aria-hidden="true">×</button>
            </div>
          <form id="add_form" enctype="multipart/form-data"  method="POST">  
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
							     
												<!--/categoria-->
												<div class="col-md-6">
														<div class="form-group">
																<label class="control-label">Categoría</label>
																<select class="form-control custom-select" custom-select" id="categoria"  name="categoria"
                                          data-placeholder="Seleccione Categoria" tabindex="1">
                                       <option value="" style="color:red" disabled selected>Seleccione Categoria *</option >
																			 <?php if(!empty($categorias))
                                      {
                                        $select = "";
                                        foreach($categorias as $row):
                                           echo '<option value="'.$row->id.'">'.$row->nombre.'</option>';
                                        endforeach;
                                      } ?>
																</select>
														</div>
												</div>												
												<!--/categoria-->
											
												<div class="col-md-6">
														<div id="" class="form-group ">
																<label class="control-label">Nombre Producto</label>
																<input type="text" id="nombre_producto" name="nombre_producto" class="form-control" placeholder="Nombre producto">
																<small class="form-control-feedback"> </small> </div>
												</div>
												
												
												<!-- Peso -->
												<div class="col-md-6">
														<div id="" class="form-group ">
																<label class="control-label">Peso (Lb)</label>
																<input type="number" step="any" min="0" value="1" name="peso_neto"  id="peso_neto" class="form-control" placeholder="Peso en lb">
																<small class="form-control-feedback"> </small> 
														</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
															<label class="control-label">Genero</label>
															<select name="genero" class="form-control custom-select" data-placeholder="Seleccione Genero" tabindex="1">
																	<option value="hombre">Hombre</option>
																	<option value="mujer">Mujer</option>
																	<option value="unisex">Unisex</option>                                                       
															</select>
													</div>
                        </div>
											<!--/Estado-->
												<div class="col-md-6">
														<div class="form-group">
																<label class="control-label">Estado</label>
																<div class="form-check">
																		<label class="custom-control custom-radio">
																				<input id="activo" name="estado" type="radio" value="activo"  checked class="custom-control-input">
																				<span class="custom-control-indicator"></span>
																				<span class="custom-control-description">Activo</span>
																		</label>
																		<label class="custom-control custom-radio">
																				<input id="inactivo" value="inactivo" name="estado" type="radio" class="custom-control-input">
																				<span class="custom-control-indicator"></span>
																				<span class="custom-control-description">Inactivo</span>
																		</label>
																</div>
														</div>
												</div>
												<!--/Estado-->

												<div class="col-lg-6 col-md-6">
													<div class="card">
															<div class="card-body">
																	<h4 class="card-title">Image of Product</h4>
																	<label for="input-file-now-custom-1">You can add a default value</label>
																	<input type="hidden" id="nombre_archivo" name="nombre_archivo" >
																	<input type="file" id="input-file-events" class="dropify" data-default-file="assets/images/no-image.png" />
															</div>
													</div>
                        </div>

												
												
										</div>		
										<div class="row">	
												<div class="col-md-12">
                              <div class="form-group">
                                  <label class="control-label">Descripcion</label>																
                                    <textarea class="textarea_editor form-control" id="description" name="description" 
                                              rows="10" placeholder="Descripcion o Nota del producto"></textarea>
                                     
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
 
    <!-- jQuery file upload -->
    <script src="plantilla/assets/plugins/dropify/dist/js/dropify.min.js"></script>



  <script>
    $(document).ready(function() {
       load_tabla();
       $('.textarea_editor').wysihtml5();

			 // Basic
			 var drEvent =  $('.dropify').dropify();

       console.log(drEvent);

			  // Used events
      
        drEvent.on('dropify.fileReady', function(event, element){

					var formData = new FormData(document.getElementById("add_form"));
					console.log("este es el event",event);
					// iniciar el ajax
						/* $.ajax({
							url: "upload_image" ,
							// el metodo para enviar los datos es POST
							type: "POST",
							// colocamos la variable formData para el envio de la imagen
							data: formData,
							cache       : false,
							contentType: false,
							processData: false,
							dataType    : 'JSON',
							beforeSend: function(data)
							{
								console.log(data.responseText);
						    
							},
							success: function(data)
							{
							
								$('#nombre_archivo').val(data.imagen); //agrego el nombre del archivo subido
							
							},
							error: function(err) { // if error occured			
							
								
								console.log(err);
									
								},
								complete: function() {
									console.log("subio");	
								},
						}); */
				});


       
    });





		

		

    $('#add_form').submit(function(e) {
      e.preventDefault();
      var url    = '<?php echo base_url() ?>insert_prod';
      var url_up = '<?php echo base_url() ?>update_prod';
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
                     if (data.comprobador){
                      // $('#show_modal').modal('hide');
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

    $(document).on("click",".btn-add-new",function(){
      $('#camino').val("insertar");
      $('#tituloLabel').text('Nuevo <?= $crud ?>');        
    });

		$(document).on("click",".cerrar",function(){
      
			$("#msg-error").hide();
			$("#list_errorsA").empty();
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
                url: '<?php echo base_url() ?>get_prod',
                data: {id: id},
                async: false,
                dataType: 'json',
                success: function(data){
									//console.log("viene del controlador",data);

									$('select[name=proveedor]').val(data.id_proveedor).attr('selected','selected'); 
									$('select[name=categoria]').val(data.id_categoria).attr('selected','selected'); 
									
									$('#nombre_producto').val(data.nombre_producto);
									$('#peso_neto').val(data.peso_neto);    
									
									$('#description').val(data.descripcion); 
									$('#description').data("wysihtml5").editor.setValue(data.description);  
									
									$('select[name=genero]').val(data.genero).attr('selected','selected'); 	
									

									//* esta solucion no me gusta pero es para resolver en otro moento arreglaré

									if(data.estado === 'activo') {

										$('input:radio[name="estado"][value="activo"]').prop('checked', true);							
									}else {
										$('input:radio[name="estado"][value="inactivo"]').prop('checked', true);	
									}
								
							

									
								
								
									

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
            url: '<?php echo base_url() ?>delete_prod',
            data: {id: id},
            async: false,
            dataType: 'json',
            success: function(data){
              //console.log(data);
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
          load_tabla();
          } else {
               console.log("estoy en el else");
              load_tabla();
              }
    } 
    function load_tabla()
    {
        $.ajax({
            url:"<?php echo base_url(); ?>list_productos",
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
