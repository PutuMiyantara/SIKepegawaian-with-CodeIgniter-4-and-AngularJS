sikepegawaian.controller("pangkat", function ($scope, $http, $window) {
  $scope.getPangkat = function () {
    console.log("berhasil pangkat");
    $http.get("/ajax/pangkat/").then(function (data) {
      $scope.datas = data.data;
    });
  };

  $scope.insertData = function () {
    gaji = $scope.gaji;
    gaji = gaji.replace(/[^,\d]/g, "");
    $http
      .post("/ajax/pangkat/insertData", {
        nama_pangkat: $scope.namaPangkat,
        gaji: gaji,
      })
      .then(
        function succesCallback(data) {
          alert("Berhasil Menyimpan Data");
          $window.location.href = "/pangkat/";
        },
        function errorCallback(response) {
          alert("Gagal Menyimpan Data");
          console.log(response);
        }
      );
  };

  $scope.priceFormat = function (string, prefix) {
    if (string != null) {
      var number_string = string.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
      if (ribuan) {
        separator = sisa ? "." : "";
        // separator = sisa ? "," : "";
        rupiah += separator + ribuan.join(".");
      }
      // rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
      prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
      console.log(rupiah);
      $scope.gaji = prefix + " " + rupiah;
      // return prefix + " " + rupiah;
    } else {
      $scope.gaji = null;
    }
  };

  $scope.deletePangkat = function (id) {
    isConfirm = confirm("Ingin Menghapus Data");
    if (isConfirm) {
      $http
        .post("/ajax/pangkat/deletePangkat", {
          id_pangkat: id,
        })
        .then(
          function succesCallback(data) {
            $scope.getPangkat();
          },
          function errorCallback(response) {
            console.log(response);
          }
        );
    }
  };

  $scope.openModal = function (openM) {
    var modal_popup = angular.element(openM);
    modal_popup.modal("show");
  };
  $scope.closeModal = function (openM) {
    var modal_popup = angular.element(openM);
    modal_popup.modal("hide");
  };

  $scope.getDetail = function (id) {
    $http
      .post("/ajax/pangkat/detailPangkat", {
        id_pangkat: id,
      })
      .then(
        function succesCallback(data) {
          console.log(data);
          $scope.openModal("#detailPangkat");
          $scope.modalTitle = "Detail Data Pangkat";
          $scope.submitButton = "Edit";
          $scope.actionButton = "Kembali";
          $scope.readOnly = true;
          $scope.typeButton = "button";
          $scope.id_pangkat = data.data[0].id_pangkat;
          $scope.namaPangkat = data.data[0].nama_pangkat;
          $scope.gaji = $scope.priceFormat(data.data[0].gaji, "Rp.");
        },
        function errorCallback(response) {
          console.log(response);
        }
      );
  };

  $scope.actionDetail = function () {
    if ($scope.submitButton == "Edit") {
      $scope.submitButton = "Simpan";
      $scope.actionButton = "Batal";
      $scope.readOnly = false;
      $scope.optionDisabled = false;
      $scope.typeButton = "button";
      $scope.hapusbtn = true;
    } else {
      $scope.submitButton = "Edit";
      $scope.actionButton = "Kembali";
      $scope.readOnly = true;
      $scope.typeButton = "submit";
      $scope.hapusbtn = false;
    }
  };

  $scope.actionbtn = function (id) {
    if ($scope.actionButton == "Kembali") {
      $scope.closeModal("#detailPegawai");
    } else {
      $scope.submitButton = "Edit";
      $scope.actionButton = "Kembali";
      $scope.readOnly = true;
      $scope.typeButton = "submit";

      $scope.getDetail(id);
    }
  };

  $scope.editData = function () {
    gaji = $scope.gaji;
    gaji = gaji.replace(/[^,\d]/g, "");
    $http
      .post("/ajax/pangkat/editData", {
        id_pangkat: $scope.id_pangkat,
        nama_pangkat: $scope.namaPangkat,
        gaji: gaji,
      })
      .then(
        function succesCallback(data) {
          alert("Berhasil Mengupdate Data");
          $scope.getPangkat();
        },
        function errorCallback(response) {
          alert("Gagal Mengupdate Data");
          console.log(response);
        }
      );
  };
});
