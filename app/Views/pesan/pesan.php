    <!-- Begin Page Content -->
    <div class="container-fluid" ng-controller="pesan">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Pesan</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pesan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="alert alert-danger alert-dismissable" ng-show="error">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                    </div>
                    <div class="alert alert-success alert-dismissable" ng-show="success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                    </div>
                    <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-hover"
                        width="100%" ng-init="getDataPesan()">
                        <thead>
                            <tr style="text-align: center;">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Email</th>
                                <th rowspan="2">Nama Pegawai</th>
                                <th rowspan="2">Jenis Pesan</th>
                                <th rowspan="2">Status Pesan</th>
                                <th rowspan="2">Tanggal Pengiriman</th>
                                <th colspan="2">Action</th>
                            </tr>
                            <tr>
                                <th>Kirim</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Email</th>
                                <th rowspan="2">Nama Pegawai</th>
                                <th rowspan="2">Jenis Pesan</th>
                                <th rowspan="2">Status Pesan</th>
                                <th rowspan="2">Tanggal Pengiriman</th>
                                <th>Kirim</th>
                                <th>Hapus</th>
                            </tr>
                            <tr style="text-align: center;">
                                <th colspan="2">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr ng-repeat="d in datas">
                                <td>{{$index +1}}</td>
                                <td>{{d.email}}</td>
                                <td>{{d.nama}}</td>
                                <td>{{d.jenis}}</td>
                                <td ng-if="d.status == '1'">Terkirim</td>
                                <td ng-if="d.status == '2'">Tidak Terkirim</td>
                                <td>{{d.tgl_pesan}}</td>
                                <td>
                                    <button type="button" class="btn btn-info" ng-click="reSend(d.id_pesan, d.jenis)"><i
                                            class="fas fa-paper-plane"> Kirim</i></button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" ng-click="deletePesan(d.id_pesan)"><i
                                            class="fas fa-trash-alt"> Hapus</i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>