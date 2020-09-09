<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="jabatan">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Jabatan</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <!-- CONTENT -->
        <div class="card">
            <div class="row">
                <div class="col-lg-6">
                    <div class="p-5">
                        <form class="user" name="fomJabatan" ng-submit="insertData()" id="formTambahJabatan"
                            ng-model="fomJabatan">
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                            <div class="form-group">
                                <label>Nama Jabatan</label><br>
                                <small style="color: red;"
                                    ng-show="fomJabatan.namaJabatan.$touched && fomJabatan.namaJabatan.$error.required">Data
                                    Masih Kosong</small>
                                <input type="text" class="form-control" name="namaJabatan" ng-model="namaJabatan"
                                    ng-required="true"
                                    ng-style="fomJabatan.namaJabatan.$dirty && fomJabatan.namaJabatan.$invalid && {'border':'solid red'}">
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12"></div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <input name="id_jabatan" ng-model="id_jabatan" ng-hide="true">
                                            <button type="button" class="btn btn-danger btn-block"
                                                ng-click="bckTo()">Kembali</button>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" name="btnInsert" class="btn btn-success btn-block"><i
                                                    class="fas fa-save">Simpan</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT -->
</div>