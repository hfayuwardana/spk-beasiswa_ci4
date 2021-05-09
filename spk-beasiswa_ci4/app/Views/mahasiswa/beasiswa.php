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
            <a href="home.htm">Beranda</a>
        </div>
    </div>

    <div class="databeasiswa-box">
        <h3>Daftar Beasiswa</h3>
        <hr>
        <form action="">
            <input type="text" name="" id="" placeholder="Cari beasiswa">
            <i class="fas fa-search"></i>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Beasiswa</th>
                    <th scope="col">Tenggat Waktu</th>
                    <th scope="col">Nama Penyelenggara</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Beasiswa Djarum</td>
                    <td>2 November 2021</td>
                    <td>PT. Djarum</td>
                    <td class="act">
                        <i class="fas fa-eye"></i>
                        <a href="detail_mhs.htm">Detail</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>