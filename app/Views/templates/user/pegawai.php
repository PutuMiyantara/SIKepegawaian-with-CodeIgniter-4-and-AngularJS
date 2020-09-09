    <!-- Begin Page Content -->
    <?php $session = session(); ?>
    <div class="container-fluid" ng-app="pegawai" ng-controller="pegawai">
        <div class="card mb-3" style="max-width: 670px;" ng-init="getDetail(<?= $session->get('id_user') ?>)">
            <div class="row no-gutters">
                <div class="col-md-3">
                    <div>
                        <img src="/foto/<?= $session->get('foto') ?>" class="card-img"
                            style="height: 234px; margin:5px">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h3 class="card-title">Dinas Pendidikan Kabupaten Klungkung</h3>
                        <h6 style="margin-top: -10px;">{{peg_tempat_bekerja}}</h6>
                        <hr class="sidebar-divider">
                        <p class="card-text">{{peg_nama}}</p>
                        <p class="card-text">{{peg_nip}}</p>
                        <p class="card-text" ng-hide="true">{{id_pegawai}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4" ng-init="lastInsertRole()">
                    <p class="card-text" style="margin-top: -5px; text-align: center;"><small class="text-muted">
                            Pensiun: {{peg_tgl_pensiun}}
                        </small></p>
                </div>
                <div class="col-8">
                    <button class="float-lg-right btn btn-outline-info"
                        style="margin: 10px; margin-top: -20px; float: right;"
                        ng-click="detailPeg(<?= $session->get('id_user') ?>)"><i class="fas fa-edit">
                            Detail</i></button>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" tabindex="1" role="dialog" id="detailPeg">
            <div class="modal-dialog" role="document">
                <div class="modal-content" ng-init="lastInsertRole()">
                    <form method="POST" name="formPegawai" id="formDetPeg" ng-submit="updateData()">
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
                            <div class="form-group" ng-hide="hide">
                                <label>NIP *</label><br>
                                <small style="color: red;"
                                    ng-show="formPegawai.nip.$touched && formPegawai.nip.$error.required">Data Masih
                                    Kosong</small>
                                <small style="color: red;"
                                    ng-show="maxnip && !formPegawai.nip.$error.pattern && !formPegawai.nip.$error.required">Maksimal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="minnip && !formPegawai.nip.$error.pattern && !formPegawai.nip.$error.required">Minimal
                                    NIP 18 Karakter</small>
                                <small style="color: red;"
                                    ng-show="formPegawai.nip.$dirty && formPegawai.nip.$error.pattern">Masukan NIP
                                    Dengan
                                    Benar</small>
                                <small style="color: red;"
                                    ng-show="formPegawai.nip.$dirty && formPegawai.nip.$valid && !maxnip && !minnip">{{errorNip}}</small>
                                <input type="text" class="form-control" name="nip" ng-model="nip" ng-required="false"
                                    ng-style="nipstyle ||formPegawai.nip.$dirty && formPegawai.nip.$invalid && {'border':'solid red'}"
                                    ng-readonly="false" ng-change="nipTglLahir(nip)">
                            </div>
                            <div class="form-group">
                                <label>Nama Pegawai *</label><br>
                                <small style="color: red;"
                                    ng-show="formPegawai.nama.$touched && formPegawai.nama.$error.required">Data Masih
                                    Kosong</small>
                                <input type="text" class="form-control" name="nama" ng-model="nama" ng-required="false"
                                    ng-style="formPegawai.nama.$dirty && formPegawai.nama.$invalid && {'border':'solid red'}"
                                    ng-readonly="false">
                            </div>
                            <div class="form-group" ng-init="option()">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="kelamin" ng-options="gender for gender in getGender"
                                    ng-model="jns_kelamin" ng-disabled="true"></select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir *</label><br>
                                <input type="date" class="form-control" name="tgl_lahir" ng-model="tgl_lahir"
                                    ng-required="false" ng-readonly="true" ng-change="tglLahirChange(tgl_lahir)">
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
                                    ng-show="formPegawai.alamat.$dirty && formPegawai.alamat.$error.required">Data Masih
                                    Kosong</small>
                                <textarea class="form-control" name="alamat" ng-model="alamat" ng-required="false"
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
                                    name="pend_terakhir" ng-model="pend_terakhir" ng-required="false"
                                    ng-style="formPegawai.pend_terakhir.$dirty && formPegawai.pend_terakhir.$invalid && {'border':'solid red'}"
                                    ng-disabled="readOnly"></select>
                            </div>
                            <div class="form-group" ng-hide="hide" ng-init="datapangkat()">
                                <label>Pangkat *</label><br>
                                <small style="color: red;"
                                    ng-show="formPegawai.pangkat.$toucehd && formPegawai.pangkat.$invalid">Data Masih
                                    Kosong</small>
                                <select class="form-control" name="pangkat"
                                    ng-options="pangkat.id_pangkat as pangkat.nama_pangkat for pangkat in gatPangkat"
                                    ng-model="pangkat" ng-required="editrequired"
                                    ng-style="formPegawai.pangkat.$touched && formPegawai.pangkat.$invalid && {'border':'solid red'}"
                                    ng-disabled="readOnly"></select>
                                <div class="form-group" ng-hide="hide" ng-init="datajabatan()">
                                    <label>Jabatan Yang Diemban *</label>
                                    <br>
                                    <small style="color: red;"
                                        ng-show="formPegawai.jabatan.$touched && formPegawai.jabatan.$invalid">Data
                                        Masih
                                        Kosong</small>
                                    <select class="form-control" name="jabatan"
                                        ng-options="jabatan.id_jabatan as jabatan.nama_jabatan for jabatan in getJabatan"
                                        ng-model="jabatan" ng-required="editrequired"
                                        ng-style="formPegawai.jabatan.$touched && formPegawai.jabatan.$invalid && {'border':'solid red'}"
                                        ng-disabled="readOnly"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tempat Bekerja *</label><br>
                                <small style="color: red;"
                                    ng-show="formPegawai.tempat_bekerja.$touched && formPegawai.tempat_bekerja.$error.required">Data
                                    Masih
                                    Kosong *</small>
                                <input type="text" class="form-control"
                                    ng-style="formPegawai.tempat_bekerja.$touched && formPegawai.tempat_bekerja.$invalid && {'border':'solid red'}"
                                    ng-model="tempat_bekerja" ng-readonly="false" ng-required="false">
                            </div>
                            <div class="form-group" ng-hide="hide">
                                <label>Tanggal Pensiun</label>
                                <input type="date" class="form-control" ng-model="tglpensiun" ng-readonly="true"
                                    ng-required="false">
                            </div>
                            <div class="form-group" ng-hide="hide">
                                <label>Sisa Waktu Menjabat</label>
                                <input type="text" class="form-control" ng-model="sisajabatan" ng-readonly="true"
                                    ng-required="false">
                            </div>
                            <div class="form-group row">
                                <div class="col-9">
                                </div>
                                <div class="col-3">
                                    <img style="width: 80px; height: 100px;" src="/foto/<?= $session->get('foto') ?>"
                                        ng-hide="false" class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="text" name="id_pegawai" ng-model="id_pegawai" ng-hide="true"><br>
                            <input type="text" name="role" ng-model="role" ng-hide="true">
                            <button type="submit" class="btn btn-success col-sm-3 mb-6"><i class="fas fa-save">
                                    Update</i></button>
                            <button type="button" class="btn btn-danger col-sm-3 mb-6"
                                ng-click="closeModal('#detailPeg')">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>