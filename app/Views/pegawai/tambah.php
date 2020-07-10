<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="pegawai">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Pegawai</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4" ng-init="option()">
        <!-- CONTENT -->
        <div class="card">
            <div class="row">
                <div class="col-lg-6" ng-init="lastInsertRole()">
                    <div class="p-5">
                        <form class="user" method="POST" enctype="multipart/form-data" name="myForm" id="myForm"
                            ng-submit="insertData()">
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                <a href="#" class="close" data-dismiss="alert"
                                    aria-label="close">&times;</a>{{errorMessage}}
                            </div>
                            <div class="form-group">
                                <label>Nama Pegawai</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.nama.$touched && myForm.nama.$error.required">Data Masih
                                    Kosong</small>
                                <input type="text" class="form-control" name="nama" ng-model="nama" ng-required="true"
                                    ng-style="myForm.nama.$dirty && myForm.nama.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group" ng-hide="hide" ng-readonly="readOnly">
                                <label>NIP</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.nip.$touched && myForm.nip.$error.required">Data Masih
                                    Kosong</small>
                                <small style="color: red;"
                                    ng-show="maxnip && !myForm.nip.$error.pattern && !myForm.nip.$error.required">Maksimal
                                    NIP 18
                                    Karakter</small>
                                <small style="color: red;"
                                    ng-show="minnip && !myForm.nip.$error.pattern && !myForm.nip.$error.required">Minimal
                                    NIP 18
                                    Karakter</small>
                                <small style="color: red;" ng-show="myForm.nip.$dirty && myForm.nip.$error.pattern">NIP
                                    Harus Berupa Angka</small>
                                <small style="color: red;"
                                    ng-show="myForm.nip.$dirty && myForm.nip.$valid && !maxnip && !minnip">{{errorNip}}</small>
                                <input type="text" class="form-control" name="nip" ng-model="nip"
                                    ng-required="nip_required" ng-pattern="/^[0-9\- ]*$/"
                                    ng-style="nipstyle || myForm.nip.$dirty && myForm.nip.$invalid && {'border':'solid red'}"
                                    ng-change="nipTglLahir(nip)" ng-touched="maxnip = minnip = null">
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="jns_kelamin"
                                    ng-options="gender for gender in getGender" ng-model="jns_kelamin"
                                    ng-required="false"></select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.tgl_lahir.$touched && myForm.tgl_lahir.$error.required">Data Masih
                                    Kosong</small>
                                <input type="date" class="form-control" name="tgl_lahir" ng-model="tgl_lahir"
                                    ng-required="true"
                                    ng-style="myForm.tgl_lahir.$dirty && myForm.tgl_lahir.$invalid && {'border':'solid red'}"
                                    ng-change="tglLahirChange(tgl_lahir)">
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tmp_lahir" ng-model="tmp_lahir"
                                    ng-required="false">
                            </div>
                            <div class="form-group">
                                <label>Agama</label>
                                <select class="form-control" name="agama" ng-options="agama for agama in getAgama"
                                    ng-model="agama" ng-required="false"></select>
                            </div>
                            <div class="form-group">
                                <label>Status Perkawinan</label>
                                <select class="form-control" name="status_kawin"
                                    ng-options="kawin for kawin in getKawin" ng-model="status_kawin"
                                    ng-required="false"></select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Anak</label>
                                <input type="number" name="jml_anak" class="form-control" ng-model="jml_anak"
                                    ng-required="false">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.alamat.$touched && myForm.alamat.$invalid">Data Masih
                                    Kosong</small>
                                <textarea class="form-control" name="alamat" ng-model="alamat" ng-required="true"
                                    ng-style="myForm.alamat.$dirty && myForm.alamat.$invalid && {'border':'solid red'}"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Pendidikan Terakhir</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.pendidikan.$touched && myForm.pendidikan.$invalid">Data Masih
                                    Kosong</small>
                                <select class="form-control" ng-options="pendidikan for pendidikan in getPendidikan"
                                    name="pendidikan" ng-model="pend_terakhir" ng-required="true"
                                    ng-style="myForm.pendidikan.$dirty && myForm.pendidikan.$invalid && {'border':'solid red'}"></select>
                            </div>
                            <div class="form-group">
                                <label>Tempat Bekerja</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.tempat_bekerja.$touched && myForm.tempat_bekerja.$invalid">Data
                                    Masih
                                    Kosong</small>
                                <input type="text" name="tempat_bekerja" class="form-control" ng-model="tempat_bekerja"
                                    ng-required="true"
                                    ng-style="myForm.tempat_bekerja.$dirty && myForm.tempat_bekerja.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group" ng-hide="hide" ng-init="datapangkat()">
                                <label>Pangkat</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.pangkat.$touched && myForm.pangkat.$invalid">Data Masih
                                    Kosong</small>
                                <select class="form-control" name="pangkat"
                                    ng-options="pangkat.id_pangkat as pangkat.nama_pangkat for pangkat in gatPangkat"
                                    ng-model="pangkat" ng-required="pangkat_required"
                                    ng-style="myForm.pangkat.$dirty && myForm.pangkat.$invalid && {'border':'solid red'}"></select>
                            </div>
                            <div class="form-group" ng-hide="hide" ng-init="datajabatan()">
                                <label>Jabatan Yang Diemban</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.pangkat.$touched && myForm.pangkat.$error.required">Data Masih
                                    Kosong</small>
                                <select class="form-control" name="jabatan"
                                    ng-options="jabatan.id_jabatan as jabatan.nama_jabatan for jabatan in getJabatan"
                                    ng-model="jabatan" ng-required="jabatan_required"
                                    ng-style="myForm.jabatan.$dirty && myForm.jabatan.$invalid && {'border':'solid red'}"></select>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12"></div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" ng-init="idPegInit()" name="id_pegawai"
                                                ng-model="id_pegawai">
                                            <button type="button" class="btn btn-danger btn-block"
                                                ng-click="btnBackPeg()">Kembali</button>
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