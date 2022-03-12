<?= $this->extend('admin/layout/template'); ?>

<?= $this->Section('content'); ?>
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800"><i class="fa fa-user-plus"></i> <?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus"></i> Tambah Data Rekam Medik</h6>
        </div>
        <div class="card-body">
            <!-- pesan gagal -->
            <?php
            $errors = session('failed');

            if (!empty($errors)) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> <b>GAGAL</b></h5>
                    <ul>
                        <?php foreach ($errors as $e) { ?>
                            <li><?= esc($e); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?= form_open_multipart('pasien/tambah'); ?>
            <div class="row">
                <div class="form-group col-6">
                    <label for="no_rm">No RM</label>
                    <input type="number" name="no_rm" id="no_rm" class="form-control <?= ($validation->hasError('no_rm') ? 'is-invalid' : '') ?>" value="<?= old('no_rm'); ?>">

                    <?php if ($validation->hasError('no_rm')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_rm') ?>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="form-group col-6">
                    <label for="nik">NIK</label>
                    <input type="number" name="nik" id="nik" class="form-control <?= ($validation->hasError('nik')); ?>">

                    <?php if ($validation->hasError('nik')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nik') ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control <?= ($validation->hasError('nama') ? 'is-invalid' : '') ?>">

                    <?php if ($validation->hasError('nama')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group col-6">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control <?= ($validation->hasError('alamat') ? 'is-invalid' : '') ?>">
                    <?php if ($validation->hasError('alamat')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control <?= ($validation->hasError('jenis_kelamin') ? 'is-invalid' : '') ?>">
                        <?php if ($validation->hasError('jenis_kelamin')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('jenis_kelamin') ?>
                            </div>
                        <?php endif; ?>
                        <option value="">-- pilih --</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label for="agama">Agama</label>
                    <select name="agama" id="agama" class="form-control <?= ($validation->hasError('agama') ? 'is-invalid' : '') ?>">
                        <?php if ($validation->hasError('agama')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('agama') ?>
                            </div>
                        <?php endif; ?>
                        <option value="">-- pilih --</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="diagnosa">Diagnosa</label>
                    <input type="text" name="diagnosa" id="diagnosa" class="form-control <?= ($validation->hasError('diagnosa') ? 'is-invalid' : '') ?>">
                    <?php if ($validation->hasError('diagnosa')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('diagnosa') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group col-6">
                    <label for="jenis_rawat">Jenis Pelayanan</label>
                    <select name="jenis_rawat" id="jenis_rawat" class="form-control <?= ($validation->hasError('jenis_pelayanan') ? 'is-invalid' : '') ?>">
                        <?php if ($validation->hasError('diagnosa')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('diagnosa') ?>
                            </div>
                        <?php endif; ?>
                        <option value="">-- pilih --</option>
                        <option value="Rawat Inap">Rawat Inap</option>
                        <option value="Rawat Jalan">Rawat Jalan</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="biaya">Biaya</label>
                    <input type="number" name="biaya" id="biaya" class="form-control <?= ($validation->hasError('biaya') ? 'is-invalid' : '') ?>">
                    <?php if ($validation->hasError('biaya')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('biaya') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group col-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : '') ?>">
                    <?php if ($validation->hasError('email')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('email') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="no_telepon">No Telepon</label>
                    <input type="number" name="no_telepon" id="no_telepon" class="form-control <?= ($validation->hasError('no_telepon') ? 'is-invalid' : '') ?>">
                    <?php if ($validation->hasError('no_telepon')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telepon') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group col-6">
                    <label for="foto">Foto <small>(Max 2 MB</small></label><br>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                        <label class="custom-file-label" for="foto">Pilih foto...</label>
                    </div>
                    <div class="mt-1">
                        <img src="" alt="" class="img-thumbnail img-preview" width="100px">
                        <?php if ($validation->hasError('foto')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('foto') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary float-right">Tambah</button>
            <?= form_close(); ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>

<?= $this->Section('script'); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function previewImg() {
        const gambar = document.querySelector('#foto');
        const gambarLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        gambarLabel.textContent = gambar.files[0].name;

        const fileGambar = new FileReader();
        fileGambar.readAsDataURL(gambar.files[0]);

        fileGambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection(); ?>