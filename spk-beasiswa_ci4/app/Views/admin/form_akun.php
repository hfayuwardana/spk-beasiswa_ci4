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
                        action="<?= ($method == 'edit') ? base_url('AdminController/updateAkun/'.$user['id_akun']) : base_url().'/admin/insertAkun'; ?>"
                        method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php if($method == 'edit'): ?>
                                <input type="hidden" class="form-control" name="id_akun" id="id_akun"
                                    value="<?= ($method == 'edit') ? $user['id_akun'] : ''; ?>">
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <!-- Masukkan value username di sini -->
                                    <input type="text" class="form-control rounded" id="username" name="username"
                                        placeholder="Masukkan username"
                                        value="<?= ($method == 'edit') ? $user['username'] : set_value('username'); ?>"
                                        <?= ($method == 'edit') ? 'disabled' : '' ?>>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <!-- Masukkan value password di sini -->
                                    <input type="password" class="form-control rounded" id="password" name="password"
                                        placeholder="Masukkan password" value="<?= set_value('password'); ?>">
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