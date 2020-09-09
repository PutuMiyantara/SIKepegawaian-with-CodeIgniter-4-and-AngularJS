<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="pangkat">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Pangkat</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <!-- CONTENT -->
        <div class="card">
            <div class="row">
                <div class="col-lg-6">
                    <div class="p-5">
                        <form class="user" name="formPangkat" ng-submit="insertData()" id="fomTambahPangkat"
                            ng-model="formPangkat">
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                            <div class="form-group">
                                <label>Nama Pangkat</label><br>
                                <small style="color: red;"
                                    ng-show="formPangkat.namaPangkat.$touched && formPangkat.namaPangkat.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="namaPangkat" ng-model="namaPangkat"
                                    ng-required="false"
                                    ng-style="formPangkat.namaPangkat.$dirty && formPangkat.namaPangkat.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Golongan</label><br>
                                <small style="color: red;"
                                    ng-show="formPangkat.golongan.$touched && formPangkat.golongan.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="golongan" ng-model="golongan"
                                    ng-required="false"
                                    ng-style="formPangkat.golongan.$dirty && formPangkat.golongan.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Ruang</label><br>
                                <small style="color: red;"
                                    ng-show="formPangkat.ruang.$touched && formPangkat.ruang.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="ruang" ng-model="ruang"
                                    ng-required="false"
                                    ng-style="formPangkat.ruang.$dirty && formPangkat.ruang.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12"></div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-danger btn-block"
                                                ng-click="bckTo()">Kembali</button>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" name="btnInsert" class="btn btn-success btn-block"><i
                                                    class="fas fa-save"> Simpan</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT -->
</div>

<!-- /.container-fluid -->
<!-- <script>
    var app = angular.module('test', ['datatables']);

    app.controller('ctest', function($scope, $http) {
        $http.get('/ajax/pegawai/').success(function(data, status, headers, config) {
            $scope.datas = data;
        });
    });
</script> -->