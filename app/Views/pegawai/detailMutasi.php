    <!-- Begin Page Content -->
    <?php $sesion = session(); ?>
    <div class="container-fluid" ng-controller="mutasi">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Mutasi</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Riwayat Mutasi {{dataNama}}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php if ($sesion->get('role') == 3) : ?>
                    <div style="margin-bottom:10px;" class="row">
                        <div class="col-lg-10 col-sm-12">
                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                ng-click="addRiwayatMutasi()"><i class="fa fa-plus fa-sm text-white-50">
                                </i>Tambah
                                Data</button>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="alert alert-danger alert-dismissable" ng-show="errorDell">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                    </div>
                    <div class="alert alert-success alert-dismissable" ng-show="successDell">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                    </div>
                    <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-hover"
                        width="100%" ng-init="getRiwayatMutasi()">
                        <thead>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">NIP</th>
                                <th rowspan="2">Nama Pegawai</th>
                                <th rowspan="2">No SK Mutasi</th>
                                <th rowspan="2">Tanggal Mutasi</th>
                                <th rowspan="2">Unit Asal</th>
                                <th rowspan="2">Unit Tujuan</th>
                                <th colspan="2">Action</th>
                            </tr>
                            <tr>
                                <th>Detail</th>
                                <?php if ($sesion->get('role') == 3) : ?>
                                <th>Hapus</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">No SK Mutasi</th>
                                <th rowspan="2">Tanggal Mutasi</th>
                                <th rowspan="2">NIP</th>
                                <th rowspan="2">Nama Pegawai</th>
                                <th rowspan="2">Unit Asal</th>
                                <th rowspan="2">Unit Tujuan</th>
                                <th>Detail</th>
                                <?php if ($sesion->get('role') == 3) : ?>
                                <th>Hapus</th>
                                <?php endif; ?>

                            </tr>
                            <tr style="text-align: center">
                                <?php if ($sesion->get('role') == 3) : ?>
                                <th colspan="2">Action</th>
                                <?php else : ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr ng-repeat="d in datas">
                                <td>{{$index +1}}</td>
                                <td>{{d.nip}}</td>
                                <td>{{d.nama}}</td>
                                <td>{{d.no_sk}}</td>
                                <td>{{d.tgl_mutasi}}</td>
                                <td>{{d.unit_asal}}</td>
                                <td>{{d.unit_tujuan}}</td>
                                <td>
                                    <button type="submit" class="btn btn-info"
                                        ng-click="getDetailRiwayatMutasi(d.id_mutasi_pegawai)"><i class="fas fa-edit">
                                            Detail</i></button>
                                </td>
                                <?php if ($sesion->get('role') == 3) : ?>
                                <td>
                                    <button type="submit" class="btn btn-danger"
                                        ng-click="deleteRiwayatMutasi(d.id_mutasi_pegawai, d.id_pegawai, d.unit_asal)"><i
                                            class="fas fa-trash-alt"> Hapus</i></button>
                                </td>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" tabindex="1" role="dialog" id="detailMutasiPeg">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" name="formMutasi" id="formTambahMutasiPeg" ng-submit="updateRiwayatMutasi()">
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
                                <label>NIP Pegawai</label><br>
                                <input type="text" class="form-control" name="nip" ng-model="nip" ng-required="true"
                                    ng-change="nipChange(nip); ctrlAddNipChange(nip);" ng-pattern="/^[0-9\- ]*$/"
                                    ng-style=" nipstyle" ng-readonly="true">
                            </div>
                            <div class="form-group">
                                <label>Nama Pegawai</label><br>
                                <input type="text" class="form-control" name="nama" ng-model="nama" ng-required="true"
                                    ng-change="namaChange(nama)" ng-readonly="true">
                            </div>
                            <div class="form-group" ng-init="formTambah()">
                                <label>No SK</label><br>
                                <small style="color: red;">{{notfoundsk}}</small>
                                <small style="color: red;"
                                    ng-show="formMutasi.no_sk.$dirty && formMutasi.no_sk.$error.required">Data Masih
                                    Kosong</small>
                                <input type="text" ng-required="true" class="form-control" name="no_sk" ng-model="no_sk"
                                    ng-style="formMutasi.no_sk.$dirty && formMutasi.no_sk.$invalid && {'border':'solid red'}"
                                    ng-change="skChange(no_sk)" <?php if ($sesion->get('role') == 1) : ?>
                                    ng-readonly="true" <?php endif; ?>>
                                <ul class="list-group" ng-hide="hidesk" style="height: 100px;overflow: auto;">
                                    <li class="list-group-item list-group-item-action" ng-repeat="skdata in filterSk"
                                        ng-click="fillTextBoxSKMutasi(skdata.id_mutasi,skdata.no_sk, skdata.tgl_mutasi)"
                                        style="position: static;"><a href=""
                                            style="color: black; text-align: right; text-decoration: none;">{{skdata.no_sk}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mutasi</label><br>
                                <input type="date" class="form-control" name="tgl_mutasi" ng-model="tgl_mutasi"
                                    ng-required="true" ng-readonly="true">
                            </div>
                            <div class="form-group">
                                <label>Unit Asal</label><br>
                                <small style="color: red;"
                                    ng-show="formMutasi.unit_asal.$dirty && formMutasi.unit_asal.$invalid">Data
                                    Masih
                                    Kosong</small>
                                <input type="text" class="form-control" name="unit_asal" ng-model="unit_asal"
                                    ng-required="true" <?php if ($sesion->get('role') == 1) : ?> ng-readonly="true"
                                    <?php endif; ?>
                                    ng-style="formMutasi.unit_asal.$dirty && formMutasi.unit_asal.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Unit Tujuan</label><br>
                                <small style="color: red;"
                                    ng-show="formMutasi.unit_tujuan.$dirty && formMutasi.unit_tujuan.$invalid">Data
                                    Masih
                                    Kosong</small>
                                <input type="text" class="form-control" name="unit_tujuan" ng-model="unit_tujuan"
                                    ng-required="true" <?php if ($sesion->get('role') == 1) : ?> ng-readonly="true"
                                    <?php endif; ?>
                                    ng-style="formMutasi.unit_tujuan.$dirty && formMutasi.unit_tujuan.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group" ng-init="optionmutasi()">
                                <label>Status Mutasi</label>
                                <small style="color: red;"
                                    ng-show="formMutasi.status_mutasi.$dirty && formMutasi.status_mutasi.$error.required">Data
                                    Masih
                                    Kosong</small>
                                <select name="status_mutasi" class="form-control"
                                    ng-options="s.value as s.text for s in statusMutasi" ng-model="status_mutasi"
                                    ng-required="true" <?php if ($sesion->get('role') == 1) : ?> ng-readonly="true"
                                    <?php endif; ?>></select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php if ($sesion->get('role') == 3) : ?>
                            <input type="text" name="id_pegawai" ng-model="id_pegawai" ng-hide="true">
                            <input type="text" name="id_mutasi" ng-model="id_mutasi" ng-hide="true">
                            <input type="text" name="id_mutasi" ng-model="id_mutasi_pegawai" ng-hide="true">
                            <button type="submit" ng-click="actionDetail(id_mutasi_pegawai)"
                                class="btn btn-success col-sm-3 mb-6"><i class="fas fa-save"> Update</i></button>
                            <?php endif; ?>
                            <button type="button" ng-click="closeModal('#detailMutasiPeg')"
                                class="btn btn-danger col-sm-3 mb-6">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>