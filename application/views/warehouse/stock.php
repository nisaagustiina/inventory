<!DOCTYPE html>
<html lang="en">
<head>
   <?php $this->load->view('global/header'); ?>
</head>
<body>
     <!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
<?php $this->load->view('global/navbar'); ?>
		<!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
<?php $this->load->view('warehouse/_partials/sidebar'); ?>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Stock</h3>
							<p class="panel-subtitle">warehouse Stock</p>
						</div>
						<div class="panel-body">
							<div class="row">
								<button class="btn btn-danger btn-xs" id="btn-use"><i class="fa fa-minus"></i> Use Item</button>
							</div>
							<div class="row">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="table-stock">
									<thead>
										<tr>
											<th>Check</th>
											<th>ID</th>
											<th>ID Barang</th>											
											<th>Nama Barang</th>
											<th>Qty Stock</th>
											<th>Satuan</th>
											<th>Min Stock</th>
											<th>Status Stock</th>
											
										</tr>
									</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- END OVERVIEW -->
					
					
					
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
        <!-- END MAIN -->
<?php $this->load->view('global/footer'); ?>
</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
<?php $this->load->view('global/js'); ?>
</body>

<!-- Modal -->
<div class="modal fade" id="modal-out" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCenterTitle">Use Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			
			<form>
				<div class="form-group col-md-6">
					<label for="user-name-txt">Nama Barang</label>
					<input type="text" class="form-control" id="nama-barang" disabled>
					
				</div>
				<div class="form-group col-md-4">
					<label for="qty-barang">Qty</label>
					<input type="text" class="form-control" id="qty-barang">
				</div>
				<div class="form-group col-md-2">
					<label for="satuan">Uom</label>
					<input type="text" class="form-control" id="satuan" disabled>
				</div>
			
		</form>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
      </div>
    </div>
  </div>
</div>
</html>
<script type="text/javascript">
$(document).ready(function(){
	//====================tampil order======================
var table_stock = $('#table-stock').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order" : [], //Initial no order.
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": '<?php echo base_url('warehouse/tampil_stock'); ?>',
                        "type": "POST"
                    },
					columnDefs : [{
						"orderable" : false,
						"data" : null,
    				"defaultContent" : '',
						"className" : 'select-checkbox',
            "targets" :   0,
					
					}],
					select: {
            "style" :    'os',
            "selector" : 'td:first-child'
        	},
                    //Set column definition initialisation properties.
            "columns": [
											
						{"data": "no"},
						{"data": "ID_STOCK"},
						{"data": "ID_BARANG"},
						{"data": "NAMA_BARANG"},
						{"data": "QTY_STOCK"},
						{"data": "SATUAN"},
						{"data": "MIN_STOCK"},
						{"data": "STATUS_STOCK"},
                    ]
											
});
//====================end tampil order======================

$("#btn-use").click(function(){
			var data = table_stock
					.row({ selected: true })
					.data();
			if (!data) {
					alert('Select the data !');
				}else{
					if (data.QTY_STOCK == 0||data.QTY_STOCK == null) {
						alert('Stock tidak mencukupi')
					}else{
						$('#nama-barang').val(data.NAMA_BARANG);
						$('#satuan').val(data.SATUAN);
						$('#modal-out').modal('show');
					}
				}
				
			
});

$('#btn-save').click(function(){
	var data = table_stock
					.row({ selected: true })
					.data();
	var qty = $('#qty-barang').val();
	if (qty == '' || qty==0) {
		alert('Jumlah Belum Diisi !');
	}else{
		$.ajax({
				type: "POST",
				url: 'pengeluaran',
				data: 'id='+data.ID_STOCK+'&qty='+qty,

				success : function (response) {
					if (response == 'success') {
						alert('Simpan Data Berhasil');
							window.location = '';
					}else{
						alert(response);
					}
				}

			});
	}
	
});
});
</script>



