    <!-- Begin Page Content -->
    <div class="container-fluid" ng-controller="pegawai">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data SKP</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4" ng-init="getRiwayatSKP()">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Riwayat SKP Pegawai {{namapegawaiSKP}}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div style="margin-bottom:10px;" class="row">
                        <div class="col-lg-10 col-sm-12">
                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                ng-click="AddSKP()">Tambah
                                Data</button>
                        </div>
                    </div>
                    <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-hover"
                        width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Pegawai</th>
                                <th rowspan="2">Tahun SKP</th>
                                <th colspan="7">Nilai</th>
                                <th colspan="2">Action</th>
                            </tr>
                            <tr style="text-align: center;">
                                <th>SKP</th>
                                <th>Pelayanan</th>
                                <th>Integritas</th>
                                <th>Komitmen</th>
                                <th>Disiplin</th>
                                <th>Kerjasama</th>
                                <th>Kepemimpinan</th>
                                <th>Detail</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Pegawai</th>
                                <th rowspan="2">Tahun SKP</th>
                                <th>SKP</th>
                                <th>Pelayanan</th>
                                <th>Integritas</th>
                                <th>Komitmen</th>
                                <th>Disiplin</th>
                                <th>Kerjasama</th>
                                <th>Kepemimpinan</th>
                                <th>Detail</th>
                                <th>Delete</th>
                            </tr>
                            <tr style="text-align: center;">
                                <th colspan="7">Nilai</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr ng-repeat="d in datas">
                                <td>{{ $index +1 }}</td>
                                <td>{{ d.nama }}</td>
                                <td>{{ d.tahun_skp }}</td>
                                <td>{{ d.nilai_skp }}</td>
                                <td>{{ d.nilai_pelayanan }}</td>
                                <td>{{ d.nilai_integritas }}</td>
                                <td>{{ d.nilai_komitmen }}</td>
                                <td>{{ d.nilai_disiplin }}</td>
                                <td>{{ d.nilai_kerjasama }}</td>
                                <td>{{ d.nilai_kepemimpinan }}
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-info"
                                        ng-click="getDetailSkp(d.id_skp)">Detail</button>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-danger"
                                        ng-click="deleteSkp(d.id_skp)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" tabindex="1" role="dialog" id="detailSkp">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" name="skpform" ng-submit="updateSkp()">
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
                                <label>NIP Pegawai</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.nip.$dirty && skpform.nip.$error.pattern">Masukan Angka</small>
                                <small style="color: red;">{{notfoundnip}}</small>
                                <input type="text" class="form-control" name="nip" ng-model="nip" ng-required="true"
                                    ng-keyup="nipChange(nip); ctrlNipChange(nip);" ng-pattern="/^[0-9]*$/"
                                    ng-style="nipstyle" ng-readonly="true">
                            </div>
                            <div class="form-group">
                                <label>Nama Pegawai</label><br>
                                <small style="color: red;">{{notfoundnama}}</small>
                                <input type="text" class="form-control" name="nama" ng-model="nama" ng-required="true"
                                    ng-keyup="namaChange(nama)" ng-style="namastyle" ng-readonly="true">
                            </div>
                            <div class="form-group">
                                <label>Nama Atasan Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.namaAtasanpejpen.$touched && skpform.namaAtasanpejpen.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="namaAtasanpejpen"
                                    ng-model="namaAtasanpejpen" ng-required="true"
                                    ng-style="skpform.namaAtasanpejpen.$dirty && skpform.namaAtasanpejpen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>NIP Atasan Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.nipAtasanpejpen.$touhced && skpform.nipAtasanpejpen.$error.required">Data
                                    Masih Kosong</small>
                                <small style="color: red;"
                                    ng-show="!skpform.nipAtasanpejpen.$error.pattern && skpform.nipAtasanpejpen.$dirty && skpform.nipAtasanpejpen.$error.maxlength">Maximal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="!skpform.nipAtasanpejpen.$error.pattern && skpform.nipAtasanpejpen.$dirty && skpform.nipAtasanpejpen.$error.minlength">Minimal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="skpform.nipAtasanpejpen.$dirty && skpform.nipAtasanpejpen.$error.pattern">Masukan
                                    NIP Dengan Benar</small>
                                <input type="text" class="form-control" name="nipAtasanpejpen"
                                    ng-model="nipAtasanpejpen" ng-required="false" ng-pattern="/^[0-9\- ]*$/"
                                    ng-maxlength="18" ng-minlength="18"
                                    ng-style="skpform.nipAtasanpejpen.$dirty && skpform.nipAtasanpejpen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Status Atasan Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.statusAtasanpejpen.$touched && skpform.statusAtasanpejpen.$invalid">Data
                                    Masih Kosong</small>
                                <select class="form-control" name="statusAtasanpejpen"
                                    ng-options="statusAtasanpejpen for statusAtasanpejpen in getStatusAtasanpejpen"
                                    ng-model="statusAtasanpejpen" ng-required="true"
                                    ng-change="statusAtasanPejPen(statusAtasanpejpen)"
                                    ng-style="skpform.statusAtasanpejpen.$touched && skpform.statusAtasanpejpen.$invalid && {'border':'solid red'}"></select>
                            </div>
                            <div class="form-group">
                                <label>Nama Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.namaPejpen.$touched && skpform.namaPejpen.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="namaPejpen" ng-model="namaPejpen"
                                    ng-required="true"
                                    ng-style="skpform.namaPejpen.$dirty && skpform.namaPejpen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>NIP Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.nipPejpen.$touched && skpform.nipPejpen.$error.required">Data
                                    Masih Kosong</small>
                                <small style="color: red;"
                                    ng-show="!skpform.nipPejpen.$error.pattern && skpform.nipPejpen.$dirty && skpform.nipPejpen.$error.maxlength">Maximal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="!skpform.nipPejpen.$error.pattern && skpform.nipPejpen.$dirty && skpform.nipPejpen.$error.minlength">Minimal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="skpform.nipPejpen.$dirty && skpform.nipPejpen.$error.pattern">Masukan
                                    NIP Dengan Benar</small>
                                <input type="text" class="form-control" name="nipPejpen" ng-model="nipPejpen"
                                    ng-required="true" ng-maxlength="18" ng-minlength="18" ng-pattern="/^[0-9\- ]*$/"
                                    ng-style="skpform.nipPejpen.$dirty && skpform.nipPejpen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Status Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.statusPejpen.$touched && skpform.statusPejpen.$invalid">Data
                                    Masih Kosong</small>
                                <select class="form-control" name="statusPejpen"
                                    ng-options="statusPejpen for statusPejpen in getStatuspejpen"
                                    ng-model="statusPejpen" ng-required="true"
                                    ng-style="skpform.statusPejpen.$touched && skpform.statusPejpen.$invalid && {'border':'solid red'}"></select>
                            </div>
                            <div class="form-group">
                                <label>Tahun SKP</label><br>
                                <small style="color: red;">{{uniquetahun}}</small>
                                <small style="color: red;"
                                    ng-show="skpform.tahunskp.$touched && skpform.tahunskp.$error.required">Data
                                    Masih Kosong</small>
                                <small style="color: red;"
                                    ng-show="skpform.tahunskp.$touched && skpform.tahunskp.$error.maxlength || skpform.tahunskp.$error.minlength">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="tahunskp" ng-model="tahunskp"
                                    ng-required="true" ng-keyup="tahunChange()" ng-maxlength="4" ng-minlength="4"
                                    ng-style="skpform.tahunskp.$dirty && skpform.tahunskp.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai SKP</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.nilaiskp.$touched && skpform.nilaiskp.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaiskp" ng-model="nilaiskp"
                                    ng-required="true" step="0.01"
                                    ng-style="skpform.nilaiskp.$dirty && skpform.nilaiskp.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Pelayanan</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.nilaipelayanan.$touched && skpform.nilaipelayanan.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaipelayanan"
                                    ng-model="nilaipelayanan" ng-required="true"
                                    ng-style="skpform.nilaipelayanan.$dirty && skpform.nilaipelayanan.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Integritas</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.nilaiintegritas.$touched && skpform.nilaiintegritas.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaiintegritas"
                                    ng-model="nilaiintegritas" ng-required="true"
                                    ng-style="skpform.nilaiintegritas.$dirty && skpform.nilaiintegritas.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Komitmen</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.nilaikomitmen.$touched && skpform.nilaikomitmen.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaikomitmen" ng-model="nilaikomitmen"
                                    ng-required="true"
                                    ng-style="skpform.nilaikomitmen.$dirty && skpform.nilaikomitmen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Disiplin</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.nilaidisiplin.$touched && skpform.nilaidisiplin.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaidisiplin" ng-model="nilaidisiplin"
                                    ng-required="true"
                                    ng-style="skpform.nilaidisiplin.$dirty && skpform.nilaidisiplin.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Kerjasama</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.nilaikerjasama.$touched && skpform.nilaikerjasama.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaikerjasama"
                                    ng-model="nilaikerjasama" ng-required="true"
                                    ng-style="skpform.nilaikerjasama.$dirty && skpform.nilaikerjasama.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Kepemimpinan</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.nilaikepemimpinan.$touched && skpform.nilaikepemimpinan.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaikepemimpinan"
                                    ng-model="nilaikepemimpinan" ng-required="true"
                                    ng-style="skpform.nilaikepemimpinan.$dirty && skpform.nilaikepemimpinan.$invalid && {'border':'solid red'}">
                            </div>
                            <p>idskp</p>
                            <input type="text" name="idskp" ng-model="idskp" ng-hide="false">
                            <p>idpegawai</p>
                            <input type="text" name="id_pegawai" ng-model="id_pegawai" ng-hide="false">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info col-sm-3 mb-6"
                                ng-click="actionDetail()">Update</button>
                            <button type="button" class="btn btn-danger col-sm-3 mb-6"
                                ng-click="actionbtnSkp(idskp)">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>