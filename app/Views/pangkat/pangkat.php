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
                    <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-hover"
                        width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Pangkat</th>
                                <th rowspan="2">Gaji</th>
                                <th colspan="2">Action</th>
                            </tr>
                            <tr style="text-align: center;">
                                <th>Detail</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Pangkat</th>
                                <th rowspan="2">Gaji</th>
                                <th>Detail</th>
                                <th>Delete</th>
                            </tr>
                            <tr style="text-align: center;">
                                <th colspan="2">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr ng-repeat="d in datas">
                                <td>{{ $index +1 }}</td>
                                <td>{{ d.nama_pangkat }}</td>
                                <td>{{ "Rp. " + (d.gaji |number)}}</td>
                                </td>
                                <td style="width: 100px; padding: auto">
                                    <button type="button" class="btn btn-info"
                                        ng-click="getDetail(d.id_pangkat)">Detail</button>
                                </td>
                                <td style="width: 100px; padding: auto">
                                    <button type="button" class="btn btn-danger"
                                        ng-click="deletePangkat(d.id_pangkat)">Delete</button>
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
                    <form method="POST" name="myForm" ng-submit="editData()">
                        <div class="modal-header">
                            <h4 class="modal-title" ng-model="modalTitle">{{modalTitle}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                <a href="#" class="close" data-dismiss="alert"
                                    aria-label="close">&times;</a>{{errorMessage}}
                            </div>
                            <div class="form-group">
                                <label>Nama Pangkat</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.namaPangkat.$touched && myForm.namaPangkat.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="namaPangkat" ng-model="namaPangkat"
                                    ng-required="true"
                                    ng-style="myForm.namaPangkat.$dirty && myForm.namaPangkat.$invalid && {'border':'solid red'}"
                                    ng-readonly="readOnly">
                            </div>
                            <div class="form-group">
                                <label>Gaji</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.gaji.$touched && myForm.gaji.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="gaji" ng-model="gaji" ng-required="true"
                                    ng-style="myForm.gaji.$dirty && myForm.gaji.$invalid && {'border':'solid red'}"
                                    ng-readonly="readOnly" ng-change="priceFormat(gaji, 'Rp.')">
                            </div>
                            <p>id_pangkat</p>
                            <input type="text" name="id_pangkat" ng-model="id_pangkat" ng-hide="false">
                        </div>
                        <div class="modal-footer">
                            <button type="{{typeButton}}" class="btn btn-info col-sm-3 mb-6"
                                ng-click="actionDetail()">{{submitButton}}</button>
                            <button type="button" class="btn btn-danger col-sm-3 mb-6"
                                ng-click="deleteJabatan(id_pangkat)" ng-show="deletejabatan">Hapus</button>
                            <button type="button" class="btn btn-danger col-sm-3 mb-6"
                                ng-click="actionbtn(id_pangkat)">{{actionButton}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>