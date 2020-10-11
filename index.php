	<html>
		<head>
			<title>Daftar Produk Koperasi PENS</title>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
			<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
			<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
			<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			<style>
				body
				{
					margin:0;
					padding:0;
					background-color:#f1f1f1;
				}
				.box
				{
					width:1270px;
					padding:20px;
					background-color:#fff;
					border:1px solid #ccc;
					border-radius:5px;
					margin-top:25px;
					margin-bottom: 25px;
				}
				.inline { 
					display: inline-block; 
					width: 40%;
				}
			</style>
		</head>
		<body>
			<div class="container box">
				<h1 align="center">Daftar Jajanan Koperasi Dinamika Harmoni PENS</h1>
				<p align="center">Kampus ITS, Jl. Raya ITS, Keputih, Kec. Sukolilo, Kota SBY, Jawa Timur 60111</p>
				<br/><br/>
				<div class="table-responsive">
					<div align="left" class="inline">
						<h4>Daftar Jajanan</h4>
					</div>
					<div align="right" class="inline" style="float:right">
						<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-md">Tambah Data</button>
					</div>
					<br/><br/>
					<table id="user_data" width="100%" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="10%">Gambar</th>
								<th width="24%">Nama</th>
								<th width="15%">Harga Beli (Rp.)</th>
								<th width="15%">Harga Jual (Rp.)</th>
								<th width="10%">Asal Stock</th>
								<th width="8%">Edit</th>
								<th width="8%">Delete</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</body>
	</html>

	<div id="userModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="user_form" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Tambah Produk Jajanan</h4>
					</div>
					<div class="modal-body">
						<div style="margin-bottom: 10px">
							<div align="center" class="inline" style="width:20%;">
								<span id="user_uploaded_image"></span>
							</div>
							<div align="left" class="inline" style="width:50%; margin-top: 10px;">
								<label>Select User Image</label>
								<input type="file" name="user_image" id="user_image" />
							</div>
						</div>
						<br />
						<label>Masukkan nama produk jajanan</label>
						<input type="text" name="nama" id="nama" class="form-control" />
						<div style="margin: 10px 0">
							<div style="width: 48%" align="left" class="inline">
								<label>Masukkan harga beli</label>
								<input type="text" name="harga_beli" id="harga_beli" class="form-control" />
							</div>
							<div style="width: 48%; float: right" align="left" class="inline">
								<label>Masukkan harga jual</label>
								<input type="text" name="harga_jual" id="harga_jual" class="form-control" />
							</div>
						</div>
						<label>Masukkan asal stock</label>
						<input type="text" name="asal_stock" id="asal_stock" class="form-control" />
						<br />
					</div>
					<div class="modal-footer">
						<input type="hidden" name="jajanan_id" id="jajanan_id" />
						<input type="hidden" name="operation" id="operation" />
						<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script type="text/javascript" language="javascript" >
	$(document).ready(function(){
		$('#add_button').click(function(){
			$('#user_form')[0].reset();
			$('.modal-title').text("Tambah Data Jajanan Baru");
			$('#action').val("Tambah");
			$('#operation').val("Tambah");
			$('#user_uploaded_image').html('');
		});
		
		var dataTable = $('#user_data').DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"fetch.php",
				type:"POST"
			},
			"columnDefs":[
				{
					"targets":[0, 4, 5, 6],
					"orderable":false,
				},
			],

		});

		$(document).on('submit', '#user_form', function(event){
			event.preventDefault();
			var nama = $('#nama').val();
			var harga_beli = $('#harga_beli').val();
			var harga_jual = $('#harga_jual').val();
			var asal_stock = $('#asal_stock').val();
			var extension = $('#user_image').val().split('.').pop().toLowerCase();
			if(extension != '')
			{
				if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
				{
					alert("Invalid Image File");
					$('#user_image').val('');
					return false;
				}
			}	
			if(nama != '' && harga_beli != '')
			{
				$.ajax({
					url:"insert.php",
					method:'POST',
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data)
					{
						alert(data);
						$('#user_form')[0].reset();
						$('#userModal').modal('hide');
						dataTable.ajax.reload();
					}
				});
			}
			else
			{
				alert("Both Fields are Required");
			}
		});
		
		$(document).on('click', '.update', function(){
			var jajanan_id = $(this).attr("id");
			$.ajax({
				url:"fetch_single.php",
				method:"POST",
				data:{jajanan_id:jajanan_id},
				dataType:"json",
				success:function(data)
				{
					$('#userModal').modal('show');
					$('#nama').val(data.nama);
					$('#harga_beli').val(data.harga_beli);
					$('#harga_jual').val(data.harga_jual);
					$('#asal_stock').val(data.asal_stock);
					$('.modal-title').text("Edit Data Jajanan");
					$('#jajanan_id').val(jajanan_id);
					$('#user_uploaded_image').html(data.user_image);
					$('#action').val("Edit");
					$('#operation').val("Edit");
				}
			})
		});
		
		$(document).on('click', '.delete', function(){
			var jajanan_id = $(this).attr("id");
			if(confirm("Apakah Anda yakin untuk menghapusnya?"))
			{
				$.ajax({
					url:"delete.php",
					method:"POST",
					data:{jajanan_id:jajanan_id},
					success:function(data)
					{
						alert(data);
						dataTable.ajax.reload();
					}
				});
			}
			else
			{
				return false;	
			}
		});
		
		
	});
	</script>