<?php $session = session();
$uri = new \CodeIgniter\HTTP\URI(current_url()); ?>

<body id="page-top" ng-app="sikepegawaian">

    <!-- Page Wrapper -->
    <div id="wrapper" ng-controller="pegawai">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" <?php
                                                                                        if ($session->has('email') && $session->get('role') == 3) {
                                                                                            echo 'href = "/home/admin"';
                                                                                        } else {
                                                                                            echo 'href="/home/pegawai"';
                                                                                        }
                                                                                        ?>>
                <div class="sidebar-brand-icon">
                    <i>
                        <img src="/assets/foto/lambangdisdik.png" style="width: 60px; height: 50px;">
                    </i>
                </div>
                <div class="sidebar-brand-text mx-3">SIPEG</div>
            </a>
            <hr class="sidebar-divider">

            <?php if ($session->has('email') && $session->get('role') == 3) :  ?>
            <!-- Nav Item - Dashboard -->
            <div class="sidebar-heading">
                Dashboard
            </div>
            <li class="nav-item <?php if ($uri->getPath() == '/home/admin') : echo 'active';
                                    else : echo '';
                                    endif;
                                    ?>">
                <a class="nav-link" href="/home/admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <?php endif; ?>
            <!-- ============================================================================ -->
            <?php if ($session->has('email') && $session->get('role') == 1 || $session->get('role') == 2) :  ?>
            <!-- Nav Item - MYPROFIL -->
            <div class="sidebar-heading">
                Data Diri
            </div>
            <li class="nav-item <?php if ($uri->getPath() == '/home/pegawai') : echo 'active';
                                    else : echo '';
                                    endif;
                                    ?>">
                <a class="nav-link" href="/home/pegawai">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Diri</span></a>
            </li>
            <!-- Nav Item - MYPROFIL -->
            <?php endif; ?>
            <!-- ============================================================================ -->
            <?php if ($session->has('email') && $session->get('role') == 3) :  ?>
            <hr class="sidebar-divider">
            <!-- Nav Item - USER -->
            <div class="sidebar-heading">
                User
            </div>
            <li class="nav-item <?php if ($uri->getSegment(1) == 'user') : echo 'active';
                                    else : echo '';
                                    endif;
                                    ?>">
                <a class="nav-link" href="/user/">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data User</span></a>
            </li>
            <!-- Nav Item - USER -->
            <?php endif; ?>
            <!-- ============================================================================ -->
            <?php if ($session->has('email') && $session->get('role') == 3 || $session->get('role') == 1) :  ?>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Pegawai
            </div>
            <?php endif; ?>
            <!-- ============================================================================ -->
            <?php if ($session->has('email') && $session->get('role') == 3) :  ?>
            <!-- Nav Item - PEGAWAI -->
            <li class="nav-item <?php if ($uri->getSegment(1) == 'pegawai') : echo 'active';
                                    else : echo '';
                                    endif;
                                    ?>">
                <a class="nav-link" href="/pegawai/">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Pegawai</span></a>
            </li>
            <!-- Nav Item - PEGAWAI -->
            <?php endif; ?>
            <!-- ============================================================================ -->
            <?php if ($session->has('email') && $session->get('role') == 3 || $session->get('role') == 1) :  ?>
            <!-- Nav Item - MUTASI -->
            <?php if ($session->has('email') && $session->get('role') == 3) :  ?>
            <li class="nav-item <?php if ($uri->getSegment(1) == 'mutasi') : echo 'active';
                                        else : echo '';
                                        endif;
                                        ?>">
                <a class=" nav-link collapsed" href="#" data-toggle="collapse" data-target="#mutasi"
                    aria-expanded="true" aria-controls="mutasi">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data Mutasi</span>
                </a>
                <div id="mutasi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">--Pilihan--</h6>
                        <a class="collapse-item <?php if ($uri->getPath() == '/mutasi') : echo 'active';
                                                        else : echo '';
                                                        endif;
                                                        ?>" href="/mutasi/">Data Mutasi</a>
                        <!-- <a class="collapse-item <?php if ($uri->getPath() == '/mutasi/tambahSKMutasi') : echo 'active';
                                                                else : echo '';
                                                                endif;
                                                                ?>" href="/mutasi/tambahSkMutasi">Tambah Data SK Mutasi</a> -->
                        <a class="collapse-item <?php if ($uri->getPath() == '/mutasi/tambahMutasi') : echo 'active';
                                                        else : echo '';
                                                        endif;
                                                        ?>" href="/mutasi/tambahMutasi">Tambah Data Mutasi</a>
                    </div>
                </div>
            </li>
            <?php else :  ?>
            <li class="nav-item <?php if ($uri->getSegment(1) == 'pegawai' && $uri->getSegment(2) == 'detailMutasi') : echo 'active';
                                        else : echo '';
                                        endif;
                                        ?>">
                <a class="nav-link" href="<?= base_url('/pegawai/detailMutasi/' . $session->get('id_user')) ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Mutasi</span></a>
            </li>
            <?php endif; ?>
            <!-- Nav Item - MUTASI -->
            <!-- Nav Item - SKP -->
            <li class="nav-item <?php if ($uri->getSegment(1) == 'skp') : echo 'active';
                                    elseif ($uri->getSegment(1) == 'pegawai' && $uri->getSegment(2) == 'detailSKP' && $session->get('role') == '1') :
                                        echo 'active';
                                    else :
                                        echo '';
                                    endif;
                                    ?>">
                <?php if ($session->has('email') && $session->get('role') == 3) :  ?>
                <a class="nav-link" href="/skp/">
                    <?php else : ?>
                    <a class="nav-link" href="<?= base_url('/pegawai/detailSKP/' . $session->get('id_user')) ?>">
                        <?php endif; ?>
                        <i class="fas fa-fw fa-table"></i>
                        <span>Data SKP</span></a>
            </li>
            <!-- Nav Item - SKP -->
            <?php endif; ?>
            <!-- ============================================================================ -->
            <?php if ($session->has('email') && $session->get('role') == 3) :  ?>
            <!-- Nav Item - PENSIUN -->
            <li class="nav-item <?php if ($uri->getSegment(1) == 'pensiun') : echo 'active';
                                    else : echo '';
                                    endif;
                                    ?>">
                <a class="nav-link" href="/pensiun/">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data Pensiun</span></a>
            </li>
            <!-- Nav Item - PENSIUN -->
            <hr class="sidebar-divider">
            <!-- Nav Item - LAINNYA -->
            <div class="sidebar-heading">
                Lainnya
            </div>
            <li class="nav-item <?php if ($uri->getSegment(1) == 'jabatan' || $uri->getSegment(1) == 'pangkat' || $uri->getSegment(1) == 'pesan') : echo 'active';
                                    else : echo '';
                                    endif;
                                    ?>">
                <a class=" nav-link collapsed" href="#" data-toggle="collapse" data-target="#lainnya"
                    aria-expanded="true" aria-controls="lainnya">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data Lainnya</span>
                </a>
                <div id="lainnya" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">--Pilihan--</h6>
                        <a class="collapse-item <?php if ($uri->getSegment(1) == 'jabatan') : echo 'active';
                                                    else : echo '';
                                                    endif;
                                                    ?>" href="/jabatan/">Data Jabatan</a>
                        <a class="collapse-item <?php if ($uri->getSegment(1) == 'pangkat') : echo 'active';
                                                    else : echo '';
                                                    endif;
                                                    ?>" href="/pangkat/">Data Pangkat</a>
                        <a class="collapse-item <?php if ($uri->getSegment(1) == 'pesan') : echo 'active';
                                                    else : echo '';
                                                    endif;
                                                    ?>" href="/pesan/">Data Pesan</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - LAINNYA -->
            <?php endif; ?>
            <!-- ============================================================================ -->
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-light topbar mb-4 static-top shadow">
                    <div>
                        <img style="width: 50px; height: 50px;" src="/assets/foto/lambangklungkung.png">
                    </div>
                    <div>
                        <h4>SIPEG</h4>
                        <h5 style="margin-top: -10px;">Dinas Pendidikan Kabupaten Klungkung</h5>
                    </div>
                    <ul class="navbar-nav ml-auto" ng-controller="user">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $session->get('nama') ?></span>
                                <img class="img-profile rounded-circle" src="/foto/<?= $session->get('foto') ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href=""
                                    ng-click="getdetailuserHeader(<?= $session->get('id_user') ?>)">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout') ?>" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                        <!-- Modal -->
                        <div class="modal fade" tabindex="1" role="dialog" id="detailuserHeader">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" enctype="multipart/form-data" name="formUser"
                                        ng-submit="edituserHeader()">
                                        <div class="modal-header">
                                            <h4 class="modal-title" ng-model="modalTitle">{{modalTitle}}</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                                <a href="#" class="close" data-dismiss="alert"
                                                    aria-label="close">&times;</a>{{message}}
                                            </div>
                                            <div class="alert alert-success alert-dismissable" ng-show="success">
                                                <a href="#" class="close" data-dismiss="alert"
                                                    aria-label="close">&times;</a>{{message}}
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Nama</label></div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control" name="nama"
                                                            ng-model="nama" ng-required="true" ng-readonly="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Email</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formUser.email.$touched && formUser.email.$error.required">Masukan
                                                        Alamat
                                                        Email</small>
                                                    <small style="color: red;"
                                                        ng-show="formUser.email.$dirty && formUser.email.$error.email">Masukan
                                                        Email
                                                        dengan
                                                        Benar</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="email" class="form-control" name="email"
                                                            ng-model="email" ng-required="true"
                                                            ng-style="formUser.email.$dirty && formUser.email.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col">
                                                    <label>Password</label><br>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <small style="color: red;"
                                                            ng-show="formUser.password.$touched && formUser.password.$error.required">Masukan
                                                            Password</small>
                                                        <small style="color: red;"
                                                            ng-if="formUser.password.$dirty && password.length < 8">Minimal
                                                            8 Karakter</small>
                                                    </div>
                                                    <div class="col-sm-6"><small ng-style="s_msg">{{msg}}</small></div>
                                                    <div class="col-sm-6">
                                                        <input type="{{typepass}}" name="password" class="form-control"
                                                            placeholder="Password" ng-model="password"
                                                            ng-change="check()" ng-style="spassword">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input type="{{typepass}}" class="form-control" name="repass"
                                                            placeholder="Repeat Password" ng-model="repass"
                                                            ng-change="check()" ng-style="srepass">
                                                    </div>
                                                    <div><span class="{{showHide}}"
                                                            style="cursor: pointer; margin-top: 10px" ord()"
                                                            style="align-content: center"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Foto</label></div>
                                                <div class="form-group row">
                                                    <div class="col-3">
                                                        <img style="width: 80px; height: 100px;"
                                                            src="/foto/<?= $session->get('foto') ?>" ng-hide="false"
                                                            class="img-thumbnail">
                                                    </div>
                                                    <div class="col-9">
                                                        <input type="file" class="form-control" name="file_foto"
                                                            file-input="files"
                                                            onchange="angular.element(this).scope().filesChanged(this)"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <li ng-repeat="file in files">{{file.name}}</li> -->
                                        </div>
                                        <div class="modal-footer">
                                            <input type="text" name="iduser" ng-model="iduser" ng-hide="true">
                                            <!-- <input type="text" name="file_lama" ng-model="file_lama" ng-hide="false"> -->
                                            <button type="submit" class="btn btn-success col-sm-3 mb-6"><i
                                                    class="fas fa-edit"> Update</i></button>
                                            <button type="button" class="btn btn-danger col-sm-3 mb-6"
                                                ng-click="closeModal('#detailuserHeader')">Kembali</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->

                    </ul>

                </nav>
                <!-- End of Topbar -->