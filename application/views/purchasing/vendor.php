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
							<h3 class="panel-title">Vendor</h3>
							<p class="panel-subtitle">Daftar Vendor</p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div >
									<button class="btn btn-success btn-xs edit-modal" data-toggle="modal" data-target="#modal-vendor"><i class="fa fa-plus"></i> Add New Vendor</button>
									<button id="btn-edit" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</button>
									<button id="btn-delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
									<br><br>
								</div>
									<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="table-vendor">
									<thead>
										<tr>
											<th>Select</th>
											<th>Kode Vendor</th>
											<th>Nama Vendor</th>
											<th>Alamat </th>
											<th>Telepon</th>
											<th>Email</th>
										</tr>
									</thead>
									</table>
									</div>
							</div>
							<!-- <div class="row">
								
								<div class="col-md-3">
								
								</div>
							</div> -->
						</div>
					</div>
				
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
<div class="modal fade" id="modal-vendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCenterTitle">Add New Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			
			<form>
				<div class="form-group">
					<label for="kd-txt">Kode Vendor</label>
					<input type="text" class="form-control" id="vendor-name-txt" placeholder="Enter Vendor Name">
					
				</div>
				<div class="form-group">
					<label for="user-name-txt">Nama Vendor</label>
					<input type="text" class="form-control" id="vendor-name-txt" placeholder="Enter Vendor Name">
					
				</div>
				<div class="form-group">
					<label for="alamat-txt">Alamat</label>
					<textarea name="alamat-vendor" id="alamat-vendor" cols="30" rows="3" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label for="user-name-txt">Status</label>
					<input type="text" class="form-control" id="vendor-name-txt" placeholder="Enter Vendor Name">
					
				</div>
				<!-- <div class="form-group form-check">
					<label for="vendor-name-txt">Telepon</label>
					<input type="text" class="form-control" id="vendor-tlp-txt" placeholder="Enter Phone">
				</div>
				<div class="form-group form-check">
					<label for="vendor-name-txt">Email</label>
					<input type="text" class="form-control" id="vendor-email-txt" placeholder="Enter Email">
				</div> -->
			
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
	$(document).ready( function () {
		var table = $('#table-vendor').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order" : [], //Initial no order.
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": '<?php echo base_url('purchasing/tampil_vendor'); ?>',
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
                        {"data": "KODE_VENDOR"},
                        {"data": "NAMA_VENDOR"},
                        {"data": "ALAMAT_VENDOR"},
						{"data": "TELP_VENDOR"},
						{"data": "EMAIL_VENDOR"},
                    ]
											
                });

		$('#btn-save').click(function(){
			var cond = $('#ModalCenterTitle').html();
			if (cond == 'Add New Vendor') {
				var nama = $('#vendor-name-txt').val();
				var alamat = $('#alamat-vendor').val();
				var telp = $('#vendor-tlp-txt').val();
				var email = $('#vendor-email-txt').val();

			$.ajax({
				type: "POST",
				url: "add_vendor",
				data: 'nama='+nama+'&alamat='+alamat+'&telp='+telp+'&email='+email,

				success: function (response) {
					if (response == "success") {
						alert('Data berhasil disimpan');
						window.location = '';
					} else{
						alert(response);
					}
					
				}
			});
			}else{
				var data = table
				.row({ selected: true })
				.data();
				var id = data.ID_VENDOR;
				var nama = $('#vendor-name-txt').val();
				var alamat = $('#alamat-vendor').val();
				var telp = $('#vendor-tlp-txt').val();
				var email = $('#vendor-email-txt').val();

							$.ajax({
								type : "POST",
								url : "<?php echo base_url('purchasing/edit_vendor') ?>",
								data : 'nama='+nama+'&alamat='+alamat+'&telp='+telp+'&email='+email+'&id='+id,

								success : function(response){
									if (response == 'success') {
										window.location = '';
									}else{
										alert(response);
									}
								}
							});
			}
		
		
		});
//==============edit vendor==========================
		$("#btn-edit").click(function(){
			var data = table
					.row({ selected: true })
					.data();
			if (!data) {
					alert('Select the data !');
				}else{
					$('#vendor-name-txt').val(data.NAMA_VENDOR);
					$('#alamat-vendor').val(data.ALAMAT_VENDOR);
					$('#vendor-tlp-txt').val(data.TELP_VENDOR);
					$('#vendor-email-txt').val(data.EMAIL_VENDOR);
				
					$('#ModalCenterTitle').html('Edit Data Vendor');
					
					$('#modal-vendor').modal('show');
				}
		});

		$('#btn-delete').click(function(){
		var data = table
            .row({ selected: true })
            .data();
		if (!data) {
			alert('Select the data !')
		} else{
			var r = confirm("Are you sure to delete "+data.NAMA_VENDOR+" ?");
			if (r == true) {
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('purchasing/hapus_vendor'); ?>",
					data : "id="+data.ID_VENDOR,

					success : function (response) {
						if (response == "success") {
							window.location = '';
						}else{
							alert(response);
						}
					
					}
				});
			}
		}

		
	});

	
	});
</script>