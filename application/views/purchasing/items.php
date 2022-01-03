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
							<h3 class="panel-title">Items</h3>
							<p class="panel-subtitle">Daftar Barang</p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div >
									<button class="btn btn-success btn-xs edit-modal" data-toggle="modal" data-target="#modal-barang"><i class="fa fa-plus"></i> Add New Item</button>
									<button id="btn-edit" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</button>
									<button id="btn-delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
								</div>
							</div>

							<div class="row">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="table-barang">
									<thead>
										<tr>
											<th>Check</th>
											<th>Kelompok</th>
											<th>Kategori</th>
											<th>Kode Materil</th>
											<th>Deskripsi</th>
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
<div class="modal fade" id="modal-barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCenterTitle">Add New Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<div class="container-fluid">
	  	<form>
			<div class="form-row">
				<div class="form-group col-md-6">
				<label for="nama-vendor">Nama Vendor</label>
				
				<select name="nama-vendor" id="nama-vendor" class="form-control">
					<option value="">Choose vendor</option>
				</select>
				</div>

					<div class="form-group col-md-6">
      			<label for="kode_barang">Kode Barang</label>
      			<input type="text" class="form-control" id="kode_barang" placeholder="Kode Barang">
    			</div>
				</div>
			<div class="form-row">
			<div class="form-group col-md-8">
				<label for="nama_barang">Nama Barang</label>
				<input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang">
			</div>
			<div class="form-row">
			<div class="form-group col-md-4">
				<label for="satuan">Satuan</label>
				<select name="satuan" id="satuan" class="form-control">
				<option value="">Choose..</option>
					<option value="Pcs">Pcs</option>
					<option value="Kg">Kg</option>
					<option value="Liter">Liter</option>
					<option value="Pack">Pack</option>
					<option value="Meter">Meter</option>
					<option value="Box">Box</option>
				</select>
			</div>
			</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
				<label for="harga_barang">Harga</label>
				<input type="text" class="form-control" id="harga_barang">
				</div>
				<div class="form-group col-md-2">
				<label for="currency">Currency</label>
				<select id="currency" class="form-control">
					
					<option value="IDR">IDR</option>
					<option value="USD">USD</option>
					<option value="JPY">JPY</option>
				</select>
				</div>
			</div>
			
			
		</form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-save">Simpan Barang</button>
      </div>
    </div>
  </div>
</div>


</html>
<script type="text/javascript">
$(document).ready(function() {
	var table = $('#table-barang').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order" : [], //Initial no order.
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": '<?php echo base_url('purchasing/tampil_barang'); ?>',
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
						{"data": "KELOMPOK"},
						{"data": "KATEGORI"},
						{"data": "KODE_BARANG"},
						{"data": "NAMA_BARANG"},
						{"data": "SATUAN"},
						{"data": "HARGA_BARANG",render: $.fn.dataTable.render.number( ',', '.', 2 )},
						{"data": "CURRENCY"},
						{"data": "NAMA_VENDOR"},
                    ]
											
                });
		get_vendor();



	$('#btn-save').click(function(){
		var cond = $('#ModalCenterTitle').html();
		if (cond == 'Add New Item') {
			var id_sup = $('#nama-vendor').val();
			var kode_barang = $('#kode_barang').val();
			var nama_barang = $('#nama_barang').val();
			var satuan = $('#satuan').val();
			var harga_barang = $('#harga_barang').val();
			var currency = $('#currency').val();
			var barang = 'id_sup='+id_sup+'&kode_barang='+kode_barang+'&nama_barang='+nama_barang+'&satuan='+satuan+'&harga='+harga_barang+'&currency='+currency;
			send_data('simpan_barang', barang,'Simpan');
		}else{
			var data = table
				.row({ selected: true })
				.data();
			var id = data.ID_BARANG;
			var nama_barang = $('#nama_barang').val();
			var satuan = $('#satuan').val();
			var harga_barang = $('#harga_barang').val();
			var barang = 'nama_barang='+nama_barang+'&satuan='+satuan+'&harga_barang='+harga_barang+'&id='+id;
			send_data('update_barang', barang, 'Update');
		}
		
	});

	$("#btn-edit").click(function(){
			var data = table
					.row({ selected: true })
					.data();
			if (!data) {
					alert('Select the data !');
				}else{
					$('#nama-vendor').html('<option>'+data.NAMA_VENDOR+'</option>');
					$('#nama_barang').val(data.NAMA_BARANG);
					$('#kode_barang').val(data.KODE_BARANG);
					$('#satuan').val(data.SATUAN);
					$('#harga_barang').val(data.HARGA_BARANG);
					$('#currency').val(data.CURRENCY);
					$('#ModalCenterTitle').html('Edit Data Barang');
					
					$('#modal-barang').modal('show');
				}
		});

		$('#btn-delete').click(function(){
		var data = table
            .row({ selected: true })
            .data();
		if (!data) {
			alert('Select the data !')
		} else{
			var r = confirm("Are you sure to delete "+data.NAMA_BARANG+" ?");
			if (r == true) {
				var id = 'id='+data.ID_BARANG;
				send_data('hapus_barang',id, 'Hapus');
			}
			
		}

		
	});
	
	
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

function get_vendor () {
	$.ajax({
		type: "POST",
		url: "sugest_vendor",
		
		beforeSend: function(){
			$("#nama-vendor").css("background","#FFF");
		},
		success: function(data){
			$("#nama-vendor").append(data);
		}

	});
}

</script>
