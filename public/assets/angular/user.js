sikepegawaian.controller("user", function ($scope, $http, $window, $timeout) {
  $scope.getUser = function () {
    $http.get("/user/getUser").then(function (data) {
      $scope.datas = data.data;
      // console.log(data);
    });
  };

  // hide and show pass
  $scope.typepass = "password";
  $scope.showHide = "fa fa-eye";
  $scope.showPassword = function () {
    if ($scope.typepass == "password") {
      $scope.typepass = "text";
      $scope.showHide = "fa fa-eye-slash";
    } else {
      $scope.typepass = "password";
      $scope.showHide = "fa fa-eye";
    }
  };

  $scope.c = false;
  $scope.check = function () {
    if ($scope.password != null) {
      $scope.spassword = { border: "solid none" };
      if (
        $scope.repass != null &&
        angular.equals($scope.password, $scope.repass)
      ) {
        $scope.srepass = { border: "solid none" };
        $scope.msg = "";
        $scope.c = true;
      } else if ($scope.repass == null) {
        if ($scope.password != "" || $scope.password == undefined) {
          // $scope.srepass = null;
          $scope.msg = "Ulangi Password";
          $scope.srepass = { border: "solid none" };
          $scope.c = false;
        } else {
          $scope.msg = null;
          $scope.srepass = null;
          $scope.c = true;
        }
      } else {
        if ($scope.password != "" || $scope.password != undefined) {
          $scope.spassword = { border: "solid red" };
          $scope.srepass = { border: "solid red" };
          $scope.msg = "Password Berbeda";
          $scope.s_msg = { color: "red" };
          $scope.c = false;
        } else {
          $scope.srepass = null;
          $scope.msg = null;
          $scope.c = false;
        }
      }
    } else {
      $scope.spassword = { border: "solid red" };
      $scope.c = false;
    }

    if ($scope.password == "") {
      $scope.repass = null;
    }
  };

  $scope.insertData = function () {
    $scope.error = $scope.success = false;
    var fd = new FormData();
    angular.forEach($scope.files, function (file) {
      fd.append("foto", file);
    });
    fd.append("email", $scope.email);
    fd.append("password", $scope.password);
    fd.append("repass", $scope.repass);
    $http
      .post("/user/insertData", fd, {
        transformRequest: angular.identity,
        headers: { "Content-Type": undefined, "Process-Data": true },
      })
      .then(
        function successCallback(data) {
          console.log("insert data", data);
          if (data.data.errortext == "") {
            $scope.fomUser.$setUntouched();
            $scope.fomUser.$setPristine();
            document.getElementById("formTambahUser").reset();
            $window.location.href = "/pegawai/tambah";
            $scope.error = false;
            $scope.message = data.data.errortext;
          } else {
            $scope.error = true;
            $scope.message = data.data.errortext;
          }
        },
        function errorCallback(response) {
          console.log("insert data", response);
          $scope.message = "Gagal Menyimpan Data";
        }
      );
  };

  $scope.setDefault = function () {
    $scope.formUser.$setUntouched();
    $scope.formUser.$setPristine();
    $scope.email = $scope.password = $scope.repass = $scope.srepass = $scope.spassword = $scope.msg = null;
    $scope.error = $scope.success = false;
  };

  $scope.getDetail = function (id) {
    $scope.setDefault();
    $http.get("/user/getDetail/" + id).then(
      function successCallback(data) {
        // console.log(data);
        $scope.openModal("#detailEditUser");
        $scope.modalTitle = "Detail User";
        $scope.submitButton = "Update";
        $scope.actionButton = "Kembali";
        $scope.errorMessage = null;
        $scope.error = false;
        $scope.hide = true;

        $scope.iduser = data.data[0].id_user;
        $scope.nama = data.data[0].nama;
        $scope.email = data.data[0].email;
        $scope.password_edit = data.data[0].password;
        $scope.role = data.data[0].role;
        $scope.status = data.data[0].status;
        $scope.foto = "/foto/" + data.data[0].foto;
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.getdetailuserHeader = function (id) {
    $scope.setDefault();
    $http.get("/user/getDetail/" + id).then(
      function successCallback(data) {
        $scope.openModal("#detailuserHeader");
        $scope.modalTitle = "Detail User";
        $scope.submitButton = "Update";
        $scope.actionButton = "Kembali";
        $scope.errorMessage = null;
        $scope.error = false;
        $scope.hide = true;

        $scope.iduser = data.data[0].id_user;
        $scope.nama = data.data[0].nama;
        $scope.email = data.data[0].email;
        $scope.password_edit = data.data[0].password;
        $scope.role = data.data[0].role;
        $scope.status = data.data[0].status;
        $scope.foto = "/foto/" + data.data[0].foto;
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.getNamaHeader = function (id) {
    $scope.setDefault();
    console.log(id);
    $http.get("/user/getDetail/" + id).then(
      function successCallback(data) {
        $scope.nama = data.data[0].nama;
        $scope.foto = "/foto/" + data.data[0].foto;
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.filesChanged = function (elm) {
    $scope.files = elm.files;
    $scope.$apply();
  };

  $scope.editData = function () {
    $scope.error = $scope.success = false;
    var fd = new FormData();
    angular.forEach($scope.files, function (file) {
      fd.append("foto", file);
    });
    fd.append("email", $scope.email);
    fd.append("status", $scope.status);
    fd.append("fileLama", $scope.foto);
    fd.append("role", $scope.role);
    fd.append("password", $scope.password);
    fd.append("repass", $scope.repass);
    $http
      .post("/user/updateData/" + $scope.iduser, fd, {
        transformRequest: angular.identity,
        headers: { "Content-Type": undefined, "Process-Data": true },
      })
      .then(
        function successCallback(data) {
          console.log("edit data", data);
          if (data.data.errortext == "") {
            $scope.getDetail($scope.iduser);
            $scope.success = true;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
            $scope.message = data.data.message;
            $scope.getUser();
          } else {
            $scope.error = true;
            $scope.message = data.data.errortext;
          }
        },
        function errorCallback(response) {
          $scope.readOnly = false;
          $scope.hide = false;
          console.log("gagalfoto", response);
          $scope.error = true;
          $scope.message = "Gagal Mengubah Data";
        }
      );
  };

  $scope.edituserHeader = function () {
    $scope.error = $scope.success = false;
    var fd = new FormData();
    angular.forEach($scope.files, function (file) {
      fd.append("foto", file);
    });
    fd.append("email", $scope.email);
    fd.append("status", "1");
    fd.append("fileLama", $scope.foto);
    fd.append("role", $scope.role);
    fd.append("password", $scope.password);
    fd.append("repass", $scope.repass);
    $http
      .post("/user/updateData/" + $scope.iduser, fd, {
        transformRequest: angular.identity,
        headers: { "Content-Type": undefined, "Process-Data": true },
      })
      .then(
        function successCallback(data) {
          console.log("edit data", data.data);
          if (data.data.errortext == "") {
            $scope.getDetail($scope.iduser);
            $scope.message = data.data.message;
            $scope.success = true;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
            // $scope.getDetail($scope.iduser);
          } else {
            $scope.error = true;
            $scope.message = data.data.errortext;
          }
        },
        function errorCallback(response) {
          console.log("error user", response);
          $scope.error = true;
          $scope.message = "Gagal Mengubah Data";
        }
      );
  };

  $scope.openModal = function (id) {
    var modal_popup = angular.element(id);
    modal_popup.modal("show");
  };

  $scope.closeModal = function (id) {
    var modal_popup = angular.element(id);
    modal_popup.modal("hide");
  };

  $scope.errorLastID = function () {
    $http.get("/pegawai/lastInsert").then(function (data) {
      console.log(data);
      $scope.lastid = data.data.id_user;
      $scope.fotolastinsert = data.data.foto;
      if ($scope.id != "noid") {
        $http
          .post("/pegawai/deleteLastInsert", {
            id_user: $scope.lastid,
            fotodelete: $scope.fotolastinsert,
            role: data.data.role,
          })
          .then(
            function successCallback(data) {
              console.log(data);
              console.log("berhasil Hapus");
            },
            function errorCallback(response) {
              console.log("gagal hapus", response);
            }
          );
      } else {
        console.log("noid");
      }
    });
  };
});
