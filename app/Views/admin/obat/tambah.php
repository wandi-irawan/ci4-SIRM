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

            <?= form_open('obat/tambah'); ?>
            <div class="row">
                <div class="form-group col-6">
                    <label for="nama_dokter">Nama Dokter</label>
                    <input type="text" name="nama_dokter" id="nama_dokter" class="form-control <?= ($validation->hasError('nama_dokter') ? 'is-invalid' : '') ?>" value="<?= old('nama_dokter'); ?>">

                    <?php if ($validation->hasError('nama_dokter')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_dokter') ?>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="form-group col-6">
                    <label for="nama_obat">Nama obat</label>
                    <input type="text" name="nama_obat" id="nama_obat" class="form-control <?= ($validation->hasError('nama_obat') ? 'is-invalid' : '') ?>">

                    <?php if ($validation->hasError('nama_obat')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_obat') ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="dosis">Dosis</label>
                    <input type="text" name="dosis" id="dosis" class="form-control <?= ($validation->hasError('dosis') ? 'is-invalid' : '') ?>">

                    <?php if ($validation->hasError('dosis')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('dosis') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group col-6">
                    <label for="aturan_pakai">Aturan pakai</label>
                    <input type="text" name="aturan_pakai" id="aturan_pakai" class="form-control <?= ($validation->hasError('aturan_pakai') ? 'is-invalid' : '') ?>">
                    <?php if ($validation->hasError('aturan_pakai')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('aturan_pakai') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-12">
                    <label for="jumlah">Jumlah</label>
                    <input type="text" name="jumlah" id="jumlah" class="form-control <?= ($validation->hasError('jumlah') ? 'is-invalid' : '') ?>">
                    <?php if ($validation->hasError('jumlah')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah') ?>
                        </div>
                    <?php endif; ?>
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