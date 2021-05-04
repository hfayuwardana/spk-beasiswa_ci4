<!-- content -->
<div class="col-lg-9 bg-white content py-3 mt-5">
    <div class="row h-100">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-body mt-1">
                    <h2 class="font-weight-bold text-biru-1">Data Mahasiswa</h2>
                    <hr class="mt-5 mb-4">

                    <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashData('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php if(session()->getFlashData('danger')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong>
                        <?= session()->getFlashData('danger') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <div class="d-flex justify-content-end"><a
                            class="btn btn-primary bg-biru-gr rounded-pill w-25 py-2 font-weight-bold"
                            href="<?= base_url().'/mahasiswa/createMahasiswa' ?>" role="button"><i
                                class="fas fa-plus-circle"></i> Tambah Data</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table mt-4 text-center">
                            <thead class="bg-biru-gr text-white">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($mahasiswa as $mhs): ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $mhs['nim']; ?></td>
                                    <td><?= $mhs['nama_mhs']; ?></td>
                                    <td>
                                        <a class="btn btn-success rounded-pill w-25"
                                            href="<?= base_url() ?>/mahasiswa/detailMahasiswa/<?= $mhs['id_mahasiswa']; ?>"
                                            role="button"><i class="far fa-eye"></i> Detail</a>
                                        <a class="btn btn-warning rounded-pill text-dark w-25"
                                            href="<?= base_url() ?>/mahasiswa/editMahasiswa/<?= $mhs['id_mahasiswa']; ?>"
                                            role="button"><i class="far fa-edit"></i> Sunting</a>
                                        <a class="btn btn-danger rounded-pill w-25"
                                            href="<?= base_url('/AdminController/deleteMahasiswa/'.$mhs['id_mahasiswa']) ?>"
                                            role="button"><i class="far fa-trash-alt"></i> Hapus</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- akhir content -->
</div>
</div>

</section>
<!-- akhir main -->