    <!-- Begin Page Content -->
    <div class="container-fluid" ng-controller="jabatan">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Jabatan</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Jabatan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div style="margin-bottom:10px;" class="row">
                        <div class="col-lg-10 col-sm-12">
                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><a
                                    href="/jabatan/tambah" style="margin-bottom: 10px; color:white;"><i
                                        class="fa fa-plus fa-sm text-white"></i>Tambah
                                    Data</a></button>
                        </div>
                    </div>
                    <div class="alert alert-danger alert-dismissable" ng-show="errorDell">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                    </div>
                    <div class="alert alert-success alert-dismissable" ng-show="successDell">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                    </div>
                    <table ng-init="getJabatan()" datatable="ng" dt-options="vm.dtOptions"
                        class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Jabatan</th>
                                <th colspan="2">Action</th>
                            </tr>
                            <tr style="text-align: center;">
                                <th>Detail</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Jabatan</th>
                                <th>Detail</th>
                                <th>Hapus</th>
                            </tr>
                            <tr style="text-align: center;">
                                <th colspan="2">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr ng-repeat="d in datas">
                                <td style="width: 100px; padding: auto">{{ $index +1 }}</td>
                                <td>{{ d.nama_jabatan }}</td>
                                <td class="text-center" style="width: 100px; padding: auto">
                                    <button type="submit" class="btn btn-info" ng-click="getDetail(d.id_jabatan)"><i
                                            class="fas fa-edit"> Detail</i></button>
                                </td>
                                <td class="text-center" style="width: 100px; padding: auto">
                                    <button type="submit" class="btn btn-danger"
                                        ng-click="deleteJabatan(d.id_jabatan)"><i class="fas fa-trash-alt">
                                            Hapus</i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" tabindex="1" role="dialog" id="detailJabatan">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" name="formJabatan" id="formDetailJabatan" ng-submit="editData()">
                        <div class="modal-header">
                            <h4 class="modal-title" ng-model="modalTitle">{{modalTitle}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                            <div class="alert alert-success alert-dismissable" ng-show="success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                            <div class="form-group">
                                <label>Nama Jabatan</label><br>
                                <small style="color: red;"
                                    ng-show="formJabatan.namaJabatan.$touched && formJabatan.namaJabatan.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="namaJabatan" ng-model="namaJabatan"
                                    ng-required="true"
                                    ng-style="formJabatan.namaJabatan.$dirty && formJabatan.namaJabatan.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="text" name="id_jabatan" ng-model="id_jabatan" ng-hide="true">
                            <button type="submit" class="btn btn-info col-sm-3 mb-6"><i class="fas fa-save">
                                    Update</i></button>
                            <button type="button" class="btn btn-danger col-sm-3 mb-6"
                                ng-click="closeModal('#detailJabatan')">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>