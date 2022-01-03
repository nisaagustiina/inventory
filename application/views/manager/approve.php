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
<?php $this->load->view('manager/_partials/sidebar'); ?>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Home</h3>
							<p class="panel-subtitle">Manager</p>
						</div>
						<div class="panel-body">
							<div class="row">
								<button class="btn btn-success btn-xs edit-modal" id="btn-approve"><i class="fa fa-check"></i> Approve Order</button>
							</div>
                            <div class="row">
                                <div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="table-order">
									<thead>
										<tr>
                                            <th><input name="select_all" value="1" id="select-all" type="checkbox" />All</th>
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
                        "url": '<?php echo base_url('manager/tampil_order'); ?>',
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
            "style" :    'multiple',
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
table_order.on("click", "th.select-checkbox", function() {
    if ($("th.select-checkbox").hasClass("selected")) {
        table_order.rows().deselect();
        $("th.select-checkbox").removeClass("selected");
    } else {
        table_order.rows().select();
        $("th.select-checkbox").addClass("selected");
    }
}).on("select deselect", function() {
    ("Some selection or deselection going on")
    if (table_order.rows({
            selected: true
        }).count() !== table_order.rows().count()) {
        $("th.select-checkbox").removeClass("selected");
    } else {
        $("th.select-checkbox").addClass("selected");
    }
});

$('#btn-approve').click(function(){
	var data = table_order
			.row({ selected: true })
			.data();
	if (!data) {
			alert('Select the data !');
		}else{
			var ids = table_order.rows( { selected: true } ).data().pluck( 'ID_ORDER' ).toArray();
			$.ajax({
				type: "POST",
				url: 'approve_order',
				data: {idarray:ids},

				success : function (response) {
					if (response == 'success') {
						alert('Proses Data berhasil');
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