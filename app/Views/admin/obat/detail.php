<?= $this->extend('admin/layout/template'); ?>

<?= $this->Section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><i class="fa fa-list"></i> <?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Detail Data Obat</h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>Nama Dokter</th>
                        <td>: <?= $obat->nama_dokter; ?></td>
                        <th>Nama Obat</th>
                        <td>: <?= $obat->nama_obat; ?></td>

                    </tr>

                    <tr>
                        <th>Dosis</th>
                        <td>: <?= $obat->dosis; ?></td>
                        <th>Aturan Pakai</th>
                        <td>: <?= $obat->aturan_pakai; ?></td>
                    </tr>


                    <tr>
                        <th>Jumlah</th>
                        <td>: <?= $obat->jumlah; ?></td>
                        <th>Tanggal Input</th>
                        <td>: <?= date('d-m-Y | H:i:s', strtotime($obat->tanggal_input)); ?></td>

                    </tr>

                    <tr>
                        <th>Tanggal Ubah</th>
                        <td>: <?= date('d-m-Y | H:i:s', strtotime($obat->tanggal_ubah)); ?></td>
                    </tr>
                </table>

                <a href="<?= base_url('obat'); ?>" class="btn btn-secondary float-right">Kembali</a>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>