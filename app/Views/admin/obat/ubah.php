<?= $this->extend('admin/layout/template'); ?>

<?= $this->Section('content'); ?>
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800"><i class="fa fa-user-trash-alt"></i> <?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-plus"></i> Ubah Data Rekam Medik</h6>
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

            <?= form_open_multipart('obat/ubah/' . $obat->id_obat); ?>

            <input type="hidden" name="id_obat" value="<?= $obat->id_obat; ?>">


            <div class="row">
                <div class="form-group col-6">
                    <label for="nama_dokter">Nama Dokter</label>
                    <input type="text" name="nama_dokter" id="nama_dokter" class="form-control <?= ($validation->hasError('nama_dokter') ? 'is-invalid' : '') ?>" value="<?= old('nama_dokter', $obat->nama_dokter); ?>">

                    <?php if ($validation->hasError('nama_dokter')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_dokter') ?>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="form-group col-6">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" name="nama_obat" id="nama_obat" class="form-control <?= ($validation->hasError('nama_obat') ? 'is-invalid' : '') ?>" value="<?= old('nama_obat', $obat->nama_obat); ?>">

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
                    <input type="text" name="dosis" id="dosis" class="form-control <?= ($validation->hasError('dosis') ? 'is-invalid' : '') ?>" value="<?= old('dosis', $obat->dosis); ?>">

                    <?php if ($validation->hasError('dosis')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('dosis') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group col-6">
                    <label for="aturan_pakai">Aturan Pakai</label>
                    <input type="text" name="aturan_pakai" id="aturan_pakai" class="form-control <?= ($validation->hasError('aturan_pakai') ? 'is-invalid' : '') ?>" value="<?= old('aturan_pakai', $obat->aturan_pakai); ?>">
                    <?php if ($validation->hasError('aturan_pakai')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('aturan_pakai') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-6">
                    <label for="jumlah">Jumlah</label>
                    <input type="text" name="jumlah" id="jumlah" class="form-control <?= ($validation->hasError('jumlah') ? 'is-invalid' : '') ?>" value="<?= old('jumlah', $obat->jumlah); ?>">

                    <?php if ($validation->hasError('jumlah')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>



            <button type="submit" class="btn btn-success float-right m-1">Ubah</button>
            <a href="<?= base_url('obat'); ?>" class="btn btn-danger float-right m-1">Kembali</a>
            <?= form_close(); ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>

<?= $this->Section('script'); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection(); ?>