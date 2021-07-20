<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Dosen Pembimbing</h1>

    <div class="row">
        <div class="col-lg-10">

            <?= form_open_multipart('operation/tambahdosen'); ?>

            <div class="form-group row">
                <label for="nik" class="col-sm-3 col-form-label">NIDN</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIDN" value="<?= set_value('nik'); ?>">
                    <?= form_error('nik', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Lengkap" value="<?= set_value('name'); ?>">
                    <?= form_error('nama', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                    <?= form_error('password', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="password2" class="col-sm-3 col-form-label">Repeat Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password">
                    <?= form_error('password2', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email Valid" value="<?= set_value('email'); ?>">
                    <?= form_error('email', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="hp" class="col-sm-3 col-form-label">Handphone</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="hp" name="hp" placeholder="Masukkan Nomor HP" value="<?= set_value('hp'); ?>">
                    <?= form_error('hp', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Aktif</label>
                <div class="form-check form-check-inline pl-3">
                    <input type="radio" name="aktif" value="1" <?php echo  set_radio('aktif', '1', TRUE); ?> />
                    <label class="form-check-label">Ya</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" name="aktif" value="0" <?php echo  set_radio('aktif', '0'); ?> />
                    <label class="form-check-label">Tidak</label>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3">Foto</div>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/default.jpg') ?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagedosen" name="imagedosen">
                                <label class="custom-file-label" for="image">Pilih foto</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Tambah</button>

                    <a href="<?= base_url('operation/dosen'); ?>" class="btn btn-danger">Kembali</a>
                </div>
            </div>

            </form>


        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->