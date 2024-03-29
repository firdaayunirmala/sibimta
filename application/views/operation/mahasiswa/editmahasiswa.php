<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Edit Mahasiswa</h1>

    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart(); ?>
            <input type="hidden" name="id" value="<?= $mahasiswa['mhs_id'] ?>">
            <div class="form-group row">
                <label for="nim" class="col-sm-3 col-form-label">NIM</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nim" name="nim" value="<?= $mahasiswa['nim']; ?>">
                    <?= form_error('nim', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="namalengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="namalengkap" name="namalengkap" value="<?= $mahasiswa['name']; ?>">
                    <?= form_error('namalengkap', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="namalengkap" class="col-sm-3 col-form-label">Jurusan</label>
                <div class="col-sm-7">
                    <select name="jurusan" id="jurusan" class="form-control col-sm-9">
                        <?php foreach ($jurusan as $j) : ?>
                            <?php if ($j['jurusan_id'] == $mahasiswa['jurusan_id']) : ?>
                                <option value="<?= $j['jurusan_id'] ?>" selected><?= $j['jurusan_nama'] ?></option>
                            <?php else : ?>
                                <option value="<?= $j['jurusan_id'] ?>"><?= $j['jurusan_nama'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="sms" class="col-sm-3 col-form-label">Semester</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="semester" name="semester" value="<?= $mahasiswa['semester']; ?>">
                    <?= form_error('semester', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="totalsks" class="col-sm-3 col-form-label">Total Sks</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="totalsks" name="totalsks" value="<?= $mahasiswa['totalsks']; ?>">
                    <?= form_error('totalsks', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $mahasiswa['email']; ?>">
                    <?= form_error('email', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="hp" class="col-sm-3 col-form-label">Whatsapp</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="hp" name="hp" value="<?= $mahasiswa['hp']; ?>">
                    <?= form_error('hp', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <?php
                $aktif = $mahasiswa['is_active']; ?>
                <label for="aktif" class="col-sm-3 col-form-label">Aktif</label>
                <div class="form-check form-check-inline pl-3">
                    <input type="radio" name="aktifmhs" <?php if ($aktif == '1') {
                                                            echo 'checked';
                                                        } ?> value="1">
                    <label class="form-check-label" for="aktifmhs">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="aktifmhs" <?php if ($aktif == '0') {
                                                            echo 'checked';
                                                        } ?> value="0">
                    <label class="form-check-label" for="aktifmhs">Tidak</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Foto</div>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/mahasiswa/') . $mahasiswa['image']; ?>" class="img-thumbnail">
                        </div>

                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Ganti Foto</div>
                <div class="col-sm-9">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imagemhs" name="imagemhs">
                        <label class="custom-file-label" for="image">Pilih foto</label>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a href="<?= base_url('operation/mahasiswa'); ?>" class="btn btn-danger">Kembali</a>
                </div>
            </div>

            </form>


        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->