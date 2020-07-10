sikepegawaian.controller("auth", function ($scope, $http, $window) {
  $scope.login = function () {
    var fd = new FormData();
    fd.append("email", $scope.email);
    fd.append("password", $scope.password);
    $http
      .post("/login", fd, {
        transformRequest: angular.identity,
        headers: { "Content-Type": undefined, "Process-Data": true },
      })
      .then(
        function successCallback(data) {
          console.log(data);
          // if (data.data.errortext == "") {
          //   if (data.data.message != "") {
          //     $window.location.href = "/user/admin";
          //   }
          // } else {
          //   $scope.error = true;
          //   $scope.errorMessage = data.data.errortext;
          // }
        },
        function errorCallback(response) {
          console.log("Gagal", response);
        }
      );
  };
});
