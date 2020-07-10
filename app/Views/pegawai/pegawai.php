    <!-- Begin Page Content -->
    <div class="container-fluid" ng-controller="pegawai">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Pegawai</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pegawai</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <a href="/user/tambah" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                        style="margin-bottom: 10px;"><i class="fa fa-plus fa-sm text-white-50"></i>Tambah
                        Data</a>
                    <div class="form-group" ng-init="typePegawaitypePegawai()">
                        <label>Pegawai</label>
                        <select ng-options="jp.value as jp.text for jp in jenisPegawai" ng-change="changePegawai()"
                            ng-model="typePegawai" ng-disabled="false"></select>
                    </div>
                    <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-hover"
                        width="100%" ng-init="getPegawai(typePegawai)">
                        <thead>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">NIP</th>
                                <th rowspan="2">Nama Pegawai</th>
                                <th rowspan="2">Tanggal Lahir</th>
                                <th rowspan="2">Status Perkawinan</th>
                                <th rowspan="2">Pendidikan</th>
                                <th rowspan="2">Agama</th>
                                <th rowspan="2">Alamat</th>
                                <th rowspan="2">Tanggal Pensiun</th>
                                <th rowspan="2">Status Pegawai</th>
                                <th colspan="3">Action</th>
                            </tr>
                            <tr>
                                <th>Detail</th>
                                <th>Mutasi</th>
                                <th>SKP</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">NIP</th>
                                <th rowspan="2">Nama Pegawai</th>
                                <th rowspan="2">Tanggal Lahir</th>
                                <th rowspan="2">Status Perkawinan</th>
                                <th rowspan="2">Pendidikan</th>
                                <th rowspan="2">Agama</th>
                                <th rowspan="2">Alamat</th>
                                <th rowspan="2">Tanggal Pensiun</th>
                                <th rowspan="2">Status Pegawai</th>
                                <th>Detail</th>
                                <th>Mutasi</th>
                                <th>SKP</th>
                            </tr>
                            <tr style="text-align: center;">
                                <th colspan="3">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr ng-repeat="d in datas">
                                <td>{{$index +1}}</td>
                                <td>{{d.nip}}</td>
                                <td>{{d.nama}}</td>
                                <td>{{d.tgl_lahir}}</td>
                                <td>{{d.status_kawin}}</td>
                                <td>{{d.pend_terakhir}}</td>
                                <td>{{d.agama}}</td>
                                <td>{{d.alamat}}</td>
                                <td>{{d.tgl_pensiun}}</td>
                                <td ng-if="d.status == '1'">Aktif</td>
                                <td ng-if="d.status == '2'">Tidak Aktif</td>
                                <td>
                                    <button type="submit" class="btn btn-info"
                                        ng-click="getDetail(d.id_pegawai)">Detail</button>
                                </td>
                                <td>
                                    <button type=" submit" class="btn btn-danger" ng-click="Mutasi(d.id_pegawai)"
                                        ng-if="d.status == '1'">
                                        Mutasi</button>
                                </td>
                                <td>
                                    <button type=" submit" class="btn btn-primary" ng-click="Skp(d.id_pegawai)"
                                        ng-if="d.status == '1'">
                                        SKP</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" tabindex="1" role="dialog" id="detailPegawai">
            <div class="modal-dialog" role="document">
                <div class="modal-content" ng-init="lastInsertRole()">
                    <form method="POST" name="myForm" ng-submit="updateData()">
                        <div class="modal-header">
                            <h4 class="modal-title" ng-model="modalTitle">{{modalTitle}}</h4>
                            <button type="button" style="margin-left: 10px;" class="btn btn-outline-info btn-sm"
                                ng-click="toDetailMutasi(id_pegawai)">Riwayat Mutasi</button>
                            <button type="button" style="margin-left: 5px" class="btn btn-outline-info btn-sm"
                                ng-click="toDetailSKP(id_pegawai)">Riwayat
                                SKP</button>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">

                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                <a href="#" class="close" data-dismiss="alert"
                                    aria-label="close">&times;</a>{{errorMessage}}
                            </div>
                            <div class="form-group" ng-hide="hide">
                                <label>NIP</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.nip.$touched && myForm.nip.$error.required">Data Masih
                                    Kosong</small>
                                <small style="color: red;"
                                    ng-show="maxnip && !myForm.nip.$error.pattern && !myForm.nip.$error.required">Maksimal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="minnip && !myForm.nip.$error.pattern && !myForm.nip.$error.required">Minimal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="myForm.nip.$dirty && myForm.nip.$error.pattern">Masukan NIP Dengan
                                    Benar</small>
                                <small style="color: red;"
                                    ng-show="myForm.nip.$dirty && myForm.nip.$valid && !maxnip && !minnip">{{errorNip}}</small>
                                <input type="text" class="form-control" name="nip" ng-model="nip"
                                    ng-required="editrequired" ng-pattern="/^[0-9\- ]*$/"
                                    ng-style="nipstyle ||myForm.nip.$dirty && myForm.nip.$invalid && {'border':'solid red'}"
                                    ng-readonly="false" ng-change="nipTglLahir(nip)">
                            </div>
                            <div class="form-group">
                                <label>Nama Pegawai</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.nama.$touched && myForm.nama.$error.required">Data Masih
                                    Kosong</small>
                                <input type="text" class="form-control" name="nama" ng-model="nama" ng-required="true"
                                    ng-style="myForm.nama.$dirty && myForm.nama.$invalid && {'border':'solid red'}"
                                    ng-readonly="false">
                            </div>
                            <div class="form-group" ng-init="option()">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="kelamin" ng-options="gender for gender in getGender"
                                    ng-model="jns_kelamin" ng-disabled="false"></select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.tgl_lahir.$dirty && myForm.tgl_lahir.$invalid">Data Masih
                                    Kosong</small>
                                <input type="date" class="form-control" name="tgl_lahir" ng-model="tgl_lahir"
                                    ng-required="true"
                                    ng-style="myForm.tgl_lahir.$dirty && myForm.tgl_lahir.$invalid && {'border':'solid red'}"
                                    ng-readonly="false" ng-change="tglLahirChange(tgl_lahir)">
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
                                <label>Alamat</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.alamat.$dirty && myForm.alamat.$error.required">Data Masih
                                    Kosong</small>
                                <textarea class="form-control" name="alamat" ng-model="alamat" ng-required="true"
                                    ng-readonly="false"
                                    ng-style="myForm.alamat.$dirty && myForm.alamat.$error.required && {'border':'solid red'}"></textarea>
                            </div>
                            <div class="form-group" ng-init="option()">
                                <label>Pendidikan Terakhir</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.pend_terakhir.$touched && myForm.pend_terakhir.$error.required">Data
                                    Masih
                                    Kosong</small>
                                <select class="form-control" ng-options="pendidikan for pendidikan in getPendidikan"
                                    name="pend_terakhir" ng-model="pend_terakhir" ng-required="true"
                                    ng-style="myForm.pend_terakhir.$dirty && myForm.pend_terakhir.$invalid && {'border':'solid red'}"
                                    ng-disabled="readOnly"></select>
                            </div>
                            <div class="form-group" ng-hide="hide" ng-init="datapangkat()">
                                <label>Pangkat</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.pangkat.$toucehd && myForm.pangkat.$invalid">Data Masih
                                    Kosong</small>
                                <select class="form-control" name="pangkat"
                                    ng-options="pangkat.id_pangkat as pangkat.nama_pangkat for pangkat in gatPangkat"
                                    ng-model="pangkat" ng-required="editrequired"
                                    ng-style="myForm.pangkat.$touched && myForm.pangkat.$invalid && {'border':'solid red'}"
                                    ng-disabled="readOnly"></select>
                            </div>
                            <div class="form-group" ng-hide="hide" ng-init="datajabatan()">
                                <label>Jabatan Yang Diemban</label>
                                <br>
                                <small style="color: red;"
                                    ng-show="myForm.jabatan.$touched && myForm.jabatan.$invalid">Data Masih
                                    Kosong</small>
                                <select class="form-control" name="jabatan"
                                    ng-options="jabatan.id_jabatan as jabatan.nama_jabatan for jabatan in getJabatan"
                                    ng-model="jabatan" ng-required="editrequired"
                                    ng-style="myForm.jabatan.$touched && myForm.jabatan.$invalid && {'border':'solid red'}"
                                    ng-disabled="readOnly"></select>
                            </div>
                            <div class="form-group">
                                <label>Tempat Bekerja</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.tempat_bekerja.$touched && myForm.tempat_bekerja.$error.required">Data
                                    Masih
                                    Kosong</small>
                                <input type="text" class="form-control"
                                    ng-style="myForm.tempat_bekerja.$touched && myForm.tempat_bekerja.$invalid && {'border':'solid red'}"
                                    ng-model="tempat_bekerja" ng-readonly="false" ng-required="true">
                            </div>
                            <div class="form-group" ng-hide="hide">
                                <label>Tanggal Pensiun</label>
                                <input type="date" class="form-control" ng-model="tglpensiun" ng-readonly="true"
                                    ng-required="true">
                            </div>
                            <div class="form-group" ng-hide="hide">
                                <label>Sisa Waktu Menjabat</label>
                                <input type="text" class="form-control" ng-model="sisajabatan" ng-readonly="true"
                                    ng-required="true">
                            </div>
                            <div class="form-group row">
                                <div class="col-9">
                                </div>
                                <div class="col-3">
                                    <img style="width: 80px; height: 100px;" src="{{foto}}" ng-hide="false"
                                        class="img-thumbnail">
                                </div>
                            </div>
                            <input type="text" name="id_pegawai" ng-model="id_pegawai" ng-hide="false"><br>
                        </div>
                        <div class="modal-footer">
                            <input type="text" name="role" ng-model="role" ng-hide="false">
                            <button type="submit" class="btn btn-success col-sm-3 mb-6">Update</button>
                            <button type="button" class="btn btn-danger col-sm-3 mb-6"
                                ng-click="closeModal('#detailPegawai')">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->


        <!-- Modal -->
        <div class="modal fade" tabindex="1" role="dialog" id="detailMutasi">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" name="mutasiForm" ng-submit="insertDataMutasi()">
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
                                <label>NIP</label>
                                <input type="text" class="form-control" name="nip" ng-model="nip" ng-required="true"
                                    ng-maxlength="18" ng-pattern="/^[0-9\- ]*$/" ng-minlength="18"
                                    ng-style="mutasiForm.nip.$dirty && mutasiForm.nip.$invalid && {'border':'solid red'}"
                                    ng-readonly="true">
                            </div>
                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <input type="text" class="form-control" name="nama" ng-model="nama" ng-required="true"
                                    ng-style="mutasiForm.nama.$dirty && mutasiForm.nama.$invalid && {'border':'solid red'}"
                                    ng-readonly="true">
                            </div>
                            <div class="form-group">
                                <label>No SK</label><br>
                                <small style="color: red;">{{notfoundsk}}</small>
                                <small style="color: red;"
                                    ng-show="mutasiForm.no_sk.$touched && mutasiForm.no_sk.$error.required">Data Masih
                                    Kosong</small>
                                <input type="text" ng-required="true" class="form-control" name="no_sk" ng-model="no_sk"
                                    ng-style="mutasiForm.no_sk.$touched && mutasiForm.no_sk.$invalid && {'border':'solid red'}"
                                    ng-keyup="skChange(no_sk)">
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
                                    ng-required="true"
                                    ng-style="myForm.tgl_mutasi.$dirty && myForm.tgl_mutasi.$invalid && {'border':'solid red'}"
                                    ng-readonly="true">
                            </div>
                            <div class="form-group">
                                <label>Unit Tujuan</label><br>
                                <small style="color: red;"
                                    ng-show="mutasiForm.unit_tujuan.$touched && mutasiForm.unit_tujuan.$invalid">Data
                                    Masih
                                    Kosong</small>
                                <input type="text" class="form-control" name="unit_tujuan" ng-model="unit_tujuan"
                                    ng-required="true"
                                    ng-style="mutasiForm.unit_tujuan.$dirty && mutasiForm.unit_tujuan.$invalid && {'border':'solid red'}"
                                    ng-readonly="false">
                            </div>
                            <div class="form-group" ng-init="optionmutasi()">
                                <label>Status Mutasi</label><br>
                                <small style="color: red;"
                                    ng-show="mutasiForm.status_mutasi.$touched && mutasiForm.status_mutasi.$error.required">Data
                                    Masih
                                    Kosong</small>
                                <select name="status_mutasi" class="form-control"
                                    ng-options="s.value as s.text for s in statusMutasi" ng-model="status_mutasi"
                                    ng-disabled="false" ng-required="true"></select>
                            </div>
                            <input type="text" name="id_pegawai" ng-model="id_pegawai" ng-hide="false"><br>
                            <input type="text" name="id_mutasi" ng-model="id_mutasi" ng-hide="false">
                        </div>
                        <div class="modal-footer">
                            <button type="sumbit" class="btn btn-success col-sm-3 mb-6">Mutasi</button>
                            <button type="button" ng-click="closeModal('#detailMutasi')"
                                class="btn btn-danger col-sm-3 mb-6">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->

        <!-- Modal -->
        <div class="modal fade" tabindex="1" role="dialog" id="detailSkp">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" name="skpform" id="skpform" ng-submit="insertDataSkp()">
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
                                <input type="text" class="form-control" name="nip" ng-model="nip" ng-required="true"
                                    ng-pattern="/^[0-9\- ]*$/" ng-style="nipstyle" ng-readonly="true">
                            </div>
                            <div class="form-group">
                                <label>Nama Pegawai</label><br>
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
                                    ng-show="skpform.nipAtasanpejpen.$touched && skpform.nipAtasanpejpen.$error.required">Data
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
                                    ng-model="nipAtasanpejpen" ng-required="checkAtasanPejpen"
                                    ng-pattern="/^[0-9\- ]*$/" ng-maxlength="18" ng-minlength="18"
                                    ng-style="skpform.nipAtasanpejpen.$dirty && skpform.nipAtasanpejpen.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group">
                                <label>Status Atasan Pejabat Penilai</label><br>
                                <small style="color: red;"
                                    ng-show="skpform.statusAtasanpejpen.$touched && skpform.statusAtasanpejpen.$invalid">Data
                                    Masih Kosong</small>
                                <select class="form-control" name="statusAtasanpejpen"
                                    ng-options="statusAtasanpejpen for statusAtasanpejpen in getStatusAtasanpejpen"
                                    ng-model="statusAtasanpejpen" ng-required="checkAtasanPejpen"
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
                                <input name="id_pegawai" ng-model="id_pegawai" ng-hide="false">
                            </div>
                            <p>idpegawai</p>
                        </div>
                        <div class="modal-footer">
                            <button type="{{typeButton}}" class="btn btn-info col-sm-3 mb-6"
                                ng-click="actionDetail()">{{submitButton}}</button>
                            <button type="button" class="btn btn-danger col-sm-3 mb-6" ng-click="deleteSkp(idskp)"
                                ng-show="">Hapus</button>
                            <button type="button" class="btn btn-danger col-sm-3 mb-6"
                                ng-click="actionbtn()">{{actionButton}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>