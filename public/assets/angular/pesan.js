sikepegawaian.controller("pesan", function ($scope, $http, $window, $timeout) {
  $scope.getDataPesan = function () {
    $http.get("/pesan/getDataPesan").then(function (data) {
      $scope.datas = data.data;
      console.log(data);
    });
  };

  $scope.reSend = function (id_pesan, jenis) {
    $scope.success = $scope.error = false;
    $http
      .post("/pesan/reSend", {
        id_pesan: id_pesan,
        jenis: jenis,
      })
      .then(
        function successCallback(data) {
          console.log(data);
          if (data.data.message == "berhasil") {
            $scope.success = true;
            $scope.message = "Berhasil Mengirim Email";
            $timeout(function () {
              $scope.success = false;
            }, 5000);
            $scope.getDataPesan();
          } else {
            $scope.error = true;
            $scope.message = "Berhasil Mengirim Email";
            $timeout(function () {
              $scope.error = false;
            }, 5000);
          }
        },
        function errorCallback(response) {
          console.log(response);
        }
      );
  };

  $scope.deletePesan = function (id) {
    $scope.success = $scope.error = false;
    var isconfirm = confirm("Ingin Menghapus Data?");
    if (isconfirm) {
      $http
        .post("/pesan/deletePesan", {
          id_pesan: id,
        })
        .then(
          function successCallback(data) {
            $scope.getDataPesan();
            $scope.message = "Berhasil Menghapus Data";
            $scope.success = true;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
          },
          function errorCallback(response) {
            console.log(response);
            $scope.message = "Gagal Menghapus Data";
            $scope.error = true;
            $timeout(function () {
              $scope.error = false;
            }, 5000);
          }
        );
    }
  };
});
