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
                        action="<?= ($method == 'edit') ? base_url('AdminController/updateBobot/'.$id_beasiswa.'/'.$id_kriteria.'/'.$bbt['id_bobot']) : base_url().'/bobot/insertBobot/'.$id_beasiswa.'/'.$id_kriteria; ?>"
                        method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php if($method == 'edit'): ?>
                                <input type="hidden" class="form-control" name="id_bobot" id="id_bobot"
                                    value="<?= ($method == 'edit') ? $bbt['id_bobot'] : ''; ?>">
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control rounded" id="keterangan" name="keterangan"
                                        placeholder="Masukkan keterangan"
                                        value="<?= ($method == 'edit') ? $bbt['keterangan'] : set_value('keterangan'); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="value">Value</label>
                                    <input type="number" class="form-control rounded" id="value" name="value"
                                        placeholder="Masukkan value"
                                        value="<?= ($method == 'edit') ? $bbt['value'] : set_value('value'); ?>" min="0"
                                        step="any">
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