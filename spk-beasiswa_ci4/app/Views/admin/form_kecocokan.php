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
                        action="<?= ($method == 'tampil') ? base_url().'/kecocokan/insertKecocokan/tampil' : base_url().'/kecocokan/insertKecocokan/create'; ?>"
                        method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <!-- untuk mengisi id_beasiswa -->
                                    <label for="id_beasiswa">Nama beasiswa</label>
                                    <select class="form-control rounded" id="id_beasiswa" name="id_beasiswa">
                                        <?php if($method == 'tampil'): ?>
                                        <option disabled selected>- Pilih beasiswa -</option>
                                        <?php foreach($beasiswa as $bsw): ?>
                                        <option value="<?= $bsw['id_beasiswa']; ?>">
                                            <?= $bsw['nama_beasiswa']; ?> -
                                            <?= $bsw['nama_penyelenggara']; ?> - <?= $bsw['tahun']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <option disabled selected value=<?= $id_beasiswa; ?>>
                                            <?= $bsw['nama_beasiswa']; ?> -
                                            <?= $bsw['nama_penyelenggara']; ?> - <?= $bsw['tahun']; ?></option>
                                        <input type="hidden" class="form-control" name="id_beasiswa" id="id_beasiswa"
                                            value="<?= $id_beasiswa; ?>">
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <!-- untuk mengisi id_mahasiswa -->
                                    <label for="id_mahasiswa">Nama Mahasiswa</label>
                                    <select class="form-control rounded" id="id_mahasiswa" name="id_mahasiswa">
                                        <?php if($method == 'tampil'): ?>
                                        <option disabled selected>- Pilih mahasiswa -</option>
                                        <?php foreach($mahasiswa as $mhs): ?>
                                        <option value="<?= $mhs['id_mahasiswa']; ?>">
                                            <?= $mhs['nama_mhs']; ?> -
                                            <?= $mhs['nim']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <option disabled selected value=<?= $id_mahasiswa; ?>>
                                            <?= $mhs['nama_mhs']; ?> -
                                            <?= $mhs['nim']; ?></option>
                                        <input type="hidden" class="form-control" name="id_mahasiswa" id="id_mahasiswa"
                                            value="<?= $id_mahasiswa; ?>">
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php if($method == 'create'): ?>
                        <?php
                            $ipk = $mhs['ipk'];
                            $semester = $mhs['semester'];
                            $penghasilan_ortu = $mhs['penghasilan_ortu'];
                            $jml_saudara = $mhs['jml_saudara'];

                            $count = 0;
                            $data_mhs = [
                                0 => $ipk,
                                1 => $semester,
                                2 => $penghasilan_ortu,
                                3 => $jml_saudara,
                            ];
                        ?>
                        <?php foreach($kriteria as $krt): ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <!-- untuk mengisi id_kriteria. catatan: id_kriteria nya dalam bentuk array -->
                                    <input type="hidden" class="form-control" name="id_kriteria[<?= $count; ?>]"
                                        id="id_kriteria" value="<?= $krt['id_kriteria']; ?>">
                                    <!-- untuk mengisi nilai. catatan: nilainya nya dalam bentuk array -->
                                    <label for="nilai"><?= $krt['nama_kriteria']; ?>
                                        <span class="font-weight-bold">(<?= $data_mhs[$count]; ?>)</span></label>
                                    <select class="form-control rounded" id="nilai" name="nilai[<?= $count ?>]">
                                        <option disabled selected value="0">- Pilih bobot -</option>
                                        <?php foreach($bobot as $bbt): ?>
                                        <?php if($bbt['id_kriteria'] == $krt['id_kriteria']): ?>
                                        <option value="<?= $bbt['value']; ?>"
                                            <?= set_value('nilai[$count]')== $bbt['value'] ? 'selected' : '' ?>>
                                            <?= $bbt['keterangan']; ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php $count++; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn btn-primary bg-biru-gr rounded-pill mt-5 w-25 py-2 font-weight-bold"><?= ($method == 'tampil') ? 'Tampilkan' : 'Kirim'; ?>
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