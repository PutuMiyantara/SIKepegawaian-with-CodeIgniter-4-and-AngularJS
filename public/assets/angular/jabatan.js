sikepegawaian.controller("jabatan", function ($scope, $http, $window) {
  $scope.getJabatan = function () {
    console.log("berhasil");
    $http.get("/ajax/jabatan/").then(function (data) {
      $scope.datas = data.data;
      console.log(data.data);
    });
  };

  $scope.actionDetail = function () {
    if ($scope.submitButton == "Edit") {
      $scope.submitButton = "Simpan";
      $scope.actionButton = "Batal";
      $scope.readOnly = false;
      $scope.deletejabatan = true;
      $scope.modalTitle = "Edit Data Jabatan";
      $scope.typeButton = "button";
    } else {
      $scope.submitButton = "Edit";
      $scope.actionButton = "Kembali";
      $scope.readOnly = true;
      $scope.modalTitle = "Detail User";
      $scope.typeButton = "submit";
    }
  };

  $scope.actionbtn = function () {
    if ($scope.actionButton == "Kembali") {
      $scope.closeModal();
      $scope.deletejabatan = false;
    } else {
      $scope.submitButton = "Edit";
      $scope.actionButton = "Kembali";
      $scope.readOnly = true;
      $scope.deletejabatan = true;
      $scope.modalTitle = "Detail Data Jabatan";
      $scope.typeButton = "submit";
      $scope.getDetail($scope.id_jabatan);
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
      .post("/ajax/jabatan/getDetailJabatan", {
        id_jabatan: id,
      })
      .then(
        function successCallback(data) {
          $scope.openModal("#detailJabatan");
          $scope.modalTitle = "Detail Data Jabatan";
          $scope.submitButton = "Edit";
          $scope.typeButton = "button";
          $scope.actionButton = "Kembali";
          $scope.readOnly = true;
          $scope.deletejabatan = false;
          console.log(data.data);
          $scope.namaJabatan = data.data[0].nama_jabatan;
          $scope.id_jabatan = data.data[0].id_jabatan;
        },
        function errorCallback(response) {
          console.log(response);
        }
      );
  };

  $scope.editData = function () {
    console.log("editdata jabaans");
    $http
      .post("/ajax/jabatan/editData", {
        id_jabatan: $scope.id_jabatan,
        nama_jabatan: $scope.namaJabatan,
      })
      .then(
        function successCallback(data) {
          console.log("data", data.data);
          $scope.getJabatan();
        },
        function errorCallback(response) {
          console.log(response);
        }
      );
  };

  $scope.deleteJabatan = function (id) {
    var isconfirm = confirm("Ingin Menghapus Data");
    if (isconfirm) {
      $http
        .post("/ajax/jabatan/deleteJabatan", {
          id_jabatan: id,
        })
        .then(
          function successCallback(data) {
            $scope.closeModal("#detailJabatan");
            $scope.getJabatan();
          },
          function errorCallback(response) {
            console.log(response);
          }
        );
    }
  };

  $scope.bckTo = function () {
    $window.location.href = "/jabatan/";
  };

  $scope.insertData = function () {
    $http
      .post("/ajax/jabatan/insertData", {
        nama_jabatan: $scope.namaJabatan,
      })
      .then(
        function successCallback(data) {
          // $scope.getJabatan();
          alert("Berhasil Menyimpan Data");
          $window.location.href = "/jabatan/";
        },
        function errorCallback(response) {
          alert("Gagal Menyimpan Data");
        }
      );
  };
});
