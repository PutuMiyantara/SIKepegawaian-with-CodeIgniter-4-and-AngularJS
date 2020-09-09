sikepegawaian.controller("jabatan", function (
  $scope,
  $http,
  $window,
  $timeout
) {
  $scope.getJabatan = function () {
    console.log("berhasil");
    $http.get("/jabatan/getJabatan").then(function (data) {
      $scope.datas = data.data;
      console.log(data.data);
    });
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
    $scope.formJabatan.$setUntouched();
    $scope.formJabatan.$setPristine();
    document.getElementById("formDetailJabatan").reset();
    $http.get("/jabatan/getDetailJabatan/" + id).then(
      function successCallback(data) {
        console.log("data");
        $scope.openModal("#detailJabatan");
        $scope.modalTitle = "Detail Data Jabatan";
        $scope.submitButton = "Update";
        $scope.actionButton = "Kembali";
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
    $http
      .post("/jabatan/updateData/" + $scope.id_jabatan, {
        nama_jabatan: $scope.namaJabatan,
      })
      .then(
        function successCallback(data) {
          if (data.data.errortext == "") {
            $scope.formJabatan.$setUntouched();
            $scope.formJabatan.$setPristine();
            $scope.getJabatan();
            $scope.message = data.data.message;
            $scope.success = true;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
          } else {
            $scope.error = true;
            $scope.message = data.data.errortext;
          }
        },
        function errorCallback(response) {
          $scope.error = true;
          $scope.errorMessage = "Gagal Mengubah Data";
          console.log(response);
        }
      );
  };

  $scope.deleteJabatan = function (id) {
    var isconfirm = confirm("Ingin Menghapus Data");
    if (isconfirm) {
      $http
        .post("/jabatan/deleteJabatan", {
          id_jabatan: id,
        })
        .then(
          function successCallback(data) {
            $scope.getJabatan();
            $scope.message = "Berhasil Menghapus Data";
            $scope.successDell = true;
            $timeout(function () {
              $scope.successDell = false;
            }, 5000);
          },
          function errorCallback(response) {
            console.log(response);
            $scope.message = "Berhasil Menghapus Data";
            $scope.errorDell = true;
            $timeout(function () {
              $scope.errorDell = false;
            }, 5000);
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
      .post("/jabatan/insertData", {
        nama_jabatan: $scope.namaJabatan,
      })
      .then(
        function successCallback(data) {
          // $scope.getJabatan();
          if (data.data.errortext == "") {
            $scope.fomJabatan.$setUntouched();
            $scope.fomJabatan.$setPristine();
            // document.getElementById("formTambahJabatan").reset();
            $window.location.href = "/jabatan/";
          } else {
            $scope.error = true;
            $scope.message = data.data.errortext;
          }
        },
        function errorCallback(response) {
          $scope.error = true;
          $scope.message = "Gagal Menyimpan Data";
        }
      );
  };
});
