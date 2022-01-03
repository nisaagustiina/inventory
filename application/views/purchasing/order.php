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
<?php $this->load->view('purchasing/_partials/sidebar'); ?>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Order</h3>
							<p class="panel-subtitle">Daftar Order</p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div >
									<button class="btn btn-warning btn-xs edit-modal" id="btn-cancel"><i class="fa fa-window-close"></i> Cancel Order</button>
									<button class="btn btn-primary btn-xs" id="btn-cetak"><i class="fa fa-print"></i> Cetak Order</button>
								</div>
							</div>
							<div class="row">
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
											<th>Harga</th>
											<th>Total</th>
											<th>Currency</th>
											<th>Tanggal kirim</th>
											<th>Status Order</th>
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
                        "url": '<?php echo base_url('purchasing/tampil_order'); ?>',
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
						{"data": "HARGA_BARANG",render: $.fn.dataTable.render.number( ',', '.', 2 )},
						{"data": "HARGA_TOTAL",render: $.fn.dataTable.render.number( ',', '.', 2 )},
						{"data": "CURRENCY"},
						{"data": "TANGGAL_KIRIM"},
						{"data": "STATUS_ORDER"},
                    ]
											
});
//====================end tampil order======================

$("#btn-cancel").click(function(){
			var data = table_order
					.row({ selected: true })
					.data();
			if (!data) {
					alert('Select the data !');
				}else{
					if (data.STATUS_ORDER == 'approved'||data.STATUS_ORDER == 'completed') {
						alert('Order tidak bisa cancel')
					}else{
					var r = confirm("Are you sure to delete "+data.NAMA_BARANG+" ?");
					if (r == true) {
					var id = 'id='+data.ID_ORDER;
					$.ajax({
						type: "POST",
						url: 'cancel_order',
						data: id,

						success : function (response) {
							if (response == 'success') {
								alert('Cancel Order berhasil');
									window.location = '';
							}else{
								alert(response);
							}
						}

					});
					}
					}
				}
});

$('#btn-cetak').click(function(){
	var data = table_order
					.row({ selected: true })
					.data();
	if (!data) {
		alert('Select the data !');
	}else{
		if (data.STATUS_ORDER == 'approve'||data.STATUS_ORDER == 'completed') {
			var id = data.ID_ORDER;
			window.location = 'cetak_pdf?id='+id;
		}
	}
	
});
});
</script>