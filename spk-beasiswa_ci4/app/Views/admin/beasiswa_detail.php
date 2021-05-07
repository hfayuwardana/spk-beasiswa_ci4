<!-- content -->
<div class="col-lg-9 bg-white content py-3 mt-5">
    <div class="row h-100">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-body mt-1">
                    <h2 class="font-weight-bold text-biru-1"><?= esc($title); ?></h2>
                    <hr class="my-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold text-biru-2 m-0">Nama Beasiswa</h5>
                            <p><?= $bsw['nama_beasiswa']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold text-biru-2 m-0">Penyelenggara</h5>
                            <p><?= $bsw['nama_penyelenggara']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold text-biru-2 m-0">Tahun</h5>
                            <p><?= $bsw['tahun']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold text-biru-2 m-0">Kuota</h5>
                            <p><?= $bsw['kuota']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold text-biru-2 m-0">Status</h5>
                            <p><?= $bsw['status']; ?></p>
                        </div>
                    </div>
                    <div class="row mt-4 mb-3">
                        <div class="col-lg-12">
                            <a class="btn btn-primary btn-lihatKriteria rounded-pill"
                                href="<?= base_url() ?>/kriteria/<?= $bsw['id_beasiswa']; ?>" role="button">Lihat
                                Kriteria Beasiswa</a>
                        </div>
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