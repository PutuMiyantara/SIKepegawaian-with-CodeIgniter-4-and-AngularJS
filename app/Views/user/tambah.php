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
                        <div class="p-5">
                            <form class="user" method="POST" enctype="multipart/form-data" name="fomUser"
                                ng-submit="insertData()" id="formTambahUser">
                                <div class="alert alert-danger alert-dismissable" ng-show="error">
                                    <a href="#" class="close" data-dismiss="alert"
                                        aria-label="close">&times;</a>{{message}}
                                </div>
                                <div class="col-sm-12 mb-6 mb-sm-0">
                                    <div class="col"><label>Email</label><br>
                                        <small style="color: red;"
                                            ng-show="fomUser.touched.$touched && fomUser.email.$error.required">Masukan
                                            Alamat Email</small>
                                        <small style="color: red;"
                                            ng-show="fomUser.email.$dirty && fomUser.email.$error.email">Masukan
                                            Email Yang
                                            Benar</small>
                                    </div>
                                    <div class="col-sm-12 mb-6 mb-sm-0">
                                        <div class="form-group row">
                                            <input type="email" class="form-control" name="email" ng-model="email"
                                                ng-required="true"
                                                ng-style="fomUser.email.$dirty && fomUser.email.$invalid && {'border':'solid red'}">
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
                                                ng-show="fomUser.password.$touched && fomUser.password.$error.required">Masukan
                                                Password</small>
                                            <small style="color: red;"
                                                ng-show="fomUser.password.$touched && fomUser.password.$error.minlength">Minimal
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
                                    <div class="col"><label>Foto</label><small style="color: red;"
                                            ng-show="fomUser.file_foto.$touched && fomUser.file_foto.$error.required">Pilih
                                            Foto Pegawai</small></div>
                                    <div class="form-group row">
                                        <input type="file" class="form-control" ng-required="true" name="file_foto"
                                            file-input="files"
                                            onchange="angular.element(this).scope().filesChanged(this)" multiple>
                                    </div>
                                </div>
                                <input type="text" name="lastid" ng-model="lastid" ng-hide="true">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-12"></div>
                                    <div class="col-xl-6 col-lg-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <a class="btn btn-danger btn-block text-white" href="/user/">Kembali</a>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" name="btnInsert"
                                                    class="btn btn-success col-md-12"><i class="fas fa-save">
                                                        Simpan</i></button>
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