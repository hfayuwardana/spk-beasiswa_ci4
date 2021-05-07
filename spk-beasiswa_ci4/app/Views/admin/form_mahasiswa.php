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
                        action="<?= ($method == 'edit') ? base_url('AdminController/updateMahasiswa/'.$mhs['id_mahasiswa']) : base_url().'/mahasiswa/insertMahasiswa'; ?>"
                        method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php if($method == 'edit'): ?>
                                <input type="hidden" class="form-control" name="id_mahasiswa" id="id_mahasiswa"
                                    value="<?= ($method == 'edit') ? $mhs['id_mahasiswa'] : ''; ?>">
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="nama_mhs">Nama Lengkap</label>
                                    <input type="text" class="form-control rounded" id="nama_mhs" name="nama_mhs"
                                        placeholder="Masukkan nama lengkap"
                                        value="<?= ($method == 'edit') ? $mhs['nama_mhs'] : set_value('nama_mhs'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control rounded" id="tempat_lahir"
                                        name="tempat_lahir" placeholder="Masukkan tempat lahir"
                                        value="<?= ($method == 'edit') ? $mhs['tempat_lahir'] : set_value('tempat_lahir'); ?>"
                                        aria-describedby="tempat_lahir-help">
                                    <small id="tempat_lahir-help" class="form-text text-muted">
                                        Contoh: Jakarta
                                    </small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control rounded" id="tgl_lahir" name="tgl_lahir"
                                        value="<?= ($method == 'edit') ? $mhs['tgl_lahir'] : set_value('tgl_lahir'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control rounded" id="alamat" name="alamat"
                                        placeholder="Masukkan alamat"
                                        rows="3"><?= ($method == 'edit') ? $mhs['alamat'] : set_value('alamat'); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" class="form-control rounded" id="nim" name="nim"
                                        placeholder="Masukkan NIM"
                                        value="<?= ($method == 'edit') ? $mhs['nim'] : set_value('nim'); ?>"
                                        <?= ($method == 'edit') ? 'disabled' : '' ?>>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select class="form-control rounded" id="semester" name="semester">
                                        <option disabled selected>-Pilih semester -</option>
                                        <option value="3"
                                            <?= (($method == 'edit') AND ($mhs['semester'] == "3"))  ? 'selected' : (set_value('semester') == '3' ? 'selected' : '') ; ?>>
                                            3</option>
                                        <option value="4"
                                            <?= (($method == 'edit') AND ($mhs['semester'] == "4"))  ? 'selected' : (set_value('semester') == '4' ? 'selected' : '') ; ?>>
                                            4</option>
                                        <option value="5"
                                            <?= (($method == 'edit') AND ($mhs['semester'] == "5"))  ? 'selected' : (set_value('semester') == '5' ? 'selected' : '') ; ?>>
                                            5</option>
                                        <option value="6"
                                            <?= (($method == 'edit') AND ($mhs['semester'] == "6"))  ? 'selected' : (set_value('semester') == '6' ? 'selected' : '') ; ?>>
                                            6</option>
                                        <option value="7"
                                            <?= (($method == 'edit') AND ($mhs['semester'] == "7"))  ? 'selected' : (set_value('semester') == '7' ? 'selected' : '') ; ?>>
                                            7</option>
                                        <option value="6"
                                            <?= (($method == 'edit') AND ($mhs['semester'] == "8"))  ? 'selected' : (set_value('semester') == '8' ? 'selected' : '') ; ?>>
                                            8</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_ibu">Nama Ibu</label>
                                    <input type="text" class="form-control rounded" id="nama_ibu" name="nama_ibu"
                                        placeholder="Masukkan nama ibu"
                                        value="<?= ($method == 'edit') ? $mhs['nama_ibu'] : set_value('nama_ibu'); ?>"
                                        aria-describedby="nama_ibu-help">
                                    <small id="nama_ibu-help" class="form-text text-muted">
                                        Contoh: Siti Kusmini
                                    </small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="penghasilan_ortu">Penghasilan Orangtua <small>(dalam
                                            sebulan)</small></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control rounded" id="penghasilan_ortu"
                                            name="penghasilan_ortu" placeholder="Masukkan penghasilan orangtua"
                                            value="<?= ($method == 'edit') ? $mhs['penghasilan_ortu'] : set_value('penghasilan_ortu'); ?>"
                                            aria-describedby="penghasilan_ortu-help" step="any" min=0>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="gol_darah">Golongan Darah</label>
                                    <select class="form-control rounded" id="gol_darah" name="gol_darah">
                                        <option disabled selected>-Pilih golongan darah -</option>
                                        <option value="A"
                                            <?= (($method == 'edit') AND ($mhs['gol_darah'] == "A"))  ? 'selected' : (set_value('gol_darah') == 'A' ? 'selected' : '') ; ?>>
                                            A</option>
                                        <option value="B"
                                            <?= (($method == 'edit') AND ($mhs['gol_darah'] == "B"))  ? 'selected' : (set_value('gol_darah') == 'B' ? 'selected' : '') ; ?>>
                                            B</option>
                                        <option value="AB"
                                            <?= (($method == 'edit') AND ($mhs['gol_darah'] == "AB"))  ? 'selected' : (set_value('gol_darah') == 'AB' ? 'selected' : '') ; ?>>
                                            AB</option>
                                        <option value="O"
                                            <?= (($method == 'edit') AND ($mhs['gol_darah'] == "O"))  ? 'selected' : (set_value('gol_darah') == 'O' ? 'selected' : '') ; ?>>
                                            O</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jml_saudara">Jumlah Saudara</label>
                                    <input type="number" class="form-control rounded" id="jml_saudara"
                                        name="jml_saudara" placeholder="Masukkan jumlah saudara"
                                        value="<?= ($method == 'edit') ? $mhs['jml_saudara'] : set_value('jml_saudara'); ?>"
                                        aria-describedby="jml_saudara-help" min=0>
                                    <small id="jml_saudara-help" class="form-text text-muted">
                                        Jika tidak ada isikan dengan angka 0
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ipk">IPK</label>
                                    <input type="number" class="form-control rounded" id="ipk" name="ipk"
                                        placeholder="Masukkan IPK"
                                        value="<?= ($method == 'edit') ? $mhs['ipk'] : set_value('ipk'); ?>"
                                        aria-describedby="ipk-help" min=0 step=0.01>
                                    <small id="ipk-help" class="form-text text-muted">
                                        Contoh: 3.99
                                    </small>
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