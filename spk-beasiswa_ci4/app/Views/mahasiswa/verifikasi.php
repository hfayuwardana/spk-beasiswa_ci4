<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url(); ?>/../css/style2.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;
    0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;
    1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;
    1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Verifikasi Data Mahasiswa</title>
</head>

<body class="bg2">
    <div class="navv">
        <div class="menu">
            <a href="home.htm">Beranda</a>
        </div>
    </div>
    <div class="verifikasi">
        <h3>Verifikasi dan Validasi Data Mahasiswa</h3>
        <h4>Cari Data Mahasiswa</h4>
        <form action="<?= base_url().'/mhs/detailMahasiswa'; ?>" method="post">
            <div class="inputt">
                <label for="nim">Masukkan NIM</label>
                <input type="text" name="nim" id="nim">

                <label for="nama_ibu">Masukkan Nama Ibu</label>
                <input type="text" name="nama_ibu" id="nama_ibu">

                <label for="tgl_lahir">Masukkan Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" id="tgl_lahir">
            </div>

            <button>Kirim</button>
        </form>
    </div>
</body>

</html>