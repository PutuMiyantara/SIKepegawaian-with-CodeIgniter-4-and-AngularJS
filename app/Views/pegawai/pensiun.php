    <!-- Begin Page Content -->
    <div class="container-fluid" ng-controller="pegawai">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Pensiun Pegawai</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pensiun Satu Tahun Kedepan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-hover"
                        width="100%" ng-init="getDataPensiun()">
                        <thead>
                            <tr style="text-align: center;">
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Tanggal Lahir</th>
                                <th>Tanggal Pensiun</th>
                                <th>Pendidikan</th>
                                <th>Pangkat</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Tanggal Lahir</th>
                                <th>Tanggal Pensiun</th>
                                <th>Pendidikan</th>
                                <th>Pangkat</th>
                                <th>Jabatan</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr ng-repeat="d in datas">
                                <td>{{$index +1}}</td>
                                <td>{{d.nip}}</td>
                                <td>{{d.nama}}</td>
                                <td>{{d.tgl_lahir}}</td>
                                <td>{{d.tgl_pensiun}}</td>
                                <td>{{d.pend_terakhir}}</td>
                                <td>{{d.nama_pangkat}}</td>
                                <td>{{d.nama_jabatan}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>