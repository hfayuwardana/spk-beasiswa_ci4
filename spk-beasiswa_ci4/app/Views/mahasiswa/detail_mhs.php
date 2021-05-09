<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url(); ?>/../css/style2.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;
    0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;
    1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;
    1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Detail Data Mahasiswa</title>
</head>

<body class="bg">
    <div class="navv">
        <div class="menu">
            <a href="#">Beranda</a>
        </div>
    </div>

    <div class="detail-box">
        <h3>Detail Data Mahasiswa</h3>
        <hr>
        <div class="content">
            <div class="ct gambar">
                <img src="<?= base_url(); ?>/../img/profile.png" alt="">
            </div>
            <div class="ct personal">
                <h4 style="margin-top: 10px;">Nama Lengkap</h4>
                <p><?= $data; ?></p>
                <h4>Tempat, Tanggal Lahir</h4>
                <h4>Alamat</h4>
                <h4>Nama Ibu</h4>
                <h4>Golongan Darah</h4>
                <h4>Penghasilan Orangtua</h4>
                <h4>Jumlah Saudara</h4>
            </div>
            <div class="ct info-studi">
                <h3>Informasi Studi</h3>
                <h4>NIM</h4>
                <h4>Semester</h4>
                <h4>IPK</h4>
            </div>
        </div>
        <a href="home.htm">Kembali ke Beranda</a>
        <br>
        <br>
        <br>
        <p style="margin-bottom: 10px; margin-top: 10px; padding-left: 20px">Jika terdapat kesalahan pada data
            mahasiswa, silakan hubungi admin SPK melalui email : adminspk@upi.edu</p>
    </div>

</body>

</html>