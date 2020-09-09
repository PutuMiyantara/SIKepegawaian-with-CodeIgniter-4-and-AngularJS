sikepegawaian.controller("auth", function ($scope, $http, $window, $timeout) {
  $scope.login = function () {
    $scope.pesan();
    $http
      .post("/auth/login", {
        email: $scope.email,
        password: $scope.password,
      })
      .then(
        function successCallback(data) {
          if (data.data.dataLogin != "") {
            $scope.message = data.data.dataLogin;
            $scope.error = true;
          } else {
            if (data.data.checkUser == "admin") {
              $window.location.href = "/home/admin";
            } else if (data.data.checkUser == "pegawai") {
              $window.location.href = "/home/pegawai";
            }
          }
        },
        function errorCallback(response) {
          $scope.message = "Gagal Melakukan Login";
          $scope.error = true;
          console.log(response);
        }
      );
  };

  $scope.pesan = function () {
    $http.get("/pesan/pensiunpegawai").then(
      function successCallback(data) {
        console.log(data);
      },
      function errorCallback(response) {
        console.log(response);
      }
    );
  };
});
