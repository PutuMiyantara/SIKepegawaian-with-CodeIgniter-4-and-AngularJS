<!-- Begin Page Content -->
<div class="container-fluid" ng-app="mutasi" ng-controller="mutasi">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Mutasi</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <!-- CONTENT -->
        <div class="card" ng-init="getIDMP()">
            <div class="row">
                <div class="col-lg-6">
                    <div class="p-5">
                        <form class="user" name="myForm" id="myForm" ng-submit="insertDataMutasi()">
                            <div class="form-group" ng-init="getSK()">
                                <label>No SK</label><br>
                                <small style="color: red;">{{noskUnique}}</small>
                                <small style=" color: red;">{{notfoundsk}}</small>
                                <input type="text" ng-required="true" class="form-control" name="no_sk" ng-model="no_sk"
                                    ng-style="myForm.no_sk.$dirty && myForm.no_sk.$invalid && {'border':'solid red'}"
                                    ng-readonly="no_SkReadOnly" ng-keyup="skChange(no_sk)">
                                <ul class="list-group" ng-hide="hidesk" style="height: 100px;overflow: auto;">
                                    <li class="list-group-item list-group-item-action" ng-repeat="skdata in filterSk"
                                        ng-click="fillTextBoxSKMutasi(skdata.id_mutasi,skdata.no_sk)"
                                        style="position: static;"><a href=""
                                            style="color: black; text-align: right; text-decoration: none;">{{skdata.no_sk}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label>NIP Pegawai</label><br>
                                <small style="color: red;">{{pegawaiUnique}}</small>
                                <small style="color: red;"
                                    ng-show="myForm.nip.$dirty && myForm.nip.$error.pattern">Masukan Angka</small>
                                <small style="color: red;">{{notfoundnip}}</small>
                                <input type="text" class="form-control" name="nip" ng-model="nip" ng-required="true"
                                    ng-keyup="nipChange(nip); ctrlAddNipChange(nip);" ng-pattern="/^[0-9]*$/"
                                    ng-style="nipstyle" ng-readonly="nipnamaReadonly">
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
                                    ng-keyup="namaChange(nama)" ng-style="namastyle" ng-readonly="nipnamaReadonly">
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
                                    ng-show="myForm.unit_tujuan.$touched && myForm.unit_tujuan.$invalid">Data Masih
                                    Kosong</small>
                                <input type="text" class="form-control" name="unit_tujuan" ng-model="unit_tujuan"
                                    ng-required="true"
                                    ng-style="myForm.unit_tujuan.$dirty && myForm.unit_tujuan.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="form-group" ng-init="option()">
                                <label>Status Mutasi</label><br>
                                <small style="color: red;"
                                    ng-show="myForm.status_mutasi.$touched && myForm.status_mutasi.$invalid">Data Masih
                                    Kosong</small>
                                <select class="form-control" name="status_mutasi"
                                    ng-options="s.value as s.text for s in statusMutasi" ng-model="status_mutasi"
                                    ng-required="true"></select>
                            </div>
                            <input type="text" name="idpegawai" ng-model="id_pegawai" ng-hide="false"><br>
                            <input type="text" name="id_mutasi" ng-model="id_mutasi" ng-hide="false">
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