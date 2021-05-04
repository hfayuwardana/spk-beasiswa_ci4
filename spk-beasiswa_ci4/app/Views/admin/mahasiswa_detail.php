<!-- content -->
<div class="col-lg-9 bg-white content py-3 mt-5">
    <div class="row h-100">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-body mt-1">
                    <h2 class="font-weight-bold text-biru-1"><?= esc($title); ?></h2>
                    <hr class="my-5">
                    <div class="row">
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-user-alt fa-8x"></i>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6 class="font-weight-bold m-0">Nama Lengkap</h6>
                                    <p><?= $mhs['nama_mhs']; ?></p>
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="font-weight-bold text-biru-2">Informasi Studi</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6 class="font-weight-bold m-0">Tempat, Tanggal Lahir</h6>
                                    <p><?= $mhs['tempat_lahir']; ?>, <?= $mhs['tgl_lahir']; ?></p>
                                </div>
                                <div class="col-lg-6">
                                    <h6 class="font-weight-bold m-0">NIM</h6>
                                    <p><?= $mhs['nim']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6 class="font-weight-bold m-0">Alamat</h6>
                                    <p><?= $mhs['alamat']; ?></p>
                                </div>
                                <div class="col-lg-6">
                                    <h6 class="font-weight-bold m-0">Semester</h6>
                                    <p><?= $mhs['semester']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6 class="font-weight-bold m-0">Nama Ibu</h6>
                                    <p><?= $mhs['nama_ibu']; ?></p>
                                </div>
                                <div class="col-lg-6">
                                    <h6 class="font-weight-bold m-0">IPK</h6>
                                    <p><?= $mhs['ipk']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6 class="font-weight-bold m-0">Golongan Darah</h6>
                                    <p><?= $mhs['gol_darah']; ?></p>
                                </div>
                                <div class="col-lg-6">
                                    <h6 class="font-weight-bold m-0">Penghasilan Orangtua</h6>
                                    <p>Rp. <?= $mhs['penghasilan_ortu']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6">
                                    <h6 class="font-weight-bold m-0">Jumlah Saudara</h6>
                                    <p><?= $mhs['jml_saudara']; ?> orang</p>
                                </div>
                            </div>
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