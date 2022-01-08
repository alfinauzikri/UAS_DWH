<?php require APPPATH . 'views/head_start.php'; ?>
<?php require APPPATH . 'views/head_end.php'; ?>
<?php require APPPATH . 'views/header.php'; ?>
<?php require APPPATH . 'views/sidebar.php'; ?>
<?php require APPPATH . 'views/page_start.php'; ?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Alat Prediksi Penjualan</h5>
                <p class="card-description">Silakan masukkan tanggal mendatang yang ingin Anda ketahui omsetnya, sehingga aplikasi ini akan menjalankan proses prediksi omset berdasarkan data dari penjualan yang sudah ada.</p>
                <form method="POST" action="<?= base_url('dwh/proses') ?>">
                    <div class="mb-3">
                        <labelclass="form-label">Tanggal</labelclass=>
                            <input type="date" name="waktu" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <?php if (!empty($this->session->flashdata('hasil'))) { ?>
                    <div class="mt-4 alert alert-warning alert-dismissible fade show" role="alert">
                        Anda akan mendapatkan omset sebesar <b>$<?= $this->session->flashdata('hasil');
                                                                ?></b> di tanggal <?= $this->session->flashdata('tgl');
                                                                                    ?>, berdasarkan perhitungan dan prediksi aplikasi.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php require APPPATH . 'views/page_end.php'; ?>
<?php require APPPATH . 'views/footer_start.php'; ?>
<?php require APPPATH . 'views/footer_end.php'; ?>