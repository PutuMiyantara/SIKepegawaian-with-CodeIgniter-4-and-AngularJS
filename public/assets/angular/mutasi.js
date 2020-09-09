sikepegawaian.controller("mutasi", function ($window, $scope, $http, $timeout) {
  $scope.getSKMutasi = function () {
    $http.get("/mutasi/getSKMutasi").then(function (data) {
      $scope.skmutasi = data.data;
      console.log(data);
    });
  };

  $scope.toMutasi = function (id) {
    $window.location.href = "/mutasi/" + id;
  };

  $scope.addRiwayatMutasi = function () {
    var id = $window.location.href;
    var res = id.split("/");
    var id_pegawai = res[5];
    console.log(id_pegawai);
    $window.location.href =
      "/mutasi/tambahMutasi/" + id_pegawai + "/" + "pegawai";
  };

  $scope.getDetail = function () {
    var idd = window.location.href;
    var res = idd.split("/");
    $scope.id_mutasi = res[4];
    $http.get("/mutasi/getDataMutasi/" + $scope.id_mutasi).then(
      function successCallback(data) {
        $scope.datas = data.data;
        console.log(data);
      },
      function errorCallback(response) {
        console.log(response);
      }
    );
    $http.get("/mutasi/getDetailSKMutasi/" + $scope.id_mutasi).then(
      function successCallback(data) {
        $scope.no_skLabel = data.data[0].no_sk;
      },
      function errorCallback(response) {
        console.log(response);
      }
    );
  };

  $scope.getIDMutasiPegawai = function () {
    var idd = window.location.href;
    var res = idd.split("/");
    id = res[5];
    ket = res[6];
    console.log(id, ket);
    if (id != null && ket != null) {
      if (ket == "mutasi") {
        $http.get("/mutasi/getDetailSKMutasi/" + id).then(
          function successCallback(data) {
            console.log("id mutasi:", id);
            $scope.id_mutasi = data.data[0].id_mutasi;
            $scope.no_sk = data.data[0].no_sk;
            $scope.tgl_mutasi = new Date(data.data[0].tgl_mutasi);
            $scope.no_SkReadOnly = true;
          },
          function errorCallback(response) {
            console.log(response);
          }
        );
      } else if (ket == "pegawai") {
        $http.get("/pegawai/getDetail/" + id).then(
          function successCallback(data) {
            console.log("id pegawai:", id);
            $scope.id_pegawai = data.data[0].id_pegawai;
            $scope.nama = data.data[0].nama;
            $scope.nip = data.data[0].nip;
            $scope.unit_asal = data.data[0].tempat_bekerja;
            $scope.nipnamaReadonly = true;
          },
          function errorCallback(response) {
            console.log(response);
          }
        );
      }
    } else {
      console.log("tanpa id");
    }
  };

  $scope.getDetailSKMutasi = function (id) {
    $scope.skeditForm.$setUntouched();
    $scope.skeditForm.$setPristine();
    $scope.error = false;
    $scope.errorMessage = null;
    $scope.notfoundsk = null;
    console.log("getDetail SK Mutasi" + id);
    if (id != null) {
      idm = id;
    } else {
      var idd = window.location.href;
      var res = idd.split("/");
      idm = res[res.length - 1];
    }
    $scope.openModal("#detailSkMutasi");
    $scope.modalTitle = "Edit Data SK Mutasi";
    $http.get("/mutasi/getDetailSKMutasi/" + idm).then(
      function successCallback(data) {
        $scope.id_mutasi = data.data[0].id_mutasi;
        $scope.no_sk = data.data[0].no_sk;
        $scope.tgl_mutasi = new Date(data.data[0].tgl_mutasi);
        // document.getElementById("formMutasi").reset();
        // $scope.formMutasi.$setUntouched();
        // $scope.formMutasi.$setPristine();
      },
      function errorCallback(response) {
        console.log(response);
      }
    );
  };

  $scope.actionbtn = function () {
    $scope.success = $scope.error = false;
    $scope.hidesk = $scope.hidenip = $scope.hidenama = true;
    $scope.pegawaiUnique = $scope.notfoundnip = $scope.pegawaiUnique = $scope.notfoundnama = $http.nipstyle = null;
    $scope.formMutasi.$setUntouched();
    $scope.formMutasi.$setPristine();
  };

  $scope.editDataSKMutasi = function () {
    $http
      .post("/mutasi/updateSKMutasi/" + $scope.id_mutasi, {
        no_sk: $scope.no_sk,
        tgl_mutasi: $scope.tgl_mutasi,
      })
      .then(
        function successCallback(data) {
          if (data.data.errortext != "") {
            $scope.message = data.data.errortext;
            $scope.error = true;
          } else {
            $scope.skeditForm.$setUntouched();
            $scope.skeditForm.$setPristine();
            $scope.error = false;
            $scope.message = data.data.message;
            $scope.success = true;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
          }
          $scope.getSKMutasi();
        },
        function errorCallback(response) {
          $scope.error = true;
          $scope.errorMessage = "Gagal Mengubah Data";
          console.log(response);
        }
      );
  };

  $scope.option = function () {
    $scope.statusMutasi = [
      { value: "1", text: "Internal" },
      { value: "2", text: "Eksternal" },
    ];
  };

  $scope.getDetailMutasi = function (id) {
    $scope.actionbtn();
    console.log("detailMutasi");
    $scope.openModal("#detailMutasi");
    $scope.modalTitle = "Detail Data Mutasi";
    $scope.submitButton = "Edit";
    $scope.actionButton = "Kembali";
    $scope.typeButton = "button";
    $http.get("/mutasi/getDetailMutasi/" + id).then(
      function (data) {
        console.log(data);
        $scope.id_mutasi_pegawai = data.data[0].id_mutasi_pegawai;
        $scope.id_mutasi = data.data[0].id_mutasi;
        $scope.id_pegawai = data.data[0].id_pegawai;

        $scope.no_sk = data.data[0].no_sk;
        $scope.nip = $scope.nipFormat(data.data[0].nip);
        $scope.nama = data.data[0].nama;
        $scope.unit_asal = data.data[0].unit_asal;
        $scope.unit_tujuan = data.data[0].unit_tujuan;
        $scope.status_mutasi = data.data[0].status_mutasi;
        $scope.tgl_mutasi = new Date(data.data[0].tgl_mutasi);
      },
      function (response) {
        console.log("error", response);
      }
    );
  };

  $scope.updateDataMutasi = function () {
    $http
      .post("/mutasi/updateDataMutasi/" + $scope.id_mutasi_pegawai, {
        id_mutasi: $scope.id_mutasi,
        id_pegawai: $scope.id_pegawai,
        unit_tujuan: $scope.unit_tujuan,
        status_mutasi: $scope.status_mutasi,
      })
      .then(
        function successCallback(data) {
          if (data.data.errortext != "") {
            $scope.readOnly = false;
            $scope.optionDisabled = false;
            $scope.error = true;
            $scope.message = data.data.errortext;
          } else if (data.data.nipunique == "false") {
            $scope.error = true;
            $scope.message =
              "Data Pegawai Sudah Terdapat Pada No SK. " + $scope.no_sk;
          } else {
            $scope.getDetail();
            $scope.formMutasi.$setUntouched();
            $scope.formMutasi.$setPristine();
            $scope.success = true;
            $scope.message = data.data.message;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
          }
        },
        function errorCallback(response) {
          console.log(response);
          $scope.error = true;
          $scope.message = "Gagal Mengubah Data";
        }
      );
  };

  $http.get("/skp/getNameNipPeg").then(function (data) {
    $scope.nipdatas = data.data;
  });
  // change nip
  $scope.namanipC = false;
  $scope.hidenip = true;
  $scope.minnip = false;
  $scope.maxnip = false;
  $scope.nipChange = function (string) {
    string = $scope.nipDeformat(string);
    console.log("nip change", string);
    $scope.hidenip = false;
    $scope.hidenama = true;
    $scope.notfoundnama = null;
    $scope.namastyle = null;
    $scope.pegawaiUnique = null;

    var output = [];
    if (string != null) {
      angular.forEach($scope.nipdatas, function (n) {
        if (n.nip.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(n);
        }
      });
    } else {
      angular.forEach($scope.nipdatas, function (n) {
        output.push(n);
      });
    }
    console.log("output.length", output.length);
    if (output.length > 0) {
      $scope.filterNip = output;
      $scope.notfoundnip = null;
      if (string != null) {
        $scope.notfoundnip = null;
        if (string.toLowerCase() == output[0].nip.toLowerCase()) {
          $scope.notfoundnip = null;
          $scope.hidenip = true;
          $scope.nama = output[0].nama;
          $scope.nip = output[0].nip;
          $scope.tempat_bekerja = output[0].tempat_bekerja;
          $scope.id_pegawai = output[0].id_pegawai;
          $scope.nipstyle = null;
          $scope.namanipC = true;
        } else if (string.toLowerCase() != output[0].nip.toLowerCase()) {
          $scope.nipstyle = null;
          $scope.id_pegawai = null;
          $scope.notfoundnip = "Pilih Data Dibawah";
          $scope.nama = null;
          $scope.unit_asal = null;
          $scope.namanipC = false;
        } else {
          $scope.nipstyle = { border: "solid red" };
          $scope.id_pegawai = null;
          $scope.notfoundnip = null;
          $scope.namanipC = false;
        }
      } else {
        $scope.nipstyle = { border: "solid red" };
        $scope.namastyle = null;
        $scope.id_pegawai = null;
        $scope.nama = null;
        $scope.unit_asal = null;
        // $scope.notfoundnip = "Masukan NIP";
        $scope.namanipC = false;
      }
    } else if (output.length == 0) {
      $scope.id_pegawai = null;
      $scope.nama = null;
      $scope.unit_asal = null;
      $scope.hidenip = true;
      $scope.hidenama = true;
      $scope.notfoundnip = "Data Tidak Ditemukan";
      $scope.nipstyle = { border: "solid red" };
      $scope.namanipC = false;
    }
    console.log($scope.namanipC);
  };
  // change nip
  // change nama
  $scope.hidenama = true;
  $scope.namaChange = function (string) {
    $scope.hidenama = false;
    $scope.hidenip = true;
    $scope.nipstyle = null;
    $scope.notfoundnip = null;
    $scope.pegawaiUnique = null;

    var output = [];
    if (string != null) {
      angular.forEach($scope.nipdatas, function (n) {
        if (n.nama.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(n);
        }
      });
    } else {
      angular.forEach($scope.nipdatas, function (n) {
        output.push(n);
      });
    }
    console.log("output.length", output.length);
    if (output.length > 0) {
      $scope.filterNama = output;
      $scope.notfoundnama = null;
      if (string != null) {
        if (string.toLowerCase() == output[0].nama.toLowerCase()) {
          $scope.notfoundnama = null;
          $scope.hidenama = true;
          $scope.nama = output[0].nama;
          $scope.nip = output[0].nip;
          $scope.unit_asal = output[0].tempat_bekerja;
          $scope.namastyle = null;
          $scope.id_pegawai = output[0].id_pegawai;
          $scope.namanipC = true;
        } else if (string.toLowerCase() != output[0].nama.toLowerCase()) {
          $scope.notfoundnama = "Pilih Data Dibawah";
          $scope.notfoundnip = null;
          $scope.nip = null;
          $scope.unit_asal = null;
          $scope.id_pegawai = null;
          $scope.namanipC = false;
        } else {
          $scope.formMutasi.$setUntouched();
          $scope.formMutasi.$setPristine();
          $scope.notfoundnama = null;
          $scope.namastyle = { border: "solid red" };
          $scope.id_pegawai = null;
          $scope.namanipC = false;
        }
      } else {
        $scope.formMutasi.$setUntouched();
        $scope.formMutasi.$setPristine();
        $scope.nip = null;
        $scope.unit_asal = null;
        $scope.notfoundnama = "Data Nama Kosong";
        $scope.namastyle = { border: "solid red" };
        $scope.id_pegawai = null;
        $scope.namanipC = false;
      }
    } else if (output.length == 0) {
      $scope.nip = null;
      $scope.unit_asal = null;
      $scope.hidenama = true;
      $scope.notfoundnama = "Data Tidak Ditemukan";
      $scope.namastyle = { border: "solid red" };
      $scope.id_pegawai = null;
      $scope.namanipC = false;
    }
    console.log($scope.namanipC);
  };

  $scope.fillTextBox = function (nip, id_pegawai, nama, unit_asal) {
    $scope.formMutasi.$setUntouched();
    $scope.formMutasi.$setPristine();
    $scope.nip = nip;
    $scope.nama = nama;
    $scope.unit_asal = unit_asal;
    $scope.id_pegawai = id_pegawai;
    $scope.hidenip = true;
    $scope.hidenama = true;
    $scope.notfoundnama = null;
    $scope.notfoundnip = null;
    $scope.minnip = false;
    $scope.maxnip = false;
    $scope.nipstyle = null;
    $scope.namastyle = null;
    $scope.namanipC = true;
    console.log("fill c", $scope.namanipC);
  };

  // change SKMutasi
  $scope.hidesk = true;
  $http.get("/mutasi/getSKMutasi").then(function (data) {
    $scope.skmutasi = data.data;
  });

  $scope.skC = false;
  $scope.skChange = function (string) {
    $scope.tgl_mutasi = null;
    $scope.pegawaiUnique = null;
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
      if (string != null) {
        if (string.toLowerCase() == output[0].no_sk.toLowerCase()) {
          $scope.notfoundsk = null;
          $scope.hidesk = true;
          $scope.id_mutasi = output[0].id_mutasi;
          $scope.no_sk = output[0].no_sk;
          $scope.tgl_mutasi = new Date(output[0].tgl_mutasi);
          $scope.skC = true;
        } else if (
          string.toLowerCase() != output[0].no_sk.toLowerCase() &&
          string != null
        ) {
          $scope.notfoundsk = "Pilih Data Dibawah";
          $scope.id_mutasi = null;
          $scope.skC = false;
        } else {
          $scope.notfoundsk = "Data Belum Dimasukan";
          $scope.id_mutasi = null;
          $scope.skC = false;
        }
      } else {
        $scope.formMutasi.$setUntouched();
        $scope.formMutasi.$setPristine();
        $scope.notfoundsk = "Masukan Nomor SK Mutasi";
        $scope.id_mutasi = null;
        $scope.tgl_mutasi = null;
        $scope.skC = false;
      }
    } else if (output.length == 0) {
      $scope.hidesk = true;
      $scope.notfoundsk = "Data Tidak Ditemukan";
      $scope.id_mutasi = null;
      $scope.tgl_mutasi = null;
      $scope.skC = false;
    }
    console.log("skc", $scope.skC);
  };

  // change SKMutasi
  $scope.fillTextBoxSKMutasi = function (id_mutasi, no_sk, tgl_mutasi) {
    console.log("nosk", $scope.no_sk, no_sk);
    $scope.no_sk = no_sk;
    $scope.id_mutasi = id_mutasi;
    $scope.tgl_mutasi = new Date(tgl_mutasi);
    $scope.hidesk = true;
    $scope.notfoundsk = null;
    $scope.skC = true;
    console.log("skc", $scope.skC);
  };

  $scope.insertDataSKMutasi = function () {
    $http
      .post("/mutasi/insertDataSKMutasi", {
        no_sk: $scope.no_skmutasi,
        tgl_mutasi: $scope.tgl_mutasi,
      })
      .then(
        function successCallback(data) {
          console.log(data);
          if (data.data.errortext != "") {
            $scope.error = true;
            $scope.message = data.data.errortext;
          } else {
            $scope.error = false;
            $scope.formSkMutasi.$setUntouched();
            $scope.formSkMutasi.$setPristine();
            document.getElementById("formSkMutasi").reset();
            $window.history.back();
          }
        },
        function errorCallback(response) {
          $scope.message = "Gagal Menyimpan Data";
          $scope.error = true;
          console.log(response);
        }
      );
  };

  $scope.addMutasi = function () {
    $window.location.href =
      "/mutasi/tambahMutasi/" + $scope.id_mutasi + "/" + "mutasi";
  };

  $scope.insertDataMutasi = function () {
    var idd = window.location.href;
    var res = idd.split("/");
    var id = res[5];
    // var ket = res[6];
    // defined chekidmutasi jadi 1 untuk !=undifined dan 2 untuk undifined
    $http
      .post("/mutasi/insertDataMutasi", {
        id_mutasi: $scope.id_mutasi,
        id_pegawai: $scope.id_pegawai,
        unit_asal: $scope.unit_asal,
        unit_tujuan: $scope.unit_tujuan,
        status_mutasi: $scope.status_mutasi,
      })
      .then(
        function successCallback(data) {
          console.log(data.data);
          if (data.data.errortext != "") {
            $scope.error = true;
            $scope.message = data.data.errortext;
          } else if (data.data.nipunique == "false") {
            $scope.error = true;
            $scope.message =
              "Data Pegawai Sudah Terdapat Pada No SK. " + $scope.no_sk;
          } else {
            $scope.formMutasi.$setUntouched();
            $scope.formMutasi.$setPristine();
            $scope.id_mutasi = $scope.id_pegawai = $scope.no_sk = $scope.nip = $scope.nama = $scope.unit_tujuan = $scope.unit_asal = $scope.status_mutasi = null;
            $window.history.back();
          }
        },
        function errorCallback(response) {
          $scope.error = true;
          $scope.message = "Gagal Menyimpan Data";
          console.log(response);
        }
      );
  };

  $scope.deleteMutasi = function (id_mutasi_pegawai, id_pegawai, unit_asal) {
    // var idpeg = $window.location.href;
    // var res = idpeg.split("/");
    // var id_pegawai = res[5];
    var tmp_bekerja_sebelumnya = confirm("Ingin Menghapus Data");
    if (tmp_bekerja_sebelumnya) {
      $http
        .post("/mutasi/deleteMutasi", {
          id_mutasi_pegawai: id_mutasi_pegawai,
          id_pegawai: id_pegawai,
          tmp_bekerja_sebelumnya: unit_asal,
        })
        .then(
          function successCallback(data) {
            console.log(data);
            $scope.closeModal("#detailMutasi");
            $scope.getDetail();
            $scope.message = "Data Berhasil Dihapus";
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

  $scope.nipFormat = function (nip) {
    nippeg = nip;
    nippeg =
      nippeg.substring(0, 8) +
      " " +
      nippeg.substring(8, 14) +
      " " +
      nippeg.substring(14, 15) +
      " " +
      nippeg.substring(15, 18);

    return nippeg;
  };

  $scope.nipDeformat = function (nip) {
    // console.log("deformatnip ", nip);
    // nip = nip;
    if (nip != null) {
      nippeg = nip.replace(/ /g, "");
      return nippeg;
    }
  };

  $scope.sendMessageMutasi = function () {
    $http
      .post("/pesan/sendMessageMutasi", {
        id_mutasi: $scope.id_mutasi,
      })
      .then(
        function successCallback(data) {
          $scope.successDell = true;
          $scope.message = "Berhasil Mengirim Email";
          $timeout(function () {
            $scope.successDell = false;
          }, 5000);
        },
        function errorCallback(response) {
          $scope.errorDell = true;
          $scope.message = "Gagal Mengirim Email";
          $timeout(function () {
            $scope.errorDell = false;
          }, 5000);
          console.log(response);
        }
      );
  };

  $scope.getRiwayatMutasi = function () {
    var id = $window.location.href;
    var res = id.split("/");
    var id_pegawai = res[5];
    console.log(id_pegawai + "get riwayat mutasi");
    $http.get("/pegawai/getDetail/" + id_pegawai).then(
      function successCallback(data) {
        $scope.dataNama = data.data[0].nama;
      },
      function errorCallback(response) {
        console.log(response);
      }
    );
    $http.get("/mutasi/getRiwayatMutasi/" + id_pegawai).then(
      function successCallback(data) {
        $scope.datas = data.data;
        console.log(data);
      },
      function errorCallback(response) {}
    );
  };

  $scope.deleteRiwayatMutasi = function (
    id_mutasi_pegawai,
    id_pegawai,
    unit_asal
  ) {
    var idpeg = $window.location.href;
    var res = idpeg.split("/");
    var id_pegawai = res[5];
    var tmp_bekerja_sebelumnya = confirm("Ingin Menghapus Data");
    if (tmp_bekerja_sebelumnya) {
      $http
        .post("/mutasi/deleteMutasi", {
          id_mutasi_pegawai: id_mutasi_pegawai,
          id_pegawai: id_pegawai,
          tmp_bekerja_sebelumnya: unit_asal,
        })
        .then(
          function successCallback(data) {
            console.log(data);
            $scope.getRiwayatMutasi(id_pegawai);
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

  $scope.updateRiwayatMutasi = function () {
    $http
      .post("/mutasi/updateDataMutasi/" + $scope.id_mutasi_pegawai, {
        id_mutasi: $scope.id_mutasi,
        id_pegawai: $scope.id_pegawai,
        unit_tujuan: $scope.unit_tujuan,
        unit_asal: $scope.unit_asal,
        status_mutasi: $scope.status_mutasi,
      })
      .then(
        function successCallback(data) {
          console.log(data);
          if (data.data.errortext != "") {
            $scope.readOnly = false;
            $scope.optionDisabled = false;
            $scope.error = true;
            $scope.message = data.data.errortext;
          } else if (data.data.nipunique == "false") {
            $scope.error = true;
            $scope.message =
              "Data Pegawai Sudah Terdapat Pada No SK. " + $scope.no_sk;
          } else {
            $scope.getRiwayatMutasi();
            $scope.formMutasi.$setUntouched();
            $scope.formMutasi.$setPristine();
            $scope.success = true;
            $scope.message = data.data.message;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
          }
        },
        function errorCallback(response) {
          alert("error");
          console.log(response);
        }
      );
  };

  $scope.getDetailRiwayatMutasi = function (id) {
    $scope.actionbtn();
    $http.get("/mutasi/getDetailMutasi/" + id).then(
      function successCallback(data) {
        console.log(data);
        $scope.openModal("#detailMutasiPeg");
        $scope.modalTitle = "Detail Mutasi";
        $scope.submitButton = "Update";
        $scope.actionButton = "Kembali";
        $scope.readOnly = true;
        $scope.hidesk = true;

        $scope.id_pegawai = data.data[0].id_pegawai;
        $scope.id_mutasi = data.data[0].id_mutasi;
        $scope.id_mutasi_pegawai = data.data[0].id_mutasi_pegawai;
        $scope.no_sk = data.data[0].no_sk;
        $scope.nip = $scope.nipFormat(data.data[0].nip);
        $scope.nama = data.data[0].nama;
        $scope.unit_tujuan = data.data[0].unit_tujuan;
        $scope.unit_asal = data.data[0].unit_asal;
        $scope.status_mutasi = data.data[0].status_mutasi;
        $scope.tgl_mutasi = new Date(data.data[0].tgl_mutasi);
      },
      function errorCallback(response) {
        console.log(response);
      }
    );
  };

  $scope.unduhData = function () {
    if ($scope.id_mutasi != null) {
      $window.location.href = "/mutasi/toExel/" + $scope.id_mutasi;
      $scope.successDell = true;
      $scope.message = "Berhasil Mengunduh Data";
      $timeout(function () {
        $scope.successDell = false;
      }, 5000);
    } else {
      $scope.errorDell = true;
      $scope.message = "Gagal Mengunduh Data";
      $timeout(function () {
        $scope.errorDell = false;
      }, 5000);
    }
  };
});
