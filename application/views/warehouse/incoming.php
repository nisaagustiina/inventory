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
							<h3 class="panel-title">Incoming</h3>
							<p class="panel-subtitle">warehouse Incoming</p>
						</div>
						<div class="panel-body">
							<div class="row">
							<button class="btn btn-success btn-xs edit-modal" data-toggle="modal" data-target="#modal-order"><i class="fa fa-plus"></i> Add New Incoming</button>
							</div>
							<div class="row">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="table-incoming">
									<thead>
										<tr>
											<th>Check</th>
											<th>ID</th>
											<th>Tanggal Terima</th>
											<th>Nama Vendor</th>
											<th>Nama Barang</th>
											<th>Qty Awal</th>
											<th>Qty Masuk</th>
											<th>Qty Stock</th>
											<th>Satuan</th>
											<th>Staff Gudang</th>
											
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
<div class="modal fade bd-example-modal-lg" id="modal-order" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCenterTitle">Pilih Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table-order">
						<thead>
							<tr>
								<th>Check</th>
								<th>ID</th>
								<th>Tanggal Order</th>
								<th>Nama Vendor</th>
								<th>Nama Barang</th>
								<th>Qty</th>
								<th>Satuan</th>
								<th>Tanggal kirim</th>
								<th>Status Order</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-pilih">Pilih Order</button>
      </div>
    </div>
  </div>
</div>
</html>
<script type="text/javascript">
$(document).ready(function(){
//====================tampil order======================
var table_order = $('#table-order').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order" : [], //Initial no order.
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": '<?php echo base_url('warehouse/tampil_order'); ?>',
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
						{"data": "ID_ORDER"},
						{"data": "TANGGAL_ORDER"},
						{"data": "NAMA_VENDOR"},
						{"data": "NAMA_BARANG"},
						{"data": "QTY_BARANG"},
						{"data": "SATUAN"},
						{"data": "TANGGAL_KIRIM"},
						{"data": "STATUS_ORDER"},
                    ]
											
});
//====================end tampil order======================

//====================tampil penerimaan======================
var table_in = $('#table-incoming').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order" : [], //Initial no order.
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": '<?php echo base_url('warehouse/tampil_incoming'); ?>',
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
						{"data": "ID_PENERIMAAN"},
						{"data": "TANGGAL_TERIMA"},
						{"data": "NAMA_VENDOR"},
						{"data": "NAMA_BARANG"},
						{"data": "QTY_AWAL"},
						{"data": "QTY_MASUK"},
						{"data": "QTY_STOCK"},
						{"data": "SATUAN"},
						{"data": "STAFF_GUDANG"},
						
                    ]
											
});
//====================end tampil penerimaan======================

//====================tambah penerimaan======================
$('#btn-pilih').click(function(){
	var data = table_order
		.row({ selected: true })
		.data();
	if (!data) {
		alert('Select the data !');
	}else{
		var id = data.ID_ORDER;
		var qty = data.QTY_BARANG;
		//alert(id);
		$.ajax({
				type: "POST",
				url: 'simpan_incoming',
				data: 'id='+id+'&qty='+qty,

				success : function (response) {
					if (response == 'success') {
						alert('Simpan Data berhasil');
							window.location = '';
					}else{
						alert(response);
					}
				}

			});
	}
});
//====================tambah penerimaan======================
});
</script>



