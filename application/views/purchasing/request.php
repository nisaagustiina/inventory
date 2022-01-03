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
							<h3 class="panel-title">Request</h3>
							<p class="panel-subtitle">Daftar Request</p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div >
									<button class="btn btn-primary btn-xs edit-modal" id="btn-proses"><i class="fa fa-refresh"></i> Prosess Permintaan</button>
									
								</div>
							</div>
							<div class="row">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="table-permintaan">
									<thead>
										<tr>
											<th><input name="select_all" value="1" id="select-all" type="checkbox" />All</th>
											<th>ID</th>
											<th>Tanggal Permintaan</th>
											<th>Vendor</th>
											<th>Nama Barang</th>
											<th>Qty</th>
											<th>Satuan</th>
											<th>Tanggal Kirim</th>
											<th>Satatus</th>
											
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
//=================tampil permintaan==============
var table_request = $('#table-permintaan').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order" : [], //Initial no order.
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": '<?php echo base_url('purchasing/tampil_permintaan'); ?>',
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
						{"data": "ID_PERMINTAAN"},
						{"data": "TANGGAL_PERMINTAAN"},
						{"data": "NAMA_VENDOR"},
						{"data": "NAMA_BARANG"},
						{"data": "QTY_BARANG"},
						{"data": "SATUAN"},
						{"data": "TANGGAL_KIRIM"},
						{"data": "STATUS_PERMINTAAN"},
                    ]
											
});
//=================end tampil permintaan==========
table_request.on("click", "th.select-checkbox", function() {
    if ($("th.select-checkbox").hasClass("selected")) {
        table_request.rows().deselect();
        $("th.select-checkbox").removeClass("selected");
    } else {
        table_request.rows().select();
        $("th.select-checkbox").addClass("selected");
    }
}).on("select deselect", function() {
    ("Some selection or deselection going on")
    if (table_request.rows({
            selected: true
        }).count() !== table_request.rows().count()) {
        $("th.select-checkbox").removeClass("selected");
    } else {
        $("th.select-checkbox").addClass("selected");
    }
});

$('#btn-proses').click(function(){
	var data = table_request
			.row({ selected: true })
			.data();
	if (!data) {
			alert('Select the data !');
		}else{
			var ids = table_request.rows( { selected: true } ).data().pluck( 'ID_PERMINTAAN' ).toArray();
			$.ajax({
				type: "POST",
				url: 'proses_permintaan',
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
			//console.log(ids);
		}
});
});
</script>