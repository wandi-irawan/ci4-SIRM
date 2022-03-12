<?= $this->extend('admin/layout/template'); ?>

<?= $this->Section('link'); ?>
<!-- css datatables -->
<link href="<?= base_url(); ?>/asset-admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->Section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Notif sweetalert -->
    <div class="swal" data-swal="<?= session('success'); ?>"></div>


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><i class="fa fa-list"></i> <?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Tabel Pasien</h6>
        </div>
        <div class="card-body">

            <a href="<?= base_url('obat/tambah'); ?>" class="btn btn-primary btn-sm mb-1"><i class="fas fa-plus"></i> Tambah</a>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokter</th>
                            <th>Nama Obat</th>
                            <th>Dosis</th>
                            <th>Aturan Pakai</th>
                            <th>Fungsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($obats as $obat) : ?>
                            <tr>
                                <td width="1%"><?= $no++; ?></td>
                                <td><?= $obat->nama_dokter; ?></td>
                                <td><?= $obat->nama_obat; ?></td>
                                <td><?= $obat->dosis; ?></td>
                                <td><?= $obat->aturan_pakai; ?></td>


                                <td class="text-center" width="15%">
                                    <a href="<?= base_url('obat/detail/' . $obat->id_obat); ?>" class="btn btn-secondary btn-sm mb-1" title="Detail"><i class="fas fa-eye"></i></a>

                                    <a href="<?= base_url('obat/ubah/' . $obat->id_obat); ?>" class="btn btn-success btn-sm mb-1" title="Ubah"><i class="fas fa-edit"></i></a>

                                    <button type="button" class="btn btn-danger btn-sm mb-1" title="Hapus" onclick="hapus(<?= $obat->id_obat; ?>)"><i class="fas fa-trash-alt"></i></button>
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

<?= $this->endSection(); ?>

<?= $this->Section('script'); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url(); ?>/asset-admin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/asset-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>/asset-admin/js/demo/datatables-demo.js"></script>

<!-- printah switalert tambah -->
<script>
    const swal = $('.swal').data('swal');
    if (swal) {
        Swal.fire({
            title: 'Berhasil',
            text: swal,
            icon: 'success',
            showConfirmButton: false,
            timer: 5000
        })
    }
</script>

<!-- printah switt alet hapus -->
<script>
    function hapus(id_obat) {
        Swal.fire({
            title: 'Hapus',
            text: `Yakin Data Obat Akan Dihapus?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('obat/hapus'); ?>",
                    data: {
                        id_obat: id_obat,
                        "csrf_test_name": "<?= csrf_hash(); ?>"
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success,
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "<?= base_url('obat'); ?>";
                                }
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        })
    }
</script>


<?= $this->endSection(); ?>