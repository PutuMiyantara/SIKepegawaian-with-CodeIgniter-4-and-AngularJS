sikepegawaian.controller("user", function ($scope, $http, $window) {
  $scope.getUser = function () {
    $http.get("/user/getUser").then(function (data) {
      $scope.datas = data.data;
      console.log(data);
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
    console.log("dadada");
    var fd = new FormData();
    angular.forEach($scope.files, function (file) {
      fd.append("foto", file);
    });

    fd.append("email", $scope.email);
    fd.append("password", $scope.password);
    fd.append("repass", $scope.repass);
    fd.append("role", $scope.role);
    fd.append("status", "1");
    fd.append("nama", $scope.nama);
    $http
      .post("/user/insertData", fd, {
        transformRequest: angular.identity,
        headers: { "Content-Type": undefined, "Process-Data": true },
      })
      .then(
        function successCallback(data) {
          console.log(data);
          if (data.data.errortext == "") {
            if (data.data.errorfoto == "") {
              alert(data.data.message);
              $scope.errorMessage = null;
              $scope.myForm.$setUntouched();
              $scope.myForm.$setPristine();
              $scope.error = false;
              document.getElementById("myForm").reset();
              $window.location.href = "/pegawai/tambah";
            } else {
              $scope.error = true;
              $scope.errorMessage = data.data.errorfoto;
            }
          } else {
            $scope.error = true;
            $scope.errorMessage = data.data.errortext;
          }
        },
        function errorCallback(response) {
          console.log("Gagal", response);
        }
      );
  };

  $scope.getDetail = function (id) {
    console.log(id);
    $scope.actionbtn();
    $http.get("/user/getDetail/" + id).then(
      function successCallback(data) {
        console.log(data);
        $scope.openModal("#detailEdit");
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
    console.log(id);
    $scope.actionbtn();
    $http.get("/user/getDetail/" + id).then(
      function successCallback(data) {
        console.log(data);
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
          console.log("edit data", data.data);
          if (data.data.errortext == "") {
            if (data.data.errorfoto == "") {
              $scope.getDetail($scope.iduser);
            } else {
              $scope.error = true;
              $scope.errorMessage = data.data.errorfoto;
            }
            // $scope.getDetail($scope.iduser);
            $scope.getUser();
            alert(data.data.message);
          } else {
            alert("Gagal Mengubah Data");
            $scope.error = true;
            $scope.errorMessage = data.data.errortext;
          }
        },
        function errorCallback(response) {
          $scope.submitButton = "Simpan";
          $scope.actionButton = "Batal";
          $scope.readOnly = false;
          $scope.hide = false;
          $scope.modalTitle = "Edit User";
          $scope.typeButton = "submit";
          console.log("gagalfoto", response);
          alert("Gagal Mengubah Data");
        }
      );
  };

  $scope.edituserHeader = function () {
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
          console.log("edit data", data.data);
          if (data.data.errortext == "") {
            if (data.data.errorfoto == "") {
              $scope.getDetail($scope.iduser);
            } else {
              $scope.error = true;
              $scope.errorMessage = data.data.errorfoto;
            }
            // $scope.getDetail($scope.iduser);
            alert(data.data.message);
          } else {
            alert("Gagal Mengubah Data");
            $scope.error = true;
            $scope.errorMessage = data.data.errortext;
          }
        },
        function errorCallback(response) {
          $scope.submitButton = "Simpan";
          $scope.actionButton = "Batal";
          $scope.readOnly = false;
          $scope.hide = false;
          $scope.modalTitle = "Edit User";
          $scope.typeButton = "submit";
          console.log("gagalfoto", response);
          alert("Gagal Mengubah Data");
        }
      );
  };

  $scope.actionbtn = function () {
    $scope.myForm.$setUntouched();
    $scope.myForm.$setPristine();
    $scope.email = $scope.password = $scope.repass = null;
  };

  $scope.openModal = function (id) {
    var modal_popup = angular.element(id);
    modal_popup.modal("show");
  };

  $scope.closeModal = function () {
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
