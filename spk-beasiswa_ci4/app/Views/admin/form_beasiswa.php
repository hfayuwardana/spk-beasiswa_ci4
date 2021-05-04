<!-- content -->
<div class="col-lg-9 bg-white content py-3 mt-5">
    <div class="row h-100">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-body mt-1">
                    <h2 class="font-weight-bold text-biru-1"><?= esc($title); ?></h2>
                    <hr class="my-5">
                    <?php if($validation != NULL): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong>
                        <?= $validation->listErrors(); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>
                    <form
                        action="<?= ($method == 'edit') ? base_url('AdminController/updateBeasiswa/'.$bsw['id_beasiswa']) : base_url().'/beasiswa/insertBeasiswa'; ?>"
                        method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php if($method == 'edit'): ?>
                                <input type="hidden" class="form-control" name="id_beasiswa" id="id_beasiswa"
                                    value="<?= ($method == 'edit') ? $bsw['id_beasiswa'] : ''; ?>">
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="nama_beasiswa">Nama Beasiswa</label>
                                    <input type="text" class="form-control rounded" id="nama_beasiswa"
                                        name="nama_beasiswa" placeholder="Masukkan nama beasiswa"
                                        value="<?= ($method == 'edit') ? $bsw['nama_beasiswa'] : set_value('nama_beasiswa'); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <?php if($method == 'edit'): ?>
                                <input type="hidden" class="form-control" name="id_beasiswa" id="id_beasiswa"
                                    value="<?= ($method == 'edit') ? $bsw['id_beasiswa'] : ''; ?>">
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="nama_penyelenggara">Nama Penyelenggara</label>
                                    <input type="text" class="form-control rounded" id="nama_penyelenggara"
                                        name="nama_penyelenggara" placeholder="Masukkan nama penyelenggara"
                                        value="<?= ($method == 'edit') ? $bsw['nama_penyelenggara'] : set_value('nama_penyelenggara'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="number" class="form-control rounded" id="tahun" name="tahun"
                                        placeholder="Masukkan tahun" min="2000"
                                        value="<?= ($method == 'edit') ? $bsw['tahun'] : set_value('tahun'); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kuota">Kuota</label>
                                    <input type="number" class="form-control rounded" id="kuota" name="kuota"
                                        placeholder="Masukkan kuota" min="1"
                                        value="<?= ($method == 'edit') ? $bsw['kuota'] : set_value('kuota'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn btn-primary bg-biru-gr rounded-pill mt-5 w-25 py-2 font-weight-bold">Kirim
                                <i class="fas fa-chevron-circle-right"></i>
                            </button>
                        </div>
                    </form>
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