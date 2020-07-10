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
                        <form class="user" name="myForm" ng-submit="insertData()" id="myForm" ng-init="option()"
                            ng-model="myForm">
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                <a href="#" class="close" data-dismiss="alert"
                                    aria-label="close">&times;</a>{{errorMessage}}
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
                                    ng-show="myForm.namaAtasanpejpen.$touched && myForm.namaAtasanpejpen.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="namaAtasanpejpen"
                                    ng-model="namaAtasanpejpen" ng-required="true"
                                    ng-style="myForm.namaAtasanpejpen.$dirty && myForm.namaAtasanpejpen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>NIP Atasan Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.nipAtasanpejpen.$touched && myForm.nipAtasanpejpen.$error.required">Data
                                    Masih Kosong</small>
                                <small style="color: red;"
                                    ng-show="!myForm.nipAtasanpejpen.$error.pattern && myForm.nipAtasanpejpen.$dirty && myForm.nipAtasanpejpen.$error.maxlength">Maximal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="!myForm.nipAtasanpejpen.$error.pattern && myForm.nipAtasanpejpen.$dirty && myForm.nipAtasanpejpen.$error.minlength">Minimal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="myForm.nipAtasanpejpen.$dirty && myForm.nipAtasanpejpen.$error.pattern">Masukan
                                    NIP Dengan Benar</small>
                                <input type="text" class="form-control" name="nipAtasanpejpen"
                                    ng-model="nipAtasanpejpen" ng-required="checkAtasanPejpen"
                                    ng-pattern="/^[0-9\- ]*$/" ng-maxlength="18" ng-minlength="18"
                                    ng-style="myForm.nipAtasanpejpen.$dirty && myForm.nipAtasanpejpen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Status Atasan Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.statusAtasanpejpen.$touched && myForm.statusAtasanpejpen.$invalid">Data
                                    Masih Kosong</small>
                                <select class="form-control" name="statusAtasanpejpen"
                                    ng-options="statusAtasanpejpen for statusAtasanpejpen in getStatusAtasanpejpen"
                                    ng-model="statusAtasanpejpen" ng-required="true"
                                    ng-change="statusAtasanPejPen(statusAtasanpejpen)"
                                    ng-style="myForm.statusAtasanpejpen.$touched && myForm.statusAtasanpejpen.$invalid && {'border':'solid red'}"></select>
                            </div>
                            <div class="form-group">
                                <label>Nama Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.namaPejpen.$touched && myForm.namaPejpen.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="namaPejpen" ng-model="namaPejpen"
                                    ng-required="true"
                                    ng-style="myForm.namaPejpen.$dirty && myForm.namaPejpen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>NIP Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.nipPejpen.$touched && myForm.nipPejpen.$error.required">Data
                                    Masih Kosong</small>
                                <small style="color: red;"
                                    ng-show="!myForm.nipPejpen.$error.pattern && myForm.nipPejpen.$dirty && myForm.nipPejpen.$error.maxlength">Maximal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="!myForm.nipPejpen.$error.pattern && myForm.nipPejpen.$dirty && myForm.nipPejpen.$error.minlength">Minimal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="myForm.nipPejpen.$dirty && myForm.nipPejpen.$error.pattern">Masukan
                                    NIP Dengan Benar</small>
                                <input type="text" class="form-control" name="nipPejpen" ng-model="nipPejpen"
                                    ng-required="true" ng-maxlength="18" ng-minlength="18" ng-pattern="/^[0-9\- ]*$/"
                                    ng-style="myForm.nipPejpen.$dirty && myForm.nipPejpen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Status Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.statusPejpen.$touched && myForm.statusPejpen.$invalid">Data
                                    Masih Kosong</small>
                                <select class="form-control" name="statusPejpen"
                                    ng-options="statusPejpen for statusPejpen in getStatuspejpen"
                                    ng-model="statusPejpen" ng-required="true"
                                    ng-style="myForm.statusPejpen.$touched && myForm.statusPejpen.$invalid && {'border':'solid red'}"></select>
                            </div>
                            <div class="form-group">
                                <label>Tahun SKP</label><br>
                                <small style="color: red;">{{uniquetahun}}</small>
                                <small style="color: red;"
                                    ng-show="myForm.tahunskp.$touched && myForm.tahunskp.$error.required">Data
                                    Masih Kosong</small>
                                <small style="color: red;"
                                    ng-show="myForm.tahunskp.$touched && myForm.tahunskp.$error.maxlength || myForm.tahunskp.$error.minlength">Format
                                    Tahun Salah</small>
                                <input type="number" class="form-control" name="tahunskp" ng-model="tahunskp"
                                    ng-required="true" ng-keyup="tahunChange()" ng-maxlength="4" ng-minlength="4"
                                    ng-style="myForm.tahunskp.$dirty && myForm.tahunskp.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai SKP</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.nilaiskp.$touched && myForm.nilaiskp.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaiskp" ng-model="nilaiskp"
                                    ng-required="true" step="0.01"
                                    ng-style="myForm.nilaiskp.$dirty && myForm.nilaiskp.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Pelayanan</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.nilaipelayanan.$touched && myForm.nilaipelayanan.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaipelayanan"
                                    ng-model="nilaipelayanan" ng-required="true"
                                    ng-style="myForm.nilaipelayanan.$dirty && myForm.nilaipelayanan.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Integritas</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.nilaiintegritas.$touched && myForm.nilaiintegritas.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaiintegritas"
                                    ng-model="nilaiintegritas" ng-required="true"
                                    ng-style="myForm.nilaiintegritas.$dirty && myForm.nilaiintegritas.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Komitmen</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.nilaikomitmen.$touched && myForm.nilaikomitmen.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaikomitmen" ng-model="nilaikomitmen"
                                    ng-required="true"
                                    ng-style="myForm.nilaikomitmen.$dirty && myForm.nilaikomitmen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Disiplin</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.nilaidisiplin.$touched && myForm.nilaidisiplin.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaidisiplin" ng-model="nilaidisiplin"
                                    ng-required="true"
                                    ng-style="myForm.nilaidisiplin.$dirty && myForm.nilaidisiplin.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Kerjasama</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.nilaikerjasama.$touched && myForm.nilaikerjasama.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaikerjasama"
                                    ng-model="nilaikerjasama" ng-required="true"
                                    ng-style="myForm.nilaikerjasama.$dirty && myForm.nilaikerjasama.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Nilai Kepemimpinan</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.nilaikepemimpinan.$touched && myForm.nilaikepemimpinan.$error.required">Data
                                    Masih Kosong</small>
                                <input type="number" class="form-control" name="nilaikepemimpinan"
                                    ng-model="nilaikepemimpinan" ng-required="true"
                                    ng-style="myForm.nilaikepemimpinan.$dirty && myForm.nilaikepemimpinan.$invalid && {'border':'solid red'}">
                                <input name="id_pegawai" ng-model="id_pegawai" ng-hide="false">
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12"></div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-danger btn-block"
                                                ng-click="bckTo()">Kembali</button>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" name="btnInsert"
                                                class="btn btn-success btn-block">Simpan</button>
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