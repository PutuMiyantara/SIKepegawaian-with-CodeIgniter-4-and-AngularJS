<body class="bg-gradient-light" ng-app="sikepegawaian">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-8 col-md-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row" ng-app="auth" ng-controller="auth">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <div>
                                            <img style="width: 100px; height: 80px;"
                                                src="/assets/foto/lambangdisdik.png">
                                            <img style="width: 78px; height: 78px;"
                                                src="/assets/foto/lambangklungkung.png">
                                        </div>
                                        <div>
                                            <h1 class="h4 text-gray-900 mb-4">Sistem Informasi Kepegawaian Dinas
                                                Pendidikan
                                                Kabupaten Klungkung</h1>
                                        </div>
                                    </div>
                                    <form class="user" name="myForm" ng-submit="login()">
                                        <div class="alert alert-danger alert-dismissable" ng-show="error">
                                            <a href="#" class="close" data-dismiss="alert"
                                                aria-label="close">&times;</a>{{message}}
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                aria-describedby="emailHelp" placeholder="Username" name="email"
                                                ng-model="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                placeholder="Password" name="password" ng-model="password">
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="reset"
                                                    class="btn btn-danger btn-user btn-block">Reset</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary btn-user btn-block"
                                                    name="login"><i class="fas fa-sign-in-alt"> Login</i></button>
                                            </div>
                                        </div>
                                    </form>
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