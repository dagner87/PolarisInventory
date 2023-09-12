
  <div class="card-body">
    <h4 class="card-title">Listado de <?= $crud ?></h4>
    <div class="table-responsive m-t-40">
      
        <table id="tbl_contenedora" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Avatar </th>
                    <th>Producto </th>
											<th>Genero </th>
											<th>Stock </th>									
											<th>Estado </th>
                                   
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

 <!-- sample modal content -->
 <div id="stock_ajust" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<h4 class="modal-title" id="tituloLabel">  </h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
								<h4>Describa el motivo del ajuste de STOCK</h4>
								<br>
								
								<div class="alert alert-warning">
								<i class="fa fa-exclamation-triangle"></i>
								Cuando hace una ajuste de stock debe argumentar el motivo por el cual está haciendo dicho ajuste. Por favor describa el motivo en el siguiente Input text</div>
								
								<form id="stock_form">
									<div class="form-group">										
											<input type="hidden" value="" class="form-control"  name="id_stock" id="stock-id">
									</div>
									<div class="form-group">
										<label for="cantidad" class="control-label">Cantidad:</label>
										<input type="number"  min="0" max="" class="form-control" id="cantidad" name="cantidad">
								</div>
									<div class="form-group">
											<label for="motivo" class="control-label">Motivo:</label>
											<textarea class="form-control" name="motivo" ></textarea>
									</div>
							
						</div>
						
						<div class="modal-footer">
							 <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-danger waves-effect waves-light">Save changes</button>
						</div>
						</form>
				</div>
				<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


 <script src="<?= base_url() ?>plantilla/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
 <script src="<?= base_url() ?>plantilla/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
 <script src="<?= base_url();?>plantilla/assets/custon_function/stock.js"></script>


