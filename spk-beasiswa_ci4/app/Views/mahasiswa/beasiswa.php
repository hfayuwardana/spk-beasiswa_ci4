<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url(); ?>/../css/style2.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;
    0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;
    1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;
    1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6f806aef63.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <title>Daftar Beasiswa</title>
</head>

<body class="bg">
    <div class="navv">
        <div class="menu">
            <a href="<?= base_url().'/'; ?>">Beranda</a>
        </div>
    </div>

    <div class="databeasiswa-box">
        <h3>Daftar Beasiswa</h3>
        <hr>
        <form action="<?= base_url().'/mhs/cariBeasiswa'; ?>" method="get">
            <input type="text" name="searchBeasiswa" id="searchBeasiswa" placeholder="Cari beasiswa">
            <i class="fas fa-search"></i>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Beasiswa</th>
                    <th scope="col">Nama Penyelenggara</th>
                    <th scope="col">Nama Penyelenggara</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach($beasiswa as $bsw): ?>
                <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $bsw['nama_beasiswa']; ?></td>
                    <td><?= $bsw['nama_penyelenggara']; ?></td>
                    <td><?= $bsw['tahun']; ?></td>
                    <td class="act">
                        <a href="<?= base_url().'/mhs/lolos/'.$bsw['id_beasiswa']; ?>">Detail</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>