    <!-- Begin Page Content -->
    <div class="container-fluid" ng-controller="mutasi">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Mutasi</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data SK Mutasi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <a href="/mutasi/tambahSKMutasi" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                        style="margin-bottom: 10px;"><i class="fa fa-plus fa-sm text-white-50"></i>Tambah
                        Data</a>
                    <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-hover"
                        width="100%" ng-init="getSKMutasi()">
                        <thead>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">No SK Mutasi</th>
                                <th rowspan="2">Tanggal Mutasi</th>
                                <th colspan="2">Action</th>
                            </tr>
                            <tr>
                                <th>Show</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">No SK Mutasi</th>
                                <th rowspan="2">Tanggal Mutasi</th>
                                <th>Show</th>
                                <th>Edit</th>
                            </tr>
                            <tr style="text-align: center;">
                                <th colspan="2">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr ng-repeat="d in skmutasi">
                                <td>{{$index +1}}</td>
                                <td>{{d.no_sk}}</td>
                                <td>{{d.tgl_mutasi}}</td>
                                <td>
                                    <button type="button" class="btn btn-info"
                                        ng-click="toMutasi(d.id_mutasi)">Show</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary"
                                        ng-click="getDetailSKMutasi(d.id_mutasi)">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" tabindex="1" role="dialog" id="detailSkMutasi">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" name="skeditForm" ng-submit="editDataSKMutasi()">
                        <div class="modal-header">
                            <h4 class="modal-title" ng-model="modalTitle">{{modalTitle}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" ng-init="option()">
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                <a href="#" class="close" data-dismiss="alert"
                                    aria-label="close">&times;</a>{{errorMessage}}
                            </div>
                            <div class="form-group" ng-hide="hide">
                                <label>No SK Mutasi</label><br>
                                <small style="color: red;"
                                    ng-show="skeditForm.no_sk.$dirty && skeditForm.no_sk.$error.required">Data
                                    Masih
                                    Kosong</small>
                                <input type="text" class="form-control" name="no_sk" ng-model="no_sk" ng-required="true"
                                    ng-style="skeditForm.no_sk.$dirty && skeditForm.no_sk.$invalid && {'border':'solid red'}"
                                    ng-readonly="readOnly">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mutasi</label><br>
                                <small style="color: red;"
                                    ng-show="skeditForm.tgl_mutasi.$touched && skeditForm.tgl_mutasi.$error.required">Data
                                    Masih
                                    Kosong</small>
                                <input type="date" class="form-control" name="tgl_mutasi" ng-model="tgl_mutasi"
                                    ng-required="true"
                                    ng-style="skeditForm.tgl_mutasi.$dirty && skeditForm.tgl_mutasi.$invalid && {'border':'solid red'}"
                                    ng-readonly="readOnly">
                            </div>
                            <div class="modal-footer">
                                <input type="text" name="id_mutasi" ng-model="id_mutasi" ng-hide="false">
                                <button type="submit" class="btn btn-info col-sm-3 mb-6">Simpan</button>
                                <button type="button" class="btn btn-danger col-sm-3 mb-6"
                                    ng-click="actionbtnSkMutasi()">Kembali</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>