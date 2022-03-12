<?= $this->extend('admin/layout/template'); ?>

<?= $this->Section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><i class="fa fa-list"></i> <?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Detail Data Pasien</h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>No RM</th>
                        <td>: <?= $pasien->no_rm; ?></td>
                        <th>NIK</th>
                        <td>: <?= $pasien->nik; ?></td>
                    </tr>

                    <tr>
                        <th>Nama</th>
                        <td>: <?= $pasien->nama; ?></td>
                        <th>Alamat</th>
                        <td>: <?= $pasien->alamat; ?></td>
                    </tr>

                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>: <?= $pasien->jenis_kelamin; ?></td>
                        <th>Agama</th>
                        <td>: <?= $pasien->agama; ?></td>
                    </tr>

                    <tr>
                        <th>Diagnosa</th>
                        <td>: <?= $pasien->diagnosa; ?></td>
                        <th>Jenis Pelayanan</th>
                        <td>: <?= $pasien->jenis_rawat; ?></td>
                    </tr>

                    <tr>
                        <th>Biaya</th>
                        <td>: Rp. <?= number_format($pasien->biaya, 0, ',', '.'); ?></td>
                        <th>Email</th>
                        <td>: <a href="mailto:<?= $pasien->email; ?>" target="_blank"><?= $pasien->email; ?></a></td>
                    </tr>

                    <tr>
                        <th>No Telepon</th>
                        <td>: <?= $pasien->no_telepon; ?></td>
                        <th>Foto</th>
                        <td><a href="<?= base_url('asset-admin/img/' . $pasien->foto); ?>" target="_blank">
                                <img src="<?= base_url('asset-admin/img/' . $pasien->foto); ?>" alt="foto" width="120px">
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <th>Tanggal Input</th>
                        <td>: <?= date('d-m-Y | H:i:s', strtotime($pasien->tanggal_input)); ?></td>
                        <th>Tanggal Ubah</th>
                        <td>: <?= date('d-m-Y | H:i:s', strtotime($pasien->tanggal_ubah)); ?></td>
                    </tr>
                </table>

                <a href="<?= base_url('pasien'); ?>" class="btn btn-secondary float-right">Kembali</a>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>