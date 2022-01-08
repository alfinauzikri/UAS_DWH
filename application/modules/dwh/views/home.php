<?php require APPPATH . 'views/head_start.php'; ?>
<link href="<?= base_url() ?>assets/plugins/apexcharts/apexcharts.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/plugins/DataTables/datatables.min.css" rel="stylesheet">
<?php require APPPATH . 'views/head_end.php'; ?>
<?php require APPPATH . 'views/header.php'; ?>
<?php require APPPATH . 'views/sidebar.php'; ?>
<?php require APPPATH . 'views/page_start.php'; ?>
<div class="row">
	<div class="col-sm-7">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Grafik Penjualan</h5>
				<div id="grafiksiji"></div>
			</div>
		</div>
	</div>
	<div class="col-sm-5">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Data Penjualan</h5>
				<!-- <p>Data ini diambil dari Tabel Fakta.</p> -->
				<table id="dtable1" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th><b>#</b></th>
							<th>Tanggal</th>
							<th>Omset</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1;
						foreach ($omset as $om) { ?>
							<tr>
								<td><b><?= $i++ ?></b></td>
								<td><?= $om->sk_waktu ?></td>
								<td><?= '$' . $om->omset ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Data Penjualan Beserta Prediksi</h5>
				<p>Prediksi harga disini memanfaatkan seluruh data yang ada di dalam tabel fakta yang sudah djumlahkan omset per harinya.</p>
				<table id="dtable2" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th><b>#</b></th>
							<th>Tanggal</th>
							<th>Omset</th>
							<th>Hasil Prediksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1;
						foreach ($predicted as $dt) { ?>
							<tr>
								<td><b><?= $i++ ?></b></td>
								<td><?= $dt['waktu'] ?></td>
								<td><?= '$' . $dt['omset'] ?></td>
								<td><b><?= '$' . $dt['pre'] ?></b></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php require APPPATH . 'views/page_end.php'; ?>
<?php require APPPATH . 'views/footer_start.php'; ?>
<script src="<?= base_url() ?>assets/plugins/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/DataTables/datatables.min.js"></script>
<script>
	$(document).ready(function() {
		var options = {
			chart: {
				height: 350,
				type: 'line',
				zoom: {
					enabled: false
				}
			},
			series: [{
				name: "Omset",
				data: [<?= implode(', ', $dt2) ?>]
			}],
			dataLabels: {
				enabled: false
			},
			stroke: {
				curve: 'straight'
			},
			grid: {
				row: {
					colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
					opacity: 0.5
				},
				borderColor: 'rgba(94, 96, 110, .5)',
				strokeDashArray: 4
			},
			xaxis: {
				categories: [<?= implode(', ', $dt1) ?>],
				labels: {
					style: {
						colors: 'rgba(94, 96, 110, .5)'
					}
				}
			}
		}

		var chart = new ApexCharts(
			document.querySelector("#grafiksiji"),
			options
		);

		chart.render();


		$('#dtable1').DataTable({
			searching: false,
			pageLength: 5,
			bLengthChange: false,
			info: false
		});

		$('#dtable2').DataTable();

	})
</script>
<?php require APPPATH . 'views/footer_end.php'; ?>