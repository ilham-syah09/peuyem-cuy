<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row">
		<div class="col-xl-4">
			<div class="form-group">
				<label for="tanggal">Tanggal Awal</label>
				<input type="date" name="tanggal_awal" id="by_tanggal_awal" class="form-control" value="<?= $tanggal_awal; ?>">
			</div>
		</div>
		<div class="col-xl-4">
			<div class="form-group">
				<label for="tanggal">Tanggal Akhir</label>
				<input type="date" name="tanggal_akhir" id="by_tanggal_akhir" class="form-control" value="<?= $tanggal_akhir; ?>">
			</div>
		</div>
	</div>
	<div class="row">
		<!-- Area Chart -->
		<div class="col">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Tabel <?= $title; ?></h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">

					<table id="examples" class="table mt-2">
						<thead>
							<tr>
								<th>#</th>
								<th>tanggal</th>
								<th>Berat</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							$total = 0; ?>
							<?php foreach ($monitoring as $m) : ?>
								<?php $total += $m['berat']; ?>
								<tr>
									<td><?= $i++; ?></td>
									<td><?= date('Y-M-d', strtotime($m['dibuat'])); ?></td>
									<td><?= $m['berat']; ?> Gram</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2">Total</td>
								<td><?= $total; ?> Gram</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('#by_tanggal_akhir').change(function() {
		let tanggal_awal = $('#by_tanggal_awal').val();
		let tanggal_akhir = $(this).val();

		document.location.href = `<?= base_url('admin/hasilproduksi/${tanggal_awal}/${tanggal_akhir}'); ?>`;
	});
</script>