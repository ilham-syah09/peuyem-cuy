<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">PROFILE</h1>

	<div class="card mb-3" style="max-width: 540px;">
		<div class="row g-0">
			<div class="col-md-4">
				<img src="<?= base_url('assets/img/profile/') . $tbl_user['image']; ?>" class="img-fluid rounded-start">
			</div>
			<div class="col-md-8">
				<div class="card-body">
					<h5 class="card-title"><?= $tbl_user['nama']; ?></h5>
					<p class="card-text"><?= $tbl_user['username']; ?></p>
					<p class="card-text"><small class="text-muted">Terdaftar Sejak
							<?= date('d F Y', $tbl_user['date_created']); ?></small></p>
				</div>
				<div class="btn btn-primary ml-3 my-3"><a href="">Ubah Data</a></div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->