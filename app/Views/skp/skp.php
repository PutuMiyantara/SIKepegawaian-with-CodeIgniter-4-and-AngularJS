    <!-- Begin Page Content -->
    <div class="container-fluid" ng-controller="skp" ng-init="getTahunSkp(null)">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data SKP</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data SKP</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div style="margin-bottom:10px;" class="row">
                        <div class="col-lg-10 col-sm-12">
                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><a
                                    href="/skp/tambah" style="margin-bottom: 10px; color:white;"><i
                                        class="fa fa-plus fa-sm text-white"></i>Tambah
                                    Data</a></button>
                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                ng-click="unduhData()"><i class="fa fa-download fa-sm text-white"></i> Unduh
                                Data</button>
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <label>Tahun SKP</label>
                            <select ng-options="tahunskp.tahun_skp as tahunskp.tahun_skp for tahunskp in tahun"
                                ng-model="tahunselect" ng-change="changeTahun()" class="form-control-sm">
                                <option label="" value="">All</option>
                            </select>
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
                                <th>Hapus</th>
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
                                <th>Hapus</th>
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
                                    <button type="submit" class="btn btn-info" ng-click="getDetail(d.id_skp)"><i
                                            class="fas fa-edit"> Detail</i></button>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-danger" ng-click="deleteSkp(d.id_skp)"><i
                                            class="fas fa-trash-alt"> Hapus</i></button>
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
                    <form method="POST" name="formSkp" id="formDetailSkp" ng-submit="editData()">
                        <div class="modal-header">
                            <h4 class="modal-title" ng-model="modalTitle">{{modalTitle}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" ng-init="option()">
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                            <div class="alert alert-success alert-dismissable" ng-show="success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                            <div class="form-group">
                                <label>NIP Pegawai</label><br>
                                <small style="color: red;">{{pegawaiUnique}}</small>
                                <small style="color: red;"
                                    ng-show="formSkp.nip.$dirty && formSkp.nip.$error.pattern">Masukan
                                    Angka</small>
                                <small style="color: red;"
                                    ng-show="formSkp.nip.$touched && formSkp.nip.$error.required">Data
                                    NIP Kosong</small>
                                <small style="color: red;">{{notfoundnip}}</small>
                                <input type="text" class="form-control" name="nip" ng-model="nip" ng-required="true"
                                    ng-keyup="nipChange(nip);" ng-pattern="/^[0-9\- ]*$/" ng-style="nipstyle"
                                    ng-readonly="false">
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
                                <input type="text" class="form-control" name="nama" ng-model="nama" ng-required="true"
                                    ng-keyup="namaChange(nama)" ng-style="namastyle" ng-readonly="false">
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
                                <label>Nama Atasan Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.namaAtasanpejpen.$touched && formSkp.namaAtasanpejpen.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="namaAtasanpejpen"
                                    ng-model="namaAtasanpejpen" ng-required="true"
                                    ng-style="formSkp.namaAtasanpejpen.$dirty && formSkp.namaAtasanpejpen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>NIP Atasan Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.nipAtasanpejpen.$touhced && formSkp.nipAtasanpejpen.$error.required">Data
                                    Masih Kosong</small>
                                <small style="color: red;"
                                    ng-show="!formSkp.nipAtasanpejpen.$error.pattern && formSkp.nipAtasanpejpen.$dirty && formSkp.nipAtasanpejpen.$error.maxlength">Maximal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="!formSkp.nipAtasanpejpen.$error.pattern && formSkp.nipAtasanpejpen.$dirty && formSkp.nipAtasanpejpen.$error.minlength">Minimal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="formSkp.nipAtasanpejpen.$dirty && formSkp.nipAtasanpejpen.$error.pattern">Masukan
                                    NIP Dengan Benar</small>
                                <input type="text" class="form-control" name="nipAtasanpejpen"
                                    ng-model="nipAtasanpejpen" ng-required="checkAtasanPejpen"
                                    ng-pattern="/^[0-9\- ]*$/" ng-maxlength="18" ng-minlength="18"
                                    ng-style="formSkp.nipAtasanpejpen.$dirty && formSkp.nipAtasanpejpen.$invalid && {'border':'solid red'}">
                            </div>
                            <!-- checkAtasanPejpen -->
                            <div class="form-group">
                                <label>Status Atasan Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.statusAtasanpejpen.$touched && formSkp.statusAtasanpejpen.$invalid">Data
                                    Masih Kosong</small>
                                <select class="form-control" name="statusAtasanpejpen" ng-init="a = 1"
                                    ng-options="statusAtasanpejpen for statusAtasanpejpen in getStatusAtasanpejpen"
                                    ng-model="statusAtasanpejpen" ng-required="true"
                                    ng-change="AtasanPejPen(statusAtasanpejpen)"
                                    ng-style="formSkp.statusAtasanpejpen.$touched && formSkp.statusAtasanpejpen.$invalid && {'border':'solid red'}"></select>
                            </div>
                            <div class="form-group">
                                <label>Nama Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.namaPejpen.$touched && formSkp.namaPejpen.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="namaPejpen" ng-model="namaPejpen"
                                    ng-required="true"
                                    ng-style="formSkp.namaPejpen.$dirty && formSkp.namaPejpen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>NIP Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.nipPejpen.$touched && formSkp.nipPejpen.$error.required">Data
                                    Masih Kosong</small>
                                <small style="color: red;"
                                    ng-show="!formSkp.nipPejpen.$error.pattern && formSkp.nipPejpen.$dirty && formSkp.nipPejpen.$error.maxlength">Maximal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="!formSkp.nipPejpen.$error.pattern && formSkp.nipPejpen.$dirty && formSkp.nipPejpen.$error.minlength">Minimal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="formSkp.nipPejpen.$dirty && formSkp.nipPejpen.$error.pattern">Masukan
                                    NIP Dengan Benar</small>
                                <input type="text" class="form-control" name="nipPejpen" ng-model="nipPejpen"
                                    ng-required="true" ng-maxlength="18" ng-minlength="18" ng-pattern="/^[0-9\- ]*$/"
                                    ng-style="formSkp.nipPejpen.$dirty && formSkp.nipPejpen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Status Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.statusPejpen.$touched && formSkp.statusPejpen.$invalid">Data
                                    Masih Kosong</small>
                                <select class="form-control" name="statusPejpen"
                                    ng-options="statusPejpen for statusPejpen in getStatuspejpen"
                                    ng-model="statusPejpen" ng-required="true"
                                    ng-style="formSkp.statusPejpen.$touched && formSkp.statusPejpen.$invalid && {'border':'solid red'}"></select>
                            </div>
                            <div class="form-group">
                                <label>Tahun SKP</label><br>
                                <small style="color: red;">{{uniquetahun}}</small>
                                <small style="color: red;"
                                    ng-show="formSkp.tahunskp.$touched && formSkp.tahunskp.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="tahunskp" ng-model="tahunskp"
                                    ng-required="true" ng-keyup="tahunChange()"
                                    ng-style="formSkp.tahunskp.$dirty && formSkp.tahunskp.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai SKP</label>
                                <input type="number" step="0.01" class="form-control" name="nilaiskp"
                                    ng-model="nilaiskp" ng-required="true">
                            </div>
                            <div class="form-group">
                                <label>Nilai Pelayanan</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.nilaipelayanan.$touched && formSkp.nilaipelayanan.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaipelayanan"
                                    ng-model="nilaipelayanan" ng-required="true"
                                    ng-style="formSkp.nilaipelayanan.$dirty && formSkp.nilaipelayanan.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Integritas</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.nilaiintegritas.$touched && formSkp.nilaiintegritas.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaiintegritas"
                                    ng-model="nilaiintegritas" ng-required="true"
                                    ng-style="formSkp.nilaiintegritas.$dirty && formSkp.nilaiintegritas.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Komitmen</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.nilaikomitmen.$touched && formSkp.nilaikomitmen.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaikomitmen" ng-model="nilaikomitmen"
                                    ng-required="true"
                                    ng-style="formSkp.nilaikomitmen.$dirty && formSkp.nilaikomitmen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Disiplin</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.nilaidisiplin.$touched && formSkp.nilaidisiplin.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaidisiplin" ng-model="nilaidisiplin"
                                    ng-required="true"
                                    ng-style="formSkp.nilaidisiplin.$dirty && formSkp.nilaidisiplin.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Kerjasama</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.nilaikerjasama.$touched && formSkp.nilaikerjasama.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaikerjasama"
                                    ng-model="nilaikerjasama" ng-required="true"
                                    ng-style="formSkp.nilaikerjasama.$dirty && formSkp.nilaikerjasama.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Kepemimpinan</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.nilaikepemimpinan.$touched && formSkp.nilaikepemimpinan.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaikepemimpinan"
                                    ng-model="nilaikepemimpinan" ng-required="true"
                                    ng-style="formSkp.nilaikepemimpinan.$dirty && formSkp.nilaikepemimpinan.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="text" name="id_pegawai" ng-model="id_pegawai" ng-hide="true">
                            <button type="submit" class="btn btn-info col-sm-3 mb-6"><i class="fas fa-save">
                                    Update</i></button>
                            <button type="button" class="btn btn-danger col-sm-3 mb-6" ng-click="">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>