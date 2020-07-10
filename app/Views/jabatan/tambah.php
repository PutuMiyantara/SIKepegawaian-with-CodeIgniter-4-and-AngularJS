<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="jabatan">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah SKP</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <!-- CONTENT -->
        <div class="card">
            <div class="row">
                <div class="col-lg-6">
                    <div class="p-5">
                        <form class="user" name="myForm" ng-submit="insertData()" id="myForm" ng-model="myForm">
                            <div class="form-group">
                                <label>Nama Jabatan</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.namaJabatan.$touched && myForm.namaJabatan.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="namaJabatan" ng-model="namaJabatan"
                                    ng-required="true"
                                    ng-style="myForm.namaJabatan.$dirty && myForm.namaJabatan.$invalid && {'border':'solid red'}">
                            </div>
                            <input name="id_jabatan" ng-model="id_jabatan" ng-hide="false">
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
                                    <button type="submit" name="btnInsert"
                                        class="btn btn-success btn-block">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
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