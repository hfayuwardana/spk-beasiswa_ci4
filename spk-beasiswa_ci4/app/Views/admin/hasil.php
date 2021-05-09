<!-- content -->
<div class="col-lg-9 bg-white content py-3 mt-5">
    <div class="row h-100">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-body mt-1">
                    <h2 class="font-weight-bold text-biru-1">Data Mahasiswa pada Hasil</h2>
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

                    <div class="table-responsive">
                        <table class="table mt-4 text-center">
                            <thead class="bg-biru-gr text-white">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama Mahasiswa</th>
                                    <th scope="col">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($hasil as $hsl): ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $hsl['nim']; ?></td>
                                    <td><?= $hsl['nama_mhs']; ?></td>
                                    <td><?= number_format((float) $hsl['ranking'], 8, '.', ''); ?></td>
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