<!-- content -->
<div class="col-lg-9 bg-white content py-3">
    <div class="row">
        <div class="col-lg-12">

        </div>
    </div>
    <div class="row h-100">
        <div class="col-lg-12 text-center my-auto pb-5">
            <div>
                <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif; ?>
            </div>
            <div>
                <i class="fas fa-graduation-cap fa-3x mr-3"></i>
                <h2 class="display-4">Selamat Datang</h2>
                <h2>di website Sistem Pendukung Keputusan (SPK) </br>Penerima Beasiswa</h2>
            </div>
        </div>
    </div>
</div>
<!-- akhir content -->
</div>
</div>

</section>
<!-- akhir main -->