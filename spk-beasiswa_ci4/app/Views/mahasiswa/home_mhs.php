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
    <title>Home</title>
</head>

<body>
    <div class="navv">
        <div class="menu">
            <a href="#infoweb">Informasi Web</a>
        </div>
    </div>

    <div class="header">
        <div class="welcome">
            <h1>SISTEM PENDUKUNG KEPUTUSAN BEASISWA</h1>
            <h2>di Departemen Ilmu Komputer <br>
                Universitas Pendidikan Indonesia</h2>
        </div>
        <div class="tombol">
            <a href="<?= base_url().'/mhs/verifikasi'; ?>" class="verif">Cek Data Pribadi</a>
            <a href="<?= base_url().'/mhs/beasiswa'; ?>" class="pengumuman">Pengumuman Beasiswa</a>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#375F9D" fill-opacity="1" d="M0,224L30,202.7C60,181,120,
            139,180,133.3C240,128,300,160,360,149.3C420,139,480,85,540,64C600,43,
            660,53,720,58.7C780,64,840,64,900,96C960,128,1020,192,1080,197.3C1140,
            203,1200,149,1260,138.7C1320,128,1380,160,1410,176L1440,192L1440,0L1410,
            0C1380,0,1320,0,1260,0C1200,0,1140,0,1080,0C1020,0,960,0,900,0C840,0,780,
            0,720,0C660,0,600,0,540,0C480,0,420,0,360,0C300,0,240,0,180,0C120,0,60,0,
            30,0L0,0Z"></path>
        </svg>
    </div>

    <div id="infoweb" class="infoweb">
        <h1>Informasi Web</h1>

        <div class="info">
            <img src="gambar/book.png" alt="">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Rerum deleniti harum aperiam, aliquid maxime distinctio temporibus
                soluta, quasi, quibusdam quia ea est assumenda non excepturi? Recusandae
                odit delectus optio omnis!</p>
        </div>
    </div>

    <div class="footer-box">
        <div class="footer">
            <div class="spk">
                <h3>Sistem Pendukung <br> Keputusan Beasiswa</h3>
                <h5>Universitas Pendidikan Indonesia</h5>
            </div>
            <div class="kontak">
                <h4>Kontak</h4>
                <p>08X-XXXX-XXXX</p>
                <br>
                <h4>E-mail</h4>
                <p>adminspk@gmail.com</p>
            </div>
        </div>
        <h6>Ayu Allifia Prilla | &copy; 2021</h6>
    </div>
</body>

</html>