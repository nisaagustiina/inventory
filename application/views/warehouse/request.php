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
							<h3 class="panel-title">Request</h3>
							<p class="panel-subtitle">warehouse Request</p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div >
									<button class="btn btn-success btn-xs edit-modal" id="btn-new_req"><i class="fa fa-plus"></i> Add New Request</button>
									<button id="btn-edit" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</button>
									<button id="btn-delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
								</div>
							</div>
							<div class="row">
								<div class="collapse" id="collapse-new">
									<div class="card card-header text-right">
										<button class="btn btn-primary btn-xs" id="btn-item" data-toggle="modal" data-target="#modal-barang">Pilih Item</button>
									</div>
									<div class="card card-body">
									<div class="container-fluid">
										<form>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="nama_barang">Nama Barang</label>
													<input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang" disabled>
												</div>

													<div class="form-group col-md-2">
												<label for="id_barang">ID Barang</label>
												<input type="text" class="form-control" id="id_barang" placeholder="Kode Barang" disabled>
												</div>
												</div>
											<div class="form-row">
											<div class="form-group col-md-2">
												<label for="jumlah_barang">Jumlah Barang</label>
												<input type="text" class="form-control" id="jumlah_barang" required>
											</div>
											<div class="form-row">
											<div class="form-group col-md-2">
												<label for="satuan">Satuan</label>
												<input type="text" class="form-control" id="satuan" disabled>
												
											</div>
											</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-6">
												<label for="tanggal_kirim">Tanggal Kirim</label>
												<input type="date" class="form-control" id="tanggal_kirim">
												</div>
												
											</div>
											
											
										</form>
										</div>
									</div>
									<div class="card card-footer text-center">
										<button type="button" class="btn btn-success btn-xs" id="save-request">Simpan Request</button>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="table-permintaan">
									<thead>
										<tr>
											<th>Check</th>
											<th>ID</th>
											<th>Tanggal Permintaan</th>
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
<div class="modal fade bd-example-modal-lg" id="modal-barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
					<table class="table table-striped table-bordered table-hover" id="table-barang">
					<thead>
						<tr>
							<th>Check</th>
							<th>ID</th>
							<th>Kode Barang</th>
							<th>Nama Barang</th>
							<th>Satuan</th>
							<th>Harga</th>
							<th>Currency</th>
							<th>Nama Vendor</th>
						</tr>
					</thead>
					</table>
				</div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-pilih">Pilih Barang</button>
      </div>
    </div>
  </div>
</div>
</html>
<script type="text/javascript">
$(document).ready(function(){

//================tampil table barang=====================
	var table_barang = $('#table-barang').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order" : [], //Initial no order.
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": '<?php echo base_url('warehouse/tampil_barang'); ?>',
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
						{"data": "ID_BARANG"},
						{"data": "KODE_BARANG"},
						{"data": "NAMA_BARANG"},
						{"data": "SATUAN"},
						{"data": "HARGA_BARANG",render: $.fn.dataTable.render.number( ',', '.', 2 )},
						{"data": "CURRENCY"},
						{"data": "NAMA_VENDOR"},
                    ]
											
                });
//================ end tampil table barang=====================

//================tampil table request=====================
var table_request = $('#table-permintaan').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order" : [], //Initial no order.
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": '<?php echo base_url('warehouse/tampil_request'); ?>',
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
						{"data": "ID_PERMINTAAN"},
						{"data": "TANGGAL_PERMINTAAN"},
						{"data": "NAMA_BARANG"},
						{"data": "QTY_BARANG"},
						{"data": "SATUAN"},
						{"data": "TANGGAL_KIRIM"},
						{"data": "STATUS_PERMINTAAN"},
                    ]
											
                });
//================end tampil table barang=====================

//=================show new request======================
$('#btn-new_req').click(function(){
	$('#nama_barang').val('');
	$('#id_barang').val('');
	$('#satuan').val('');
	$('#jumlah_barang').val('');
	$('#tanggal_kirim').val('');
	$('#save-request').html('Simpan Request');
	$('#btn-item').show();
	$('#collapse-new').collapse('toggle');
});
//=================end show new request======================

//=================pilih item request=====================
$('#btn-pilih').click(function() {
	var data = table_barang
		.row({ selected: true })
		.data();
	if (!data) {
		alert('Select the data !');
	}else{
		$('#nama_barang').val(data.NAMA_BARANG);
		$('#id_barang').val(data.ID_BARANG);
		$('#satuan').val(data.SATUAN);
		$('#modal-barang').modal('hide');
	}
});
//=================end pilih item request=====================

//==============simpan request=================
$('#save-request').click(function(){
	var status = $('#save-request').html();
	if (status=='Simpan Request') {
		var id_barang = $('#id_barang').val();
		var qty = $('#jumlah_barang').val();
		var tgl_kirim = $('#tanggal_kirim').val();
		var req = 'id_barang='+id_barang+'&qty='+qty+'&tgl_kirim='+tgl_kirim;
		if (id_barang =='' || qty==''||tgl_kirim=='' ) {
			alert('Data Belum Lengkap !');
		}else{
			send_data('simpan_permintaan', req, 'Simpan');
		}
	}else{
		var data = table_request
					.row({ selected: true })
					.data();
		var qty = $('#jumlah_barang').val();
		var tgl_kirim = $('#tanggal_kirim').val();
		var id = data.ID_PERMINTAAN;
		var edit = 'id='+id+'&qty='+qty+'&tgl_kirim='+tgl_kirim;
		if (qty==''||tgl_kirim=='') {
			alert('Data Belum Lengkap !');
		}else{
			send_data('edit_permintaan', edit, 'Update');
		}
	}
	

});
//==============end simpan request=================

//===============show edit request=====================
$("#btn-edit").click(function(){
			var data = table_request
					.row({ selected: true })
					.data();
			if (!data) {
					alert('Select the data !');
				}else{
					$('#nama_barang').val(data.NAMA_BARANG);
					//$('#id_barang').val(data.ID_BARANG);
					$('#satuan').val(data.SATUAN);
					$('#jumlah_barang').val(data.QTY_BARANG);
					$('#tanggal_kirim').val(data.TANGGAL_KIRIM);
					$('#btn-item').hide();
					$('#save-request').html('Update Request');
					
					$('#collapse-new').collapse('toggle');
				}
});
//===============end show edit request=====================

//==================delete permintaan=====================
$('#btn-delete').click(function(){
		var data = table_request
            .row({ selected: true })
            .data();
		if (!data) {
			alert('Select the data !')
		} else{
			var r = confirm("Are you sure to delete "+data.NAMA_BARANG+" ?");
			if (r == true) {
				var id = 'id='+data.ID_PERMINTAAN;
				send_data('hapus_permintaan',id, 'Hapus');
			}
			
		}
});
//===================end delete permintaan================

});
	

function send_data(url, input, coment) {
	$.ajax({
				type: "POST",
				url: url,
				data: input,

				success : function (response) {
					if (response == 'success') {
						alert(coment+' Data berhasil');
							window.location = '';
					}else{
						alert(response);
					}
				}

			});
}
	
</script>


