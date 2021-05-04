<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Beasiswa</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Google Font CDN -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/../css/style.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>

<body>
    <section id="main-login">
        <div class="container-fluid">
            <div class="row full-height">
                <div class="col-lg-7 bg-biru-gr shadow-lg p-5">
                </div>
                <div class="col-lg-5 p-5 my-auto">
                    <div class="row my-4">
                        <div class="col-lg-12 text-center">
                            <h1 class="card-title font-weight-bold">Login Admin</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if($validation != NULL): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong>
                                <?= $validation->listErrors(); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>
                            <form action="<?= base_url().'/login';?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="username" class="font-weight-bold">Username</label>
                                    <input type="text" class="form-control rounded-pill" id="username" name="username"
                                        placeholder="Masukkan username Anda" value="<?= set_value('username'); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="font-weight-bold">Password</label>
                                    <input type="password" class="form-control rounded-pill" id="password"
                                        name="password" placeholder="Masukkan password Anda">
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-primary bg-biru-gr rounded-pill mt-5 w-50 py-2 font-weight-bold">Login
                                        <i class="fas fa-chevron-circle-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>