    <!-- Begin Page Content -->
    <div class="container-fluid" ng-controller="pangkat">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Pangkat</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4" ng-init="getPangkat()">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pangkat</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div style="margin-bottom:10px;" class="row">
                        <div class="col-lg-10 col-sm-12">
                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><a
                                    href="/pangkat/tambah" style="margin-bottom: 10px; color:white;"><i
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
                    <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-hover"
                        width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Pangkat</th>
                                <th rowspan="2">Golongan</th>
                                <th rowspan="2">Ruang</th>
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
                                <th rowspan="2">Nama Pangkat</th>
                                <th rowspan="2">Golongan</th>
                                <th rowspan="2">Ruang</th>
                                <th>Detail</th>
                                <th>Hapus</th>
                            </tr>
                            <tr style="text-align: center;">
                                <th colspan="2">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr ng-repeat="d in datas">
                                <td>{{ $index +1 }}</td>
                                <td>{{ d.nama_pangkat }}</td>
                                <td>{{ d.golongan }}</td>
                                <td>{{ d.ruang }}</td>
                                </td>
                                <td style="width: 100px; padding: auto">
                                    <button type="button" class="btn btn-info" ng-click="getDetail(d.id_pangkat)"><i
                                            class="fas fa-edit">Detail</i></button>
                                </td>
                                <td style="width: 100px; padding: auto">
                                    <button type="button" class="btn btn-danger"
                                        ng-click="deletePangkat(d.id_pangkat)"><i class="fas fa-trash-alt">
                                            Hapus</i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" tabindex="1" role="dialog" id="detailPangkat">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" name="formPangkat" id="formDetailPangkat" ng-submit="editData()">
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
                                <label>Nama Pangkat</label><br>
                                <small style="color: red;"
                                    ng-show="formPangkat.namaPangkat.$touched && formPangkat.namaPangkat.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="namaPangkat" ng-model="namaPangkat"
                                    ng-required="true"
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
                        </div>
                        <div class="modal-footer">
                            <input type="text" name="id_pangkat" ng-model="id_pangkat" ng-hide="true">
                            <button type="submit" class="btn btn-info col-sm-3 mb-6">Update</button>
                            <button type="button" class="btn btn-danger col-sm-3 mb-6"
                                ng-click="closeModal('#detailPangkat')">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>