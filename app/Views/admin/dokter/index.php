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
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table"></i> Tabel Dokter</h6>
        </div>
        <div class="card-body">

            <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah</button>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokter</th>
                            <th>Spesialis</th>
                            <th>Foto</th>
                            <th>Fungsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($dokters as $dokter) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $dokter->nama_dokter; ?></td>
                                <td><?= $dokter->spesialis; ?></td>
                                <td width="20%" class="text-center">
                                    <img src="<?= base_url('asset-admin/img/' . $dokter->foto); ?>" alt="gambar" width="100%">
                                </td>
                                <td class="text-center" width="15%">
                                    <button type="button" class="btn btn-success btn-sm mb-1" title="Detail" data-toggle="modal" data-target="#modalDetail<?= $dokter->id_dokter; ?>"><i class="fas fa-eye"></i></button>

                                    <button type="button" class="btn btn-danger btn-sm mb-1" title="Edit" data-toggle="modal" data-target="#modalUbah<?= $dokter->id_dokter; ?>"><i class="fas fa-edit"></i></button>

                                    <button type="button" class="btn btn-success btn-sm mb-1" title="Hapus" onclick="hapus(<?= $dokter->id_dokter; ?>)"><i class="fas fa-trash-alt"></i></button>
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
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Data Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                <?= form_open_multipart('dokter/tambah'); ?>

                <div class="form-group">
                    <label for="nama_dokter">Nama Dokter</label>
                    <input type="text" name="nama_dokter" id="nama_dokter" class="form-control <?= ($validation->hasError('nama_dokter') ? 'is-invalid' : '') ?>" value="<?= old('nama_dokter'); ?>">
                    <?php if ($validation->hasError('nama_dokter')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_dokter') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="spesialis">Dokter Spesialis</label>
                    <input type="text" name="spesialis" id="spesialis" class="form-control <?= ($validation->hasError('spesialis') ? 'is-invalid' : '') ?>" value="<?= old('spesialis'); ?> ">
                    <?php if ($validation->hasError('spesialis')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('spesialis') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="no_telepon">No telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon" class="form-control <?= ($validation->hasError('no_telepon') ? 'is-invalid' : '') ?>" value="<?= old('no_telepon'); ?>">
                    <?php if ($validation->hasError('no_telepon')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telepon') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : '') ?>" value="<?= old('email'); ?>">
                    <?php if ($validation->hasError('email')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('email') ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group col-12">
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

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>


<!-- Modal Detail -->
<?php foreach ($dokters as $dokter) : ?>
    <div class="modal fade" id="modalDetail<?= $dokter->id_dokter; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Detail Data Dokter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('dokter/detail/' . $dokter->id_dokter); ?>
                   <div class="col-md-12">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <tr>
                                        <th>Nama Dokter</th>
                                        <td>: <?= $dokter->nama_dokter; ?></td>
                                    
                                    </tr>

                                    <tr>
                                        <th>Spesialis</th>
                                        <td>: <?= $dokter->spesialis; ?></td>
                                    </tr>

                                    <tr>
                                        <th>No Telepon</th>
                                        <td>: <?= $dokter->no_telepon; ?></td>
                                    </tr>

                                    <tr>
                                        <th>Email</th>
                                        <td>: <a href="mailto:<?= $dokter->email; ?>" target="_blank"><?= $dokter->email; ?></a></td>
                                    </tr>

                                    <tr>
                                        <th>Tanggal Input</th>
                                        <td>: <?= date('d-m-Y | H:i:s', strtotime($dokter->tanggal_input)); ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Tanggal Ubah</th>
                                        <td>: <?= date('d-m-Y | H:i:s', strtotime($dokter->tanggal_ubah)); ?></td>
                                    </tr>

                                    <tr>
                                        <th>Foto</th>
                                        <td><a href="<?= base_url('asset-admin/img/' . $dokter->foto); ?>" target="_blank">
                                        <img src="<?= base_url('asset-admin/img/' . $dokter->foto); ?>" alt="foto" width="120px">
                                    </a>
                                </td>
                            </tr>
                        </table>
                   </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
                    </div>
                    <?= form_close(); ?>
                </div>
        </div>
    </div>
    <?php endforeach; ?>


<!-- Modal Ubah -->

<!-- Modal Ubah -->
<?php foreach ($dokters as $dokter) : ?>
    <div class="modal fade" id="modalUbah<?= $dokter->id_dokter; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Poli</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('dokter/ubah/' . $dokter->id_dokter); ?>

                    <input type="hidden" name="id_dokter" value="<?= $dokter->id_dokter; ?>">
                    <input type="hidden" name="fotoLama" value="<?= $dokter->foto; ?>">
                    
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="nama_dokter">Nama Dokter</label>
                            <input type="text" name="nama_dokter" id="nama_dokter" class="form-control <?= ($validation->hasError('nama_dokter') ? 'is-invalid' : '') ?>" value="<?= old('nama_dokter', $dokter->nama_dokter); ?>">

                            <?php if ($validation->hasError('nama_dokter')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_dokter') ?>
                                </div>
                            <?php endif; ?>

                        </div>

                        <div class="form-group col-12">
                            <label for="spesialis">Spesialis</label>
                            <input type="text" name="spesialis" id="spesialis" class="form-control <?= ($validation->hasError('spesialis') ? 'is-invalid' : '') ?>" value="<?= old('spesialis', $dokter->spesialis); ?>">

                            <?php if ($validation->hasError('spesialis')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('spesialis') ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : '') ?>" value="<?= old('email', $dokter->email); ?>">
                            <?php if ($validation->hasError('email')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="no_telepon">No Telepon</label>
                            <input type="number" name="no_telepon" id="no_telepon" class="form-control <?= ($validation->hasError('no_telepon') ? 'is-invalid' : '') ?>" value="<?= old('no_telepon', $dokter->no_telepon); ?>">
                            <?php if ($validation->hasError('no_telepon')) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('no_telepon') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="foto">Foto <small>(Max 2 MB</small></label><br>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                                <label class="custom-file-label" for="foto"><?= $dokter->foto; ?></label>
                            </div>
                            <div class="mt-1">
                                <img src="<?= base_url('asset-admin/img/' . $dokter->foto); ?>" alt="" class="img-thumbnail img-preview" width="100px">
                                <?php if ($validation->hasError('foto')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('foto') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
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



<?= $this->endSection(); ?>

<?= $this->Section('script'); ?>
<!-- Page level plugins -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url(); ?>/asset-admin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/asset-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>/asset-admin/js/demo/datatables-demo.js"></script>

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
    function hapus(id_dokter) {
        Swal.fire({
            title: 'Hapus',
            text: `Yakin Data Dokter Akan Dihapus?`,
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
                    url: "<?= base_url('dokter/hapus'); ?>",
                    data: {
                        id_dokter: id_dokter,
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
                                    window.location.href = "<?= base_url('dokter'); ?>";
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