    <!-- Begin Page Content -->
    <div class="container-fluid" ng-app="user" ng-controller="user">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah User</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4" ng-init="errorLastID()">
            <!-- CONTENT -->
            <div class="card">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="p-5" ng-submit="check()">
                            <form class="user" enctype="multipart/form-data" name="myForm" ng-submit="insertData()"
                                id="myForm">
                                <div class="alert alert-danger alert-dismissable" ng-show="error">
                                    <a href="#" class="close" data-dismiss="alert"
                                        aria-label="close">&times;</a>{{errorMessage}}
                                </div>
                                <div class="col-sm-12 mb-6 mb-sm-0">
                                    <div class="col"><label>Email</label><br>
                                        <small style="color: red;"
                                            ng-show="myForm.email.$touched && myForm.email.$error.required">Masukan
                                            Alamat Email</small>
                                        <small style="color: red;"
                                            ng-show="myForm.email.$dirty && myForm.email.$invalid">Masukan Email Yang
                                            Benar</small>
                                    </div>
                                    <div class="col-sm-12 mb-6 mb-sm-0">
                                        <div class="form-group row">
                                            <input type="text" class="form-control" name="email" ng-model="email"
                                                ng-required="true" ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/"
                                                ng-style="myForm.email.$dirty && myForm.email.$invalid && {'border':'solid red'}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-6 mb-sm-0">
                                    <div class="col">
                                        <label>Password</label><br>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <small style="color: red;"
                                                ng-show="myForm.password.$touched && myForm.password.$error.required">Masukan
                                                Password</small>
                                            <small style="color: red;"
                                                ng-show="myForm.password.$touched && myForm.password.$error.minlength">Minimal
                                                8 Karakter</small>
                                        </div>
                                        <div class="col-sm-6"><small ng-style="s_msg">{{msg}}</small></div>
                                        <div class="col-sm-6">
                                            <input type="{{typepass}}" name="password" class="form-control"
                                                placeholder="Password" ng-model="password" ng-change="check()"
                                                ng-style="spassword" ng-required="true" ng-minlength="8">
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="{{typepass}}" class="form-control" name="repass"
                                                placeholder="Repeat Password" ng-required="true" ng-model="repass"
                                                ng-change="check()" ng-style="srepass">
                                        </div>
                                        <div><span class="{{showHide}}" style="cursor: pointer; margin-top: 10px"
                                                ng-click="showPassword()" style="align-content: center"></span></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-6 mb-sm-0">
                                    <div class="col"><label>Status Pegawai</label></div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-6 mb-sm-0">
                                            <small style="color: red;"
                                                ng-show="myForm.role.$touched && myForm.role.$error.required">Pilih
                                                Status Pegawai</small>
                                            <select name="role" class="form-control" ng-model="role" ng-required="true"
                                                ng-style="myForm.role.$dirty && myForm.role.$invalid && {'border':'solid red'}">
                                                <option value="1">PNS</option>
                                                <option value="2">Kontrak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-6 mb-sm-0">
                                    <div class="col"><label>Foto</label><small style="color: red;"
                                            ng-show="myForm.file_foto.$touched && myForm.file_foto.$error.required">Pilih
                                            Status Pegawai</small></div>
                                    <div class="form-group row">
                                        <input type="file" class="form-control" ng-required="true" name="file_foto"
                                            file-input="files"
                                            onchange="angular.element(this).scope().filesChanged(this)" multiple>
                                    </div>
                                </div>
                                <input type="text" name="lastid" ng-model="lastid">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-12"></div>
                                    <div class="col-xl-6 col-lg-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <a class="btn btn-danger btn-block text-white" href="/user/">Kembali</a>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" name="btnInsert"
                                                    class="btn btn-success col-md-12">Simpan</button>
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