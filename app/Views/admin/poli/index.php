<?= $this->extend('admin/layout/template'); ?>

<?= $this->Section('link'); ?>
<!-- css datatables -->
<link href="<?= base_url(); ?>/asset-admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->Section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><i class="fa fa-list"></i> <?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Tabel Poli</h6>
        </div>
        <div class="card-body">

            <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah</button>

            <!-- pesan berhasil -->
            <?php if (session('success')) : ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> <b>BERHASIL</b></h5>
                    <p><?= session('success'); ?></p>
                </div>
            <?php endif; ?>

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

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Poli</th>
                            <th>Tanggal Ditambahkan</th>
                            <th>Terakhir Diubah</th>
                            <th>Fungsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($polis as $poli) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $poli->nama_poli; ?></td>
                                <td><?= date('d/m/Y | H:i:s', strtotime($poli->tanggal_input)); ?></td>
                                <td><?= date('d/m/Y | H:i:s', strtotime($poli->tanggal_ubah)); ?></td>
                                <td class="text-center" width="15%">
                                    <button type="button" class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#modalUbah<?= $poli->id_poli; ?>"><i class="fas fa-edit"></i> Ubah</button>

                                    <button type="button" class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#modalHapus<?= $poli->id_poli; ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Poli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('poli/tambah'); ?>

                <div class="form-group">
                    <label for="nama_poli">Nama Poli</label>
                    <input type="text" name="nama_poli" id="nama_poli" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php foreach ($polis as $poli) : ?>
    <div class="modal fade" id="modalUbah<?= $poli->id_poli; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Poli</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('poli/ubah/' . $poli->id_poli); ?>

                    <div class="form-group">
                        <label for="nama_poli">Nama Poli</label>
                        <input type="text" name="nama_poli" id="nama_poli" class="form-control" value="<?= $poli->nama_poli; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-success btn-sm">Ubah</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus -->
<?php foreach ($polis as $poli) : ?>
    <div class="modal fade" id="modalHapus<?= $poli->id_poli; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt"></i> Hapus Poli</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('poli/hapus/' . $poli->id_poli); ?>

                    <p>Yakin Data Poli Dengan Nama : <?= $poli->nama_poli; ?>, Akan Dihapus.?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>

<?= $this->Section('script'); ?>
<!-- Page level plugins -->
<script src="<?= base_url(); ?>/asset-admin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/asset-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>/asset-admin/js/demo/datatables-demo.js"></script>

<?= $this->endSection(); ?>