<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="user">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data User</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="/user/tambah" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                    style="margin-bottom: 10px;"><i class="fas fa-plus fa-sm text-white-50"></i>Tambah
                    Data</a>
                <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered" width="100%"
                    cellspacing="0" ng-init="getUser()">
                    <thead>
                        <tr style="text-align: center;">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr ng-repeat="d in datas">
                            <td>{{ $index +1 }}</td>
                            <td>{{ d.nama }}</td>
                            <td>{{ d.email }}</td>
                            <td ng-if="d.status == '1'">Aktif</td>
                            <td ng-if="d.status == '2'">Tidak Aktif</td>
                            <td style="text-align: center;">
                                <button type="submit" class="btn btn-info" ng-click="getDetail(d.id_user)"><i
                                        class="fa fa-edit"> Detail</i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" tabindex="1" role="dialog" id="detailEditUser">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" name="formUser" id="formDetailUser"
                    ng-submit="editData()">
                    <div class="modal-header">
                        <h4 class="modal-title" ng-model="modalTitle">{{modalTitle}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                            <div class="alert alert-success alert-dismissable" ng-show="success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Nama</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="nama" ng-model="nama"
                                        ng-required="true" ng-readonly="true">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Status Pegawai</label></div>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-6 mb-sm-0">
                                    <select name="role" class="form-control" ng-model="role" ng-required="true"
                                        ng-disabled="true">
                                        <option value="1">PNS</option>
                                        <option value="2">Kontrak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Email</label><br>
                                <small style="color: red;"
                                    ng-show="formUser.email.$touched && formUser.email.$error.required">Masukan Alamat
                                    Email</small>
                                <small style="color: red;"
                                    ng-show="formUser.email.$dirty && formUser.email.$error.email">Masukan Email dengan
                                    Benar</small>
                            </div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="email" class="form-control" name="email" ng-model="email"
                                        ng-required="true"
                                        ng-style="formUser.email.$dirty && formUser.email.$invalid && {'border':'solid red'}"
                                        ng-readonly="readOnly">
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
                                        ng-show="formUser.password.$touched && formUser.password.$error.required">Masukan
                                        Password</small>
                                    <small style="color: red;"
                                        ng-if="formUser.password.$dirty && password.length < 8">Minimal
                                        8 Karakter</small>
                                </div>
                                <div class="col-sm-6"><small ng-style="s_msg">{{msg}}</small></div>
                                <div class="col-sm-6">
                                    <input type="{{typepass}}" name="password" class="form-control"
                                        placeholder="Password" ng-model="password" ng-change="check()"
                                        ng-style="spassword">
                                </div>
                                <div class="col-sm-5">
                                    <input type="{{typepass}}" class="form-control" name="repass"
                                        placeholder="Repeat Password" ng-model="repass" ng-change="check()"
                                        ng-style="srepass">
                                </div>
                                <div><span class="{{showHide}}" style="cursor: pointer; margin-top: 10px"
                                        ng-click="showPassword()" style="align-content: center"></span></div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Status Aktif</label></div>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-6 mb-sm-0">
                                    <small style="color: red;"
                                        ng-show="formUser.status.$touched && formUser.status.$error.required">Pilih
                                        Status Aktif Pegawai</small>
                                    <select name="status" class="form-control" ng-model="status" ng-required="true"
                                        ng-disabled="readOnly">
                                        <option value="1">Aktif</option>
                                        <option value="2">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Foto</label></div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <img style="width: 80px; height: 100px;" src="{{foto}}" ng-hide="false"
                                        class="img-thumbnail">
                                </div>
                                <div class="col-9">
                                    <input type="file" class="form-control" name="file_foto" file-input="files"
                                        onchange="angular.element(this).scope().filesChanged(this)" multiple>
                                </div>
                            </div>
                        </div>
                        <!-- <li ng-repeat="file in files">{{file.name}}</li> -->
                    </div>
                    <div class="modal-footer">
                        <input type="text" name="idUser" ng-model="iduser" ng-hide="true">
                        <!-- <input type="text" name="file_lama" ng-model="file_lama" ng-hide="false"> -->
                        <button type="submit" class="btn btn-success col-sm-3 mb-6"><i class="fas fa-save">
                                Update</i></button>
                        <button type="button" class="btn btn-danger col-sm-3 mb-6"
                            ng-click="closeModal('#detailEditUser')">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
</div>