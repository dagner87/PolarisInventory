
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
												<label class="control-label">Proveedor</label>
												<select name="proveedor" class="form-control custom-select">
												<option value=" ">Seleccionar Proveedor</option>
														<?php
															foreach ($proveedores as $fila):
																
														?>
															<option value='<?=$fila->id ?>'><?= $fila->nombre_prove ?></option>

														<?php
															endforeach;
															?>
												</select>
												<small class="form-control-feedback"> </small> 
										</div>
								</div>							
								
						</div>
						<!--/row-->
						<div class="row">
						<!--/span-->
						<div class="col-md-6">
							<div class="form-group ">
								<label class="control-label"># Factura Proveedor</label>
								<input type="text" id="invoice" name="invoice" class="form-control form-control-danger" placeholder="Escriba el  # de factura del proveedor">
								<small class="form-control-feedback">  </small>
								</div>
						</div>
						<!--/span-->
						<!--/span-->
						<div class="col-md-6">
							<div class="form-group ">
								<label class="control-label">Costo envio</label>
								<input type="number" step="0.01" id="shipping" name="shipping" class="form-control form-control-danger" min="0" value="0">
								<small class="form-control-feedback">  </small>
								</div>
						</div>
						<!--/span-->
					</div>
						</div>
						<!--/row-->
					
						<div class="row">
								<div class="col-md-6">
										<div class="form-group">
										<label class="control-label">Producto</label>
												<select  name="producto_entrada"   id="id_producto_entrada"  class="form-control custom-select select2 " require >
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
								
							
								<div class="col-md-6" style="padding: 30px;">
									
								<label for="">&nbsp;</label>
									<div class="btn btn-rounded btn-success btn-file">
										<i class="fa fa-paperclip"></i> Respaldo <i id="cargando" class=""> </i>
										<input type="file" name="doc_respaldo" id="doc_respaldo" >
										<input type="hidden" id="nombre_archivo" name="nombre_archivo" >
									</div>
								</div>						
						</div>

					
            <hr>
						<table id="tb-entradas" class="table table-bordered table-striped table-hover">
												<thead>
														<tr>
															<th>Nombre</th>
															<th>Cantidad</th>
															<th>Precio Costo</th>
															<th>Importe</th>
															<th>&nbsp;</th>
														</tr>
												</thead>
												<tbody id="contenido_tbl">

												</tbody>
										</table>

										<div class="row">
										    <div class="col-md-8">&nbsp;</div>
										
											<div class="col-md-4 " >
												<div class="input-group has-success">
													<span class="input-group-addon">Total:</span>
													<input type="text" class="form-control" placeholder="0.00" name="total" readonly="readonly">
												</div>
											</div>
										

										</div>
				</div>

				


				<div class="form-actions">
						<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
						<button type="button" class="btn btn-inverse">Cancel</button>
				</div>
		</form>
</div>
 

<script src="<?php echo base_url();?>plantilla/assets/plugins/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>plantilla/assets/custon_function/custom.js"></script>
<script src="<?php echo base_url();?>plantilla/assets/custon_function/add_entrada.js"></script>
<script src="<?php echo base_url();?>plantilla/assets/custon_function/sumaCantidad.js"></script>




    <script>
     $(document).ready(function() {

      $(".select2").select2();
    

     });//fin onready

    </script>
