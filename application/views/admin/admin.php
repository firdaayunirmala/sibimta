<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('message')) : ?>

                <div class="flashdataadmin" data-flashdataadmin="<?= $this->session->flashdata('message'); ?>"></div>
            <?php endif; ?>

            <a href="<?= base_url('admin/tambahadmin'); ?>" class="btn btn-success mb-3">Tambah admin</a>
            <div class="table-responsive">

                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Aktif</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                 
                    <tbody>

                        <?php $i = 1; ?>
                        <?php foreach ($admin as $adm) : ?>

                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $adm['name']; ?></td>
                                <td><?= $adm['email']; ?></td>
                                <td><?= $adm['hp']; ?></td>
                                <td><?= $adm['image']; ?></td>
                                <td class="text-center">
                      <?php $aktif = $adm['is_active'];
                      if ($aktif == 1) { ?>
                        <span class="badge badge-success">Aktif</span>
                      <?php } else { ?>
                        <span class="badge badge-danger">Tidak Aktif</span>
                      <?php } ?>
                    </td>
                                <td>
                                <a class="btn btn-warning btn-sm" href="<?= base_url('admin/editadmin/') . $adm['id']; ?>" class="badge badge-warning">edit</a>
                                <a class=" btn btn-danger btn-sm hapusadmin" href="<?= base_url('admin/hapusadmin/') . $adm['id']; ?>">hapus</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Hapus Modal-->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus admin</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda yakin ingin menghapus admin ini?</div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Hapus</button>
                <a class="btn btn-primary" href="<?= base_url('admin/index'); ?>">Batal</a>
            </div>
        </div>
    </div>
</div>