<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="mutasi">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah SK Mutasi</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4" ng-init="option()">
        <!-- CONTENT -->
        <div class="card">
            <div class="row">
                <div class="col-lg-6">
                    <div class="p-5">
                        <form class="user" name="formSkMutasi" id="formSkMutasi" ng-submit="insertDataSKMutasi()">
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                            <div class="form-group" ng-hide="hide">
                                <label>No SK Mutasi</label><br>
                                <small style="color: red;"
                                    ng-show="formSkMutasi.no_skmutasi.$touched && formSkMutasi.no_skmutasi.$error.required">Data
                                    Masih
                                    Kosong</small>
                                <input type="text" class="form-control" name="no_skmutasi" ng-model="no_skmutasi"
                                    ng-required="true"
                                    ng-style="formSkMutasi.no_skmutasi.$dirty && formSkMutasi.no_skmutasi.$invalid && {'border':'solid red'}"
                                    ng-readonly="readOnly">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mutasi</label><br>
                                <small style="color: red;"
                                    ng-show="formSkMutasi.tgl_mutasi.$dirty && formSkMutasi.tgl_mutasi.$error.required">Data
                                    Masih
                                    Kosong</small>
                                <input type="date" class="form-control" name="tgl_mutasi" ng-model="tgl_mutasi"
                                    ng-required="true"
                                    ng-style="formSkMutasi.tgl_mutasi.$dirty && formSkMutasi.tgl_mutasi.$invalid && {'border':'solid red'}"
                                    ng-readonly="readOnly">
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12"></div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <a class="btn btn-danger btn-block" href="/mutasi/">Kembali</a>
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
        <!-- CONTENT -->
    </div>

</div>