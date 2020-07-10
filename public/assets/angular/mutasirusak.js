var mutasi = angular.module("mutasi", ["datatables", "ngRoute"]);
mutasi.controller("mutasi", function ($window, $scope, $http, $routeParams) {
  $scope.getSKMutasi = function () {
    $http.get("/ajax/mutasi/").then(function (data) {
      $scope.skmutasi = data.data;
    });
  };

  $scope.getIdSkMutasi = function (id) {
    $window.location.href = "/mutasi/detail/" + id;
  };

  $scope.getDetail = function () {
    var idd = window.location.href;
    var res = idd.split("/");
    $scope.id_mutasi_table = res[res.length - 1];
    $http
      .post("/ajax/mutasi/getDataMutasi", {
        id_mutasi: $scope.id_mutasi_table,
      })
      .then(
        function successCallback(data) {
          $scope.datas = data.data;
        },
        function errorCallback(response) {
          console.log(response);
        }
      );
  };

  $scope.getDetailSKMutasi = function (id) {
    $scope.openModalSKMutasi();
    $scope.modalTitle = "Edit Data Mutasi";
    $scope.submitButton = "Simpan";
    $scope.actionButton = "Kembali";
    $http
      .post("ajax/mutasi/getDetailSKMutasi", {
        id_mutasi: id,
      })
      .then(
        function successCallback(data) {
          $scope.id_mutasi = data.data[0].id_mutasi;
          $scope.no_skmutasi = data.data[0].no_sk;
          $scope.tgl_mutasi = new Date(data.data[0].tgl_mutasi);
        },
        function errorCallback(response) {
          console.log(response);
        }
      );
  };

  $scope.actionbtn = function () {
    $scope.closeModalSKMutasi();
  };

  $scope.editDataSKMutasi = function () {
    $http
      .post("../ajax/mutasi/updateSKMutasi", {
        id_mutasi: $scope.id_mutasi,
        no_sk: $scope.no_skmutasi,
        tgl_mutasi: $scope.tgl_mutasi,
      })
      .then(
        function successCallback(data) {
          alert("berhasil update");
          // $scope.closeModal();
          $scope.message = "berhasil update data";
          var id = $scope.id_mutasi;
          $scope.getDetailSKMutasi(id);
          $scope.getDetail();
        },
        function errorCallback(response) {
          alert("error");
          console.log(response);
        }
      );
  };

  $scope.openModalSKMutasi = function () {
    var modal_popup = angular.element("#detailEditSKMutasi");
    modal_popup.modal("show");
  };
  $scope.closeModalSKMutasi = function () {
    var modal_popup = angular.element("#detailEditSKMutasi");
    modal_popup.modal("hide");
  };

  $scope.option = function () {
    $scope.statusMutasi = [
      { value: "1", text: "Internal" },
      { value: "2", text: "Eksternal" },
    ];
  };

  $scope.getDetailMutasi = function (id) {
    $scope.openModalMutasi();
    $scope.modalTitle = "Detail Mutasi";
    $scope.submitButton = "Edit";
    $scope.actionButton = "Kembali";
    $scope.typeButton = "button";

    $http
      .post("/ajax/mutasi/getDetailMutasi", {
        id_mutasi_pegawai: id,
      })
      .then(
        function (data) {
          $scope.id_mutasi_pegawai = data.data[0].id_mutasi_pegawai;
          $scope.id_mutasi = data.data[0].id_mutasi;
          $scope.id_pegawai = data.data[0].id_pegawai;

          $scope.no_sk = data.data[0].no_sk;
          $scope.nip = data.data[0].nip;
          $scope.nama = data.data[0].nama;
          $scope.unit_tujuan = data.data[0].unit_tujuan;
          $scope.status_mutasi = data.data[0].status_mutasi;

          $scope.optionDisabled = true;
          $scope.readOnly = true;
        },
        function (response) {
          console.log("error", response);
        }
      );
  };

  $scope.actionDetail = function () {
    if ($scope.submitButton == "Edit") {
      $scope.submitButton = "Simpan";
      $scope.actionButton = "Batal";
      $scope.readOnly = false;
      $scope.optionDisabled = false;
      $scope.modalTitle = "Edit User";
      $scope.typeButton = "button";
    } else {
      $scope.submitButton = "Edit";
      $scope.actionButton = "Kembali";
      $scope.readOnly = true;
      $scope.optionDisabled = true;
      $scope.modalTitle = "Detail User";
      $scope.typeButton = "submit";
    }
  };

  $scope.actionbtn = function () {
    if ($scope.actionButton == "Kembali") {
      $scope.closeModal();
    } else {
      $scope.submitButton = "Edit";
      $scope.actionButton = "Kembali";
      $scope.readOnly = true;
      $scope.hide = true;
      $scope.optionDisabled = true;
      $scope.modalTitle = "Detail User";
      $scope.typeButton = "submit";

      $scope.getDetailMutasi($scope.id_mutasi_pegawai);
    }
  };

  $scope.editData = function () {
    $http
      .post("/ajax/mutasi/updateDataMutasi", {
        id_mutasi_pegawai: $scope.id_mutasi_pegawai,
        id_mutasi: $scope.id_mutasi,
        id_pegawai: $scope.id_pegawai,
        unit_tujuan: $scope.unit_tujuan,
        status_mutasi: $scope.status_mutasi,
      })
      .then(
        function successCallback(data) {
          alert("berhasil update");
          // $scope.closeModal();
          $scope.message = "berhasil update data";
          $scope.getDetail();
        },
        function errorCallback(response) {
          alert("error");
          console.log(response);
        }
      );
  };

  $scope.openModalMutasi = function () {
    var modal_popup = angular.element("#detailMutasi");
    modal_popup.modal("show");
  };
  $scope.closeModalMutasi = function () {
    var modal_popup = angular.element("#detailMutasi");
    modal_popup.modal("hide");
  };

  $http.get("/ajax/skp/getNameNipPeg").then(function (data) {
    $scope.nipdatas = data.data;
  });
  // change nip
  var c = false;
  $scope.hidenip = true;
  $scope.minnip = false;
  $scope.maxnip = false;
  $scope.nipreq = false;
  $scope.nipctrlChange = function () {
    if (string != null) {
      if (string.length < 18) {
        $scope.minnip = true;
        $scope.maxnip = false;
      } else if (string.length > 18) {
        $scope.maxnip = true;
        $scope.minnip = false;
      } else {
        $scope.minnip = false;
        $scope.maxnip = false;
      }
    } else {
      $scope.notfoundnip = null;
      $scope.minnip = false;
      $scope.maxnip = false;
    }
  };
  $scope.nipChange = function (string) {
    $scope.hidenama = true;
    $scope.minnip = false;
    $scope.maxnip = false;
    $scope.notfoundnama = null;
    $scope.hidenip = false;
    var output = [];
    if (string != null) {
      angular.forEach($scope.nipdatas, function (n) {
        if (n.nip.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(n);
        }
      });
      if()
    } else if(string == null){
      angular.forEach($scope.nipdatas, function (n) {
        output.push(n);
      });
    }
  };
  // change nip
  // change nama
  $scope.hidenama = true;
  $scope.namareq = false;
  $scope.namaChange = function (string) {};
  // change nama
  $scope.fillTextBox = function (nip, id_pegawai, nama) {
    $scope.editForm.$setUntouched();
    $scope.editForm.$setPristine();
    $scope.nip = nip;
    $scope.nama = nama;
    $scope.id_pegawai = id_pegawai;
    $scope.hidenip = true;
    $scope.hidenama = true;
    $scope.notfoundnama = null;
    $scope.notfoundnip = null;
    $scope.minnip = false;
    $scope.maxnip = false;
    c = true;
  };

  // change SKMutasi
  $scope.hidesk = true;
  $http.get("/ajax/mutasi/").then(function (data) {
    $scope.skmutasi = data.data;
  });
  $scope.skChange = function (string) {
    $scope.hidesk = false;
    var output = [];
    if (string != null) {
      angular.forEach($scope.skmutasi, function (n) {
        if (n.no_sk.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(n);
        }
      });
    } else {
      angular.forEach($scope.skmutasi, function (n) {
        output.push(n);
      });
    }
    console.log("output.length", output.length);
    if (output.length > 0) {
      $scope.filterSk = output;
      $scope.notfoundsk = null;
      if ($scope.no_sk == output[0].no_sk) {
        $scope.notfoundsk = null;
        $scope.hidesk = true;
        c = true;
        $scope.id_mutasi = output[0].id_mutasi;
      } else if ($scope.no_sk != output[0].no_sk && string != null) {
        $scope.notfoundsk = "Pilih Data Dibawah";
        c = false;
        $scope.id_pegawai = null;
      } else {
        $scope.notfoundsk = "Data Belum Dimasukan";
        c = false;
        $scope.id_pegawai = null;
      }
    } else if (output.length == 0) {
      $scope.hidesk = true;
      $scope.notfoundsk = "Data Tidak Ditemukan";
      c = false;
    }
    console.log(c);
  };

  // change SKMutasi
  $scope.fillTextBoxSKMutasi = function (id_mutasi, no_sk) {
    console.log("nosk", $scope.no_sk, no_sk);
    $scope.no_sk = no_sk;
    $scope.id_mutasi = id_mutasi;
    $scope.hidesk = true;
    $scope.notfoundsk = null;
    c = true;
    console.log(c);
  };
});
