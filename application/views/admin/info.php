<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <!-- Content Row -->
    <div class="row mb-4">
        <div class="col">
            <div class="card h-100 shadow">
                <img src="<?= base_url('assets/img/tape.jpg'); ?>" class="card-img-top w-50 mx-auto pt-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Apa Itu Tape ?</h5>
                    <p class="card-text ">Penjelasan Tentang Tape</p>
                    <a href="<?= base_url('admin/tape/'); ?>" class="btn btn-primary mt-4">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow">
                <img src="<?= base_url('assets/img/linimasa.jpg'); ?>" class="card-img-top h-60 mx-auto pt-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Linimasa</h5>
                    <p class="card-text">Langkah-langkah Proses Fermentasi Tape Singkong & Ketan</p>
                    <a href="<?= base_url('admin/linimasa/'); ?>" class="btn btn-primary mt-3">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card h-100 shadow">
                <img src="<?= base_url('assets/img/kandungan.jpg'); ?>" class="card-img-top w-50 mx-auto pt-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Manfaat Tape</h5>
                    <p class="card-text">Kandungan Gizi dan Manfaat Tape</p>
                    <a href="<?= base_url('admin/manfaat/'); ?>" class="btn btn-primary mt-4">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow">
                <img src="<?= base_url('assets/img/dokumentasi.jpg'); ?>" class="card-img-top w-50 mx-auto pt-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Dokumentasi</h5>
                    <p class="card-text">Video dan Produksi Tape</p><br>
                    <a href="<?= base_url('admin/dokumentasi/'); ?>" class="btn btn-primary mt-3">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>