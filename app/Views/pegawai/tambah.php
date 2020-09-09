<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="pegawai">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Pegawai</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4" ng-init="option()">
        <!-- CONTENT -->
        <div class="card">
            <div class="row">
                <div class="col-lg-6">
                    <div class="p-5">
                        <form class="user" method="POST" enctype="multipart/form-data" name="formPegawai"
                            id="formTambahPegawai" ng-submit="insertData()">
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                            <div class="form-group" ng-hide="hide">
                                <label>NIP *</label><br>
                                <small style="color: red;"
                                    ng-show="formPegawai.nip.$touched && formPegawai.nip.$error.required">Data
                                    Masih
                                    Kosong</small>
                                <small style="color: red;"
                                    ng-show="maxnip && !formPegawai.nip.$error.pattern && !formPegawai.nip.$error.required">Maksimal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="minnip && !formPegawai.nip.$error.pattern && !formPegawai.nip.$error.required">Minimal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="formPegawai.nip.$dirty && formPegawai.nip.$valid && !maxnip && !minnip">{{errorNip}}</small>
                                <input type="text" class="form-control" name="nip" ng-model="nip" ng-required="true"
                                    ng-style="nipstyle ||formPegawai.nip.$dirty && formPegawai.nip.$invalid && {'border':'solid red'}"
                                    ng-readonly="false" ng-change="nipTglLahir(nip)">
                                <!-- ng-pattern="/^[0-9\- ]*$/" -->
                            </div>
                            <div class="form-group">
                                <label>Nama Pegawai *</label><br>
                                <small style="color: red;"
                                    ng-show="formPegawai.nama.$touched && formPegawai.nama.$error.required">Data
                                    Masih
                                    Kosong</small>
                                <input type="text" class="form-control" name="nama" ng-model="nama" ng-required="true"
                                    ng-style="formPegawai.nama.$dirty && formPegawai.nama.$invalid && {'border':'solid red'}"
                                    ng-readonly="false">
                            </div>
                            <div class="form-group" ng-init="option()">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="kelamin" ng-options="gender for gender in getGender"
                                    ng-model="jns_kelamin" ng-disabled="true"></select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir *</label>
                                <input type="date" class="form-control" name="tgl_lahir" ng-model="tgl_lahir"
                                    ng-required="true" ng-readonly="true" ng-change="tglLahirChange(tgl_lahir)">
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" ng-model="tmp_lahir" ng-readonly="false">
                            </div>
                            <div class="form-group" ng-init="option()">
                                <label>Agama</label>
                                <select class="form-control" ng-options="agama for agama in getAgama" ng-model="agama"
                                    ng-disabled="readOnly"></select>
                            </div>
                            <div class="form-group">
                                <label>Status Perkawinan</label>
                                <select class="form-control" ng-options="kawin for kawin in getKawin"
                                    ng-model="status_kawin" ng-disabled="readOnly"></select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Anak</label>
                                <input type="number" class="form-control" ng-model="jml_anak" ng-readonly="false">
                            </div>
                            <div class="form-group">
                                <label>Alamat *</label><br>
                                <small style="color: red;"
                                    ng-show="formPegawai.alamat.$touched && formPegawai.alamat.$error.required">Data
                                    Masih
                                    Kosong</small>
                                <textarea class="form-control" name="alamat" ng-model="alamat" ng-required="true"
                                    ng-readonly="false"
                                    ng-style="formPegawai.alamat.$dirty && formPegawai.alamat.$error.required && {'border':'solid red'}"></textarea>
                            </div>
                            <div class="form-group" ng-init="option()">
                                <label>Pendidikan Terakhir *</label><br>
                                <small style="color: red;"
                                    ng-show="formPegawai.pend_terakhir.$touched && formPegawai.pend_terakhir.$error.required">Data
                                    Masih
                                    Kosong</small>
                                <select class="form-control" ng-options="pendidikan for pendidikan in getPendidikan"
                                    name="pend_terakhir" ng-model="pend_terakhir" ng-required="true"
                                    ng-style="formPegawai.pend_terakhir.$dirty && formPegawai.pend_terakhir.$invalid && {'border':'solid red'}"
                                    ng-disabled="readOnly"></select>
                            </div>
                            <div class="form-group" ng-hide="hide" ng-init="datapangkat()">
                                <label>Pangkat *</label><br>
                                <small style="color: red;"
                                    ng-show="formPegawai.pangkat.$toucehd && formPegawai.pangkat.$invalid">Data
                                    Masih
                                    Kosong</small>
                                <select class="form-control" name="pangkat"
                                    ng-options="pangkat.id_pangkat as pangkat.nama_pangkat for pangkat in gatPangkat"
                                    ng-model="pangkat" ng-required="true"
                                    ng-style="formPegawai.pangkat.$touched && formPegawai.pangkat.$invalid && {'border':'solid red'}"
                                    ng-disabled="readOnly"></select>
                            </div>
                            <div class="form-group" ng-hide="hide" ng-init="datajabatan()">
                                <label>Jabatan Yang Diemban *</label>
                                <br>
                                <small style="color: red;"
                                    ng-show="formPegawai.jabatan.$touched && formPegawai.jabatan.$invalid">Data
                                    Masih
                                    Kosong</small>
                                <select class="form-control" name="jabatan"
                                    ng-options="jabatan.id_jabatan as jabatan.nama_jabatan for jabatan in getJabatan"
                                    ng-model="jabatan" ng-required="true"
                                    ng-style="formPegawai.jabatan.$touched && formPegawai.jabatan.$invalid && {'border':'solid red'}"
                                    ng-disabled="readOnly"></select>
                            </div>
                            <div class="form-group">
                                <label>Tempat Bekerja *</label><br>
                                <small style="color: red;"
                                    ng-show="formPegawai.tempat_bekerja.$touched && formPegawai.tempat_bekerja.$error.required">Data
                                    Masih
                                    Kosong</small>
                                <input type="text" class="form-control" name="tempat_bekerja"
                                    ng-style="formPegawai.tempat_bekerja.$touched && formDetailPeg.tempat_bekerja.$invalid && {'border':'solid red'}"
                                    ng-model="tempat_bekerja" ng-readonly="false" ng-required="true">
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12"></div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" ng-init="idPegInit()" name="id_pegawai"
                                                ng-model="id_pegawai" ng-hide="true">
                                            <button type="button" class="btn btn-danger btn-block"
                                                ng-click="btnBackPeg()">Kembali</button>
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