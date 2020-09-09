sikepegawaian.controller("pangkat", function (
  $scope,
  $http,
  $window,
  $timeout
) {
  $scope.getPangkat = function () {
    console.log("berhasil pangkat");
    $http.get("/pangkat/getDataPangkat").then(function (data) {
      $scope.datas = data.data;
    });
  };

  $scope.insertData = function () {
    $http
      .post("/pangkat/insertData", {
        nama_pangkat: $scope.namaPangkat,
        golongan: $scope.golongan,
        ruang: $scope.ruang,
      })
      .then(
        function succesCallback(data) {
          console.log(data);
          if (data.data.errortext == "") {
            $scope.formPangkat.$setUntouched();
            $scope.formPangkat.$setPristine();
            document.getElementById("fomTambahPangkat").reset();
            $window.location.href = "/pangkat/";
          } else {
            $scope.error = true;
            $scope.message = data.data.errortext;
          }
        },
        function errorCallback(response) {
          $scope.error = true;
          $scope.message = "Gagal Menyimpan Data";
          console.log(response);
        }
      );
  };

  $scope.deletePangkat = function (id) {
    isConfirm = confirm("Ingin Menghapus Data");
    if (isConfirm) {
      $http
        .post("/pangkat/deletePangkat", {
          id_pangkat: id,
        })
        .then(
          function succesCallback(data) {
            $scope.getPangkat();
            $scope.message = "Berhasil Menghapus Data";
            $scope.successDell = true;
            $timeout(function () {
              $scope.successDell = false;
            }, 5000);
          },
          function errorCallback(response) {
            console.log(response);
            $scope.message = "Gagal Menghapus Data";
            $scope.errorDell = true;
            $timeout(function () {
              $scope.errorDell = false;
            }, 5000);
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
    $scope.actionDetail();
    $http.get("/pangkat/getDetailPangkat/" + id).then(function (data) {
      console.log(data);
      $scope.openModal("#detailPangkat");
      $scope.modalTitle = "Detail Data Pangkat";
      $scope.id_pangkat = data.data[0].id_pangkat;
      $scope.namaPangkat = data.data[0].nama_pangkat;
      $scope.golongan = data.data[0].golongan;
      $scope.ruang = data.data[0].ruang;
    });
  };

  $scope.actionDetail = function () {
    $scope.namaPangkat = $scope.golonga = $scope.ruang = null;
    $scope.success = $scope.error = false;
    $scope.formPangkat.$setUntouched();
    $scope.formPangkat.$setPristine();
  };

  $scope.editData = function () {
    $http
      .post("/pangkat/updateData/" + $scope.id_pangkat, {
        nama_pangkat: $scope.namaPangkat,
        golongan: $scope.golongan,
        ruang: $scope.ruang,
      })
      .then(
        function succesCallback(data) {
          if (data.data.errortext == "") {
            $scope.formPangkat.$setUntouched();
            $scope.formPangkat.$setPristine();
            $scope.getPangkat();
            $scope.message = data.data.message;
            $scope.success = true;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
          } else {
            $scope.message = data.data.errortext;
            $scope.error = true;
          }
        },
        function errorCallback(response) {
          $scope.error = true;
          $scope.message = "Gagal Mengubah Data";
          console.log(response);
        }
      );
  };
});
