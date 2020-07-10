    <!-- Begin Page Content -->
    <div class="container-fluid" ng-controller="mutasi">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800"><a href="/mutasi/" style="color: black">Data Mutasi</a></h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4" ng-init="getDetail()">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Mutasi NO.SK Mutasi {{no_skLabel}}</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                        ng-click="addMutasi()" style="margin-bottom: 10px;">
                        <i class="fa fa-plus fa-sm text-white-50">
                        </i>Tambah Data
                    </button>
                    <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-hover"
                        width="100%">
                        <thead>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">No SK Mutasi</th>
                                <th rowspan="2">NIP</th>
                                <th rowspan="2">Nama Pegawai</th>
                                <th rowspan="2">Unit Tujuan</th>
                                <th rowspan="2">Tanggal Mutasi</th>
                                <th colspan="2">Action</th>
                            </tr>
                            <tr style="text-align: center">
                                <th>Detail</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">No SK Mutasi</th>
                                <th rowspan="2">NIP</th>
                                <th rowspan="2">Nama Pegawai</th>
                                <th rowspan="2">Unit Tujuan</th>
                                <th rowspan="2">Tanggal Mutasi</th>
                                <th>Detail</th>
                                <th>Delete</th>
                            </tr>
                            <tr style="text-align:center">
                                <th colspan="2">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr ng-repeat="d in datas">
                                <td>{{$index +1}}</td>
                                <td>{{d.no_sk}}</td>
                                <td>{{d.nip}}</td>
                                <td>{{d.nama}}</td>
                                <td>{{d.unit_tujuan}}</td>
                                <td>{{d.tgl_mutasi}}</td>
                                <td>
                                    <button type="button" class="btn btn-info"
                                        ng-click="getDetailMutasi(d.id_mutasi_pegawai)">Detail</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger"
                                        ng-click="deleteMutasi(d.id_mutasi_pegawai, d.id_pegawai)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="text" name="id_mutasi" ng-model="id_mutasi">
                    <input type="text" name="id_mutasi_table" ng-model="id_mutasi_table">
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" tabindex="1" role="dialog" id="detailMutasi">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" name="myForm" ng-submit="updateDataMutasi()">
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
                            <div class="form-group">
                                <label>No SK</label><br>
                                <small style="color: red;">{{notfoundsk}}</small>
                                <input type="text" ng-required="true" class="form-control" name="no_sk" ng-model="no_sk"
                                    ng-style="myForm.no_sk.$dirty && myForm.no_sk.$invalid && {'border':'solid red'}"
                                    ng-readonly="true" ng-keyup="skChange(no_sk)">
                                <ul class="list-group" ng-hide="hidesk" style="height: 100px;overflow: auto;">
                                    <li class="list-group-item list-group-item-action" ng-repeat="skdata in filterSk"
                                        ng-click="fillTextBoxSKMutasi(skdata.id_mutasi,skdata.no_sk)"
                                        style="position: static;"><a href=""
                                            style="color: black; text-align: right; text-decoration: none;">{{skdata.no_sk}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mutasi</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.tgl_mutasi.$dirty && myForm.tgl_mutasi.$error.date">Format
                                    Tanggal Mutasi Salah</small>
                                <small style="color: red;"
                                    ng-show="myForm.tgl_mutasi.$touched && myForm.tgl_mutasi.$error.required">Data
                                    Tanggal Mutasi Kosong</small>
                                <input type="date" class="form-control" name="tgl_mutasi" ng-model="tgl_mutasi"
                                    ng-required="true"
                                    ng-style="myForm.tgl_mutasi.$dirty && myForm.tgl_mutasi.$invalid && {'border':'solid red'}"
                                    ng-readonly="true">
                            </div>
                            <div class="form-group">
                                <label>NIP Pegawai</label><br>
                                <small style="color: red;">{{pegawaiUnique}}</small>
                                <small style="color: red;"
                                    ng-show="myForm.nip.$dirty && myForm.nip.$error.pattern">Masukan
                                    Angka</small>
                                <small style="color: red;"
                                    ng-show="myForm.nip.$touched && myForm.nip.$error.required">Data
                                    NIP Kosong</small>
                                <small style="color: red;">{{notfoundnip}}</small>
                                <input type="text" class="form-control" name="nip" ng-model="nip" ng-required="true"
                                    ng-change="nipChange(nip)" ng-pattern="/^[0-9\- ]*$/" ng-style="nipstyle">
                                <ul class="list-group" ng-hide="hidenip" style="height:100px; overflow: auto;">
                                    <li class="list-group-item list-group-item-action" ng-repeat="nipdata in filterNip"
                                        ng-click="fillTextBox(nipdata.nip, nipdata.id_pegawai, nipdata.nama)"
                                        style="position: static;">
                                        <a href=""
                                            style="color: black; text-align: right; text-decoration: none;">{{nipdata.nip}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label>Nama Pegawai</label><br>
                                <small style="color: red;">{{pegawaiUnique}}</small>
                                <small style="color: red;">{{notfoundnama}}</small>
                                <small style="color: red;"
                                    ng-show="myForm.nama.$touched && myForm.nama.$error.required">Data
                                    Nama
                                    Kosong</small>
                                <input type="text" class="form-control" name="nama" ng-model="nama" ng-required="true"
                                    ng-change="namaChange(nama)" ng-style="namastyle">
                                <ul class="list-group" ng-hide="hidenama" style="height: 100px;overflow: auto;">
                                    <li class="list-group-item list-group-item-action"
                                        ng-repeat="namadata in filterNama"
                                        ng-click="fillTextBox(namadata.nip, namadata.id_pegawai, namadata.nama)">
                                        <a href=""
                                            style="color: black; text-align: right; text-decoration: none;">{{namadata.nama}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label>Unit Tujuan</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.unit_tujuan.$dirty && myForm.unit_tujuan.$invalid">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="unit_tujuan" ng-model="unit_tujuan"
                                    ng-required="true"
                                    ng-style="myForm.unit_tujuan.$dirty && myForm.unit_tujuan.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group" ng-init="option()">
                                <label>Status Mutasi</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.status_mutasi.$touched && myForm.statys_mutasi.$invalid">Data
                                    Masih Kosong</small>
                                <select class="form-control" name="status_mutasi"
                                    ng-options="s.value as s.text for s in statusMutasi" ng-model="status_mutasi"
                                    ng-required="true"></select>
                            </div>
                            <input type="text" name="idpegawai" ng-model="id_pegawai" ng-hide="false"><br>
                            <input type="text" name="id_mutasi" ng-model="id_mutasi" ng-hide="false">
                            <input type="text" name="id_mutasi_pegawai" ng-model="id_mutasi_pegawai" ng-hide="false">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info col-sm-3 mb-6">Update</button>
                            <button type="button" class="btn btn-danger col-sm-3 mb-6"
                                ng-click="actionbtn('#detailMutasi')">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>