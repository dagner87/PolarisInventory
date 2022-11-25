
 <div class="card-body">
    <!-- MENSAJE DE ERROR -->
 <div class="alert alert-danger"  id="msg-error" style="display: none;"> 
		<i class="ti-face-sad"></i> 
		<strong> ¡Importante!</strong>  
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
		<div  id="list_errorsA"></div>
</div> 
 <!-- FIN MENSAJE DE ERROR -->

		<form action="" method="POST" enctype="multipart/form-data" id="add_form"  >
		<input type="hidden" name="camino" id="camino" value="<?= $camino ?>">
				<div class="form-body">
						<h3 class="card-title">Nueva <?= $crud ?></h3>
						<hr>
						<!--/row-->
						<div class="row">
							<!--/span-->
							  <div class="col-md-6">
										<div class="form-group">
												<label class="control-label">Fecha </label>
												<input type="date" name="fecha_entrada" class="form-control" value="<?= date('Y-m-d') ?>" placeholder="mm/dd/yyyy">
										</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
										<div class="form-group">
												<label class="control-label">Tipo de venta</label>
												<select name="proveedor" class="form-control custom-select">
													<option value="efectivo">Efectivo</option>
													<option value="zelle">Zelle</option>
													<option value="web">Web</option>
												</select>
												<small class="form-control-feedback"> </small> 
										</div>
								</div>	
														
								
						</div>
						<!--/row-->
						</div>
						<!--/row-->
					
						<div class="row">
								<div class="col-md-6">
										<div class="form-group">
										<label class="control-label">Producto</label>
												<select  name="producto_entrada"   id="id_producto_entrada"  class="form-control custom-select" require >
												<option value=" ">Seleccionar Producto</option>
														<?php
															foreach ($productos as $fila):
																	$dataProducto = $fila->id . "*". $fila->nombre_producto;?>
														?>
															<option value='<?=$dataProducto?>'><?= $fila->nombre_producto ?></option>

														<?php
															endforeach;
															?>
												</select>
										</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
							     	<div class="form-group ">
                                        <label for="cliente">Cliente</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cliente" placeholder="Buscar Cliente">
                                            <div id="searchcliente"  class="input-group-addon btn-success"><i class="ti-search"></i></div>
										</div>
										<small class="form-control-feedback">  </small>
                                    </div>
								</div>									
								<!--/span-->	
																
						</div>
						
            <hr>
						<table id="tb-entradas" class="table table-bordered table-striped table-hover">
												<thead>
														<tr>
															<th>Nombre</th>
															<th>Cantidad</th>
															<th>Precio Costo</th>
															<th>&nbsp;</th>
														</tr>
												</thead>
												<tbody id="contenido_tbl">

												</tbody>
										</table>
				</div>

				


				<div class="form-actions">
						<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
						<button type="button" class="btn btn-inverse">Cancel</button>
				</div>
		</form>
</div>
 

<script src="<?php echo base_url();?>plantilla/assets/plugins/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>plantilla/assets/custon_function/custom.js"></script>




    <script>

     $(document).ready(function() {

      $(".select2").select2();
      $("#id_producto_entrada").on("change",function(){
         let data = $(this).val();
				 console.log(data);
         var option = $(this).find(':selected')[0];//obtiene el producto seleccionado
         $(option).attr('disabled', 'disabled'); // y lo desabilita para no volverlo a seleccionar

        if (data !='') {
            infoproducto = data.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
            html += "<td><input type='text' name='cantidades[]' value='' class='cantidades' required data-parsley-minlength='2'></td>";

            html += "<td><input type='text' name='precios_costo[]' value='' class='cantidades' required data-parsley-minlength='2'></td>";

            html += "<td><button type='button' class='btn btn-danger btn-remove'><span class='fa fa-remove'></span></button></td>";

            html += "</tr>";
            $("#tb-entradas tbody").append(html);
            $("#btn-agregar-entrada").val(null);

        }else{
            alert("seleccione un producto...");
        }
    });

     });//fin onready

   

				



    </script>
