<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Mahasiswa</h1>

    <div class="row">
        <div class="col-lg-8">
            <?php if ($this->session->flashdata('message')) : ?>
                <?= $this->session->flashdata('message'); ?>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
        </div>
    </div>
    <?php
    $id = $mahasiswa['jurusan_id'];
    $query = "SELECT jurusan_nama
    FROM jurusan j 
    WHERE j.jurusan_id = $id
    ";
    $datamhs = $this->db->query($query)->row_array();
    ?>

    <div class="card mb-3 col-lg-8">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/mahasiswa/') . $mahasiswa['image']; ?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $mahasiswa['nim']; ?></h5>
                    <p class="card-text"><?= $mahasiswa['name']; ?></p>
                    <p class="card-text">semester <?= $mahasiswa['semester']; ?></p>
                    <p class="card-text"><?= $mahasiswa['totalsks']; ?> sks</p>
                    <p class="card-text"><?= $datamhs['jurusan_nama']; ?></p>
                    <p class="card-text"><?= $mahasiswa['email']; ?></p>
                    <p class="card-text"><?= $mahasiswa['hp']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <a href="<?= base_url('operation/mahasiswa'); ?>" class="btn btn-danger">Kembali</a>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->