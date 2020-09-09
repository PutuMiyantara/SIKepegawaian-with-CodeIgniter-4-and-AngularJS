<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="skp">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah SKP</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <!-- CONTENT -->
        <div class="card">
            <div class="row">
                <div class="col-lg-6">
                    <div class="p-5" ng-init="initInsert()">
                        <form class="user" name="formSkp" ng-submit="insertData()" id="formTambahSkp" ng-init="option()"
                            ng-model="formTambahSkp">
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
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
                                    ng-readonly="skpReadOnly">
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
                                    ng-keyup="namaChange(nama)" ng-style="namastyle" ng-readonly="skpReadOnly">
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
                                    ng-show="formSkp.nipAtasanpejpen.$touched && formSkp.nipAtasanpejpen.$error.required">Data
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
                            <div class="form-group">
                                <label>Status Atasan Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.statusAtasanpejpen.$touched && formSkp.statusAtasanpejpen.$invalid">Data
                                    Masih Kosong</small>
                                <select class="form-control" name="statusAtasanpejpen"
                                    ng-options="statusAtasanpejpen for statusAtasanpejpen in getStatusAtasanpejpen"
                                    ng-model="statusAtasanpejpen" ng-required="true"
                                    ng-change="statusAtasanPejPen(statusAtasanpejpen)"
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
                                <label>Nilai SKP</label><br>
                                <small style="color: red;"
                                    ng-show="formSkp.nilaiskp.$touched && formSkp.nilaiskp.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaiskp" ng-model="nilaiskp"
                                    ng-required="true" step="0.01"
                                    ng-style="formSkp.nilaiskp.$dirty && formSkp.nilaiskp.$invalid && {'border':'solid red'}">
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
                            <div class="row">
                                <div class="col-xl-6 col-lg-12"></div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="row">
                                        <input name="id_pegawai" ng-model="id_pegawai" ng-hide="true">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-danger btn-block"
                                                ng-click="bckTo()">Kembali</button>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" name="btnInsert" class="btn btn-success btn-block"><i
                                                    class="fas fa-save"> Simpan</i></button>
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
<!-- /.container-fluid -->
<!-- <script>
    var app = angular.module('test', ['datatables']);

    app.controller('ctest', function($scope, $http) {
        $http.get('/ajax/pegawai/').success(function(data, status, headers, config) {
            $scope.datas = data;
        });
    });
</script> -->