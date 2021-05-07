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
                        action="<?= ($method == 'edit') ? base_url('AdminController/updateKriteria/'.$id_beasiswa.'/'.$krt['id_kriteria']) : base_url().'/kriteria/insertKriteria/'.$id_beasiswa; ?>"
                        method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php if($method == 'edit'): ?>
                                <input type="hidden" class="form-control" name="id_kriteria" id="id_kriteria"
                                    value="<?= ($method == 'edit') ? $krt['id_kriteria'] : ''; ?>">
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="nama_kriteria">Nama Kriteria</label>
                                    <input type="text" class="form-control rounded" id="nama_kriteria"
                                        name="nama_kriteria" placeholder="Masukkan nama kriteria"
                                        value="<?= ($method == 'edit') ? $krt['nama_kriteria'] : set_value('nama_kriteria'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="sifat">Sifat</label>
                                    <select class="form-control rounded" id="sifat" name="sifat">
                                        <option disabled selected>-Pilih sifat -</option>
                                        <option value="Min"
                                            <?= (($method == 'edit') AND ($krt['sifat'] == "Min"))  ? 'selected' : (set_value('sifat') == 'Min' ? 'selected' : '') ; ?>>
                                            Min</option>
                                        <option value="Max"
                                            <?= (($method == 'edit') AND ($krt['sifat'] == "Max"))  ? 'selected' : (set_value('sifat') == 'Max' ? 'selected' : '') ; ?>>
                                            Max</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bobot">Bobot</label>
                                    <input type="number" class="form-control rounded" id="bobot" name="bobot"
                                        placeholder="Masukkan bobot" min="0" step="0.01"
                                        value="<?= ($method == 'edit') ? $krt['bobot'] : set_value('bobot'); ?>">
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