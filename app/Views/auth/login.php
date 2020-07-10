<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>
    <script src="<?= base_url('assets/angularjs/angular.js') ?>"></script>
    <script src="<?= base_url('assets/angularjs/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/angularjs/angular.js') ?>"></script>
    <script src="<?= base_url('assets/angularjs/angular-datatables.min.js') ?>"></script>
    <script src="<?= base_url('assets/angularjs/jquery.dataTables.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/angular/sikepegawaian.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/angular/auth.js'); ?>"></script>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('/assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?= base_url('/assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>

<body class="bg-gradient-light" ng-app="sikepegawaian">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row" ng-app="auth" ng-controller="auth">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Sistem Informasi Kepegawaian Dinas Pendidikan
                                            Kabupaten Klungkung</h1>
                                    </div>
                                    <form class="user" name="myForm" action="<?= base_url('/login') ?>" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                aria-describedby="emailHelp" placeholder="Username" name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                placeholder="Password" name="password">
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="reset"
                                                    class="btn btn-danger btn-user btn-block">Reset</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary btn-user btn-block"
                                                    name="login">Login</button>

                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('/assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('/assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('/assets/js/sb-admin-2.min.js') ?>"></script>

</body>

</html>