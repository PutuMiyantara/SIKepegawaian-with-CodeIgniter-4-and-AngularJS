sikepegawaian.controller("skp", function ($scope, $http, $window) {
  $scope.getTahunSkp = function (selecttahun) {
    $http.get("/skp/getTahunSkp").then(function (data) {
      $scope.tahun = data.data;
      var dateNow = new Date();
      var tahunnow = dateNow.getFullYear();
      if (selecttahun == null) {
        $scope.tahunselect = tahunnow.toString();
      } else {
        $scope.tahunselect = selecttahun.toString();
      }
      $scope.getSkp($scope.tahunselect);
    });
  };

  $scope.changeTahun = function () {
    if ($scope.tahunselect == null) {
      tahun = "0000";
    } else {
      tahun = $scope.tahunselect;
    }
    $scope.getSkp(tahun);
  };

  $scope.getSkp = function (tahun) {
    $http.get("/skp/getSkp/" + tahun).then(
      function successCallback(data) {
        $scope.datas = data.data;
      },
      function errorCallback(response) {}
    );
  };

  $scope.insertData = function () {
    $http
      .post("/skp/insertDataSkp", {
        id_pegawai: $scope.id_pegawai,
        nama_atasan_pejpen: $scope.namaAtasanpejpen,
        nip_atasan_pejpen: $scope.nipAtasanpejpen,
        status_atasan_pejpen: $scope.statusAtasanpejpen,
        nama_pejpen: $scope.namaPejpen,
        nip_pejpen: $scope.nipPejpen,
        status_pejpen: $scope.statusPejpen,
        tahun_skp: $scope.tahunskp,
        nilai_skp: $scope.nilaiskp,
        nilai_pelayanan: $scope.nilaipelayanan,
        nilai_integritas: $scope.nilaiintegritas,
        nilai_komitmen: $scope.nilaikomitmen,
        nilai_disiplin: $scope.nilaidisiplin,
        nilai_kerjasama: $scope.nilaikerjasama,
        nilai_kepemimpinan: $scope.nilaikepemimpinan,
      })
      .then(
        function successCallback(data) {
          console.log(data);
          if (data.data.errortext == "") {
            if (data.data.skpunique == "") {
              // $window.location.href = "/pegawai/";
              document.getElementById("myForm").reset();
              $scope.myForm.$setUntouched();
              $scope.myForm.$setPristine();
              $scope.uniquetahun = null;
              alert(data.data.message);
              $scope.error = false;
              $window.history.back();
            } else {
              $scope.error = true;
              $scope.errorMessage = data.data.skpunique + $scope.tahunskp;
              alert("Gagal Menyimpan Data");
            }
          } else {
            $scope.error = true;
            $scope.errorMessage = data.data.errortext;
            alert("Gagal Menyimpan Data");
          }
        },
        function errorCallback(response) {
          alert("Gagal Menyimpan Data");
          $scope.error = true;
          $scope.errorMessage = "Gagal Menyimpan Data";
          console.log(response);
        }
      );
  };

  $scope.initInsert = function () {
    var id = $window.location.href;
    var res = id.split("/");
    var id_pegawai = res[5];
    console.log("id pegawai", res[5], id_pegawai);
    if (id_pegawai != null) {
      $http.get("/pegawai/getDetail/" + id_pegawai).then(
        function successCallback(data) {
          console.log(data);
          $scope.id_pegawai = id_pegawai;
          $scope.nip = data.data[0].nip;
          $scope.nama = data.data[0].nama;
          $scope.namanipReadOnly = true;
          $scope.skpReadOnly = true;
        },
        function errorCallback(response) {
          console.log(response);
        }
      );
    } else {
      $scope.skpReadOnly = false;
      console.log("tidak ada id_pegawai");
    }
  };

  $scope.tahunChange = function () {
    $scope.uniquetahun = null;
  };
  // change nip
  $scope.hidenip = true;
  $scope.minnip = false;
  $scope.maxnip = false;
  $scope.nipChange = function (string) {
    $http.get("/skp/getNameNipPeg").then(function (data) {
      $scope.nipdatas = data.data;
    });
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
          $scope.id_pegawai = output[0].id_pegawai;
          $scope.nipstyle = null;
        } else if (string.toLowerCase() != output[0].nip.toLowerCase()) {
          $scope.nipstyle = null;
          $scope.id_pegawai = null;
          $scope.notfoundnip = "Pilih Data Dibawah";
          $scope.nama = null;
        } else {
          $scope.nipstyle = { border: "solid red" };
          $scope.id_pegawai = null;
          $scope.notfoundnip = null;
        }
      } else {
        $scope.nipstyle = { border: "solid red" };
        $scope.namastyle = null;
        $scope.id_pegawai = null;
        $scope.nama = null;
        // $scope.notfoundnip = "Masukan NIP";
      }
    } else if (output.length == 0) {
      $scope.id_pegawai = null;
      $scope.nama = null;
      $scope.hidenip = true;
      $scope.hidenama = true;
      $scope.notfoundnip = "Data Tidak Ditemukan";
      $scope.nipstyle = { border: "solid red" };
    }
  };
  // change nip
  // change nama
  $scope.hidenama = true;
  $scope.namaChange = function (string) {
    $http.get("/skp/getNameNipPeg").then(function (data) {
      $scope.nipdatas = data.data;
    });
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
          $scope.namastyle = null;
          $scope.id_pegawai = output[0].id_pegawai;
        } else if (string.toLowerCase() != output[0].nama.toLowerCase()) {
          $scope.notfoundnama = "Pilih Data Dibawah";
          $scope.notfoundnip = null;
          $scope.nip = null;
          $scope.id_pegawai = null;
        } else {
          $scope.myForm.$setUntouched();
          $scope.myForm.$setPristine();
          $scope.notfoundnama = null;
          $scope.namastyle = { border: "solid red" };
          $scope.id_pegawai = null;
        }
      } else {
        $scope.myForm.$setUntouched();
        $scope.myForm.$setPristine();
        $scope.nip = null;
        $scope.notfoundnama = "Data Nama Kosong";
        $scope.namastyle = { border: "solid red" };
        $scope.id_pegawai = null;
      }
    } else if (output.length == 0) {
      $scope.nip = null;
      $scope.hidenama = true;
      $scope.notfoundnama = "Data Tidak Ditemukan";
      $scope.namastyle = { border: "solid red" };
      $scope.id_pegawai = null;
    }
  };

  $scope.fillTextBox = function (nip, id_pegawai, nama) {
    $scope.myForm.$setUntouched();
    $scope.myForm.$setPristine();
    $scope.nip = nip;
    $scope.nama = nama;
    $scope.id_pegawai = id_pegawai;
    $scope.hidenip = true;
    $scope.hidenama = true;
    $scope.notfoundnama = null;
    $scope.notfoundnip = null;
    $scope.minnip = false;
    $scope.maxnip = false;
    $scope.nipstyle = null;
    $scope.namastyle = null;
  };

  $scope.fillTextBox = function (nip, id_pegawai, nama) {
    $scope.myForm.$setUntouched();
    $scope.myForm.$setPristine();
    $scope.nip = nip;
    $scope.nama = nama;
    $scope.id_pegawai = id_pegawai;
    $scope.hidenip = true;
    $scope.hidenama = true;
    $scope.notfoundnama = null;
    $scope.notfoundnip = null;
    $scope.minnip = false;
    $scope.maxnip = false;
    $scope.nipstyle = null;
    $scope.namastyle = null;
  };

  $scope.option = function () {
    // ngOptions
    $scope.getStatusAtasanpejpen = ["PNS", "Bupati"];
    // $scope.getStatusAtasanpejpen = [
    //     { value: "1", text: "Internal" },
    //     { value: "2", text: "Eksternal" },
    //   ];
    $scope.getStatuspejpen = ["PNS"];
  };

  $scope.getDetail = function (id) {
    $scope.actionbtn();
    var idskp = id;
    $scope.modalTitle = "Detail SKP";
    $scope.submitButton = "Edit";
    $scope.actionButton = "Kembali";
    $scope.errorMessage = "error ni";
    $scope.submitButton = "Edit";
    $scope.typeButton = "button";

    $scope.deletejabatan = true;
    $http.get("/skp/getDetail/" + id).then(
      function successCallback(data) {
        $scope.openModal("#detailSkp");
        $http.get("/pegawai/getDetail/" + data.data[0].id_pegawai).then(
          function successCallback(data) {
            $scope.id_pegawai = data.data[0].id_pegawai;
            $scope.nip = data.data[0].nip;
            $scope.nama = data.data[0].nama;
          },
          function errorCallback(response) {
            alert("error");
          }
        );
        $scope.idskp = data.data[0].id_skp;
        $scope.nip = data.data[0].nip;
        $scope.nama = data.data[0].nama;
        $scope.namaAtasanpejpen = data.data[0].nama_atasan_pejpen;
        $scope.nipAtasanpejpen = data.data[0].nip_atasan_pejpen;
        $scope.statusAtasanpejpen = data.data[0].status_atasan_pejpen;
        $scope.namaPejpen = data.data[0].nama_pejpen;
        $scope.nipPejpen = data.data[0].nip_pejpen;
        $scope.statusPejpen = data.data[0].status_pejpen;
        $scope.tahunskp = parseInt(data.data[0].tahun_skp);
        $scope.nilaiskp = parseFloat(data.data[0].nilai_skp);
        $scope.nilaipelayanan = parseInt(data.data[0].nilai_pelayanan);
        $scope.nilaiintegritas = parseInt(data.data[0].nilai_integritas);
        $scope.nilaikomitmen = parseInt(data.data[0].nilai_komitmen);
        $scope.nilaidisiplin = parseInt(data.data[0].nilai_disiplin);
        $scope.nilaikerjasama = parseInt(data.data[0].nilai_kerjasama);
        $scope.nilaikepemimpinan = parseInt(data.data[0].nilai_kepemimpinan);

        if ($scope.statusAtasanpejpen == "Bupati") {
          console.log("bupati");
          $scope.checkAtasanPejpen = false;
          $scope.nipAtasanpejpen = null;
        } else if ($scope.statusAtasanpejpen == "PNS") {
          $scope.checkAtasanPejpen = true;
          console.log("pns");
        } else {
          $scope.checkAtasanPejpen = true;
          console.log("null");
        }
      },
      function errorCallback(response) {
        alert("error");
      }
    );
  };

  $scope.actionDetail = function () {};

  $scope.actionbtn = function () {
    // membuat semua field null;
    $scope.myForm.$setUntouched();
    $scope.myForm.$setPristine();
    $scope.id_pegawai = $scope.namaAtasanpejpen = $scope.nipAtasanpejpen = $scope.statusAtasanpejpen = $scope.namaPejpen = $scope.nipPejpen = $scope.statusPejpen = $scope.tahunskp = $scope.nilaiskp = $scope.nilaipelayanan = $scope.nilaiintegritas = $scope.nilaikomitmen = $scope.nilaidisiplin = $scope.nilaikerjasama = $scope.nilaikepemimpinan = null;
  };

  $scope.editData = function () {
    console.log("ini edit");
    $http
      .post("/skp/updateSkp/" + $scope.idskp, {
        id_pegawai: $scope.id_pegawai,
        nama_atasan_pejpen: $scope.namaAtasanpejpen,
        nip_atasan_pejpen: $scope.nipAtasanpejpen,
        status_atasan_pejpen: $scope.statusAtasanpejpen,
        nama_pejpen: $scope.namaPejpen,
        nip_pejpen: $scope.nipPejpen,
        status_pejpen: $scope.statusPejpen,
        tahun_skp: $scope.tahunskp,
        nilai_skp: $scope.nilaiskp,
        nilai_pelayanan: $scope.nilaipelayanan,
        nilai_integritas: $scope.nilaiintegritas,
        nilai_komitmen: $scope.nilaikomitmen,
        nilai_disiplin: $scope.nilaidisiplin,
        nilai_kerjasama: $scope.nilaikerjasama,
        nilai_kepemimpinan: $scope.nilaikepemimpinan,
      })
      .then(
        function successCallback(data) {
          console.log(data);
          if (data.data.errortext == "") {
            if (data.data.skpunique == "") {
              // $window.location.href = "/pegawai/";
              $scope.myForm.$setUntouched();
              $scope.myForm.$setPristine();
              $scope.uniquetahun = null;
              $scope.message = "Berhasil Mengupdate Data";
              var id = $scope.idskp;
              $scope.getDetail(id);
              $scope.getTahunSkp($scope.tahunskp);
              alert(data.data.message);
              $scope.error = false;
            } else {
              $scope.error = true;
              $scope.errorMessage = data.data.skpunique + $scope.tahunskp;
              alert("Gagal Menyimpan Data");
            }
          } else {
            $scope.error = true;
            $scope.errorMessage = data.data.errortext;
            alert("Gagal Menyimpan Data");
          }
        },
        function errorCallback(response) {
          alert("Gagal Mengubah Data");
          console.log(response);
        }
      );
  };

  $scope.openModal = function (openM) {
    var modal_popup = angular.element(openM);
    modal_popup.modal("show");
  };
  $scope.closeModal = function (openM) {
    var modal_popup = angular.element(openM);
    modal_popup.modal("hide");
  };

  $scope.bckTo = function () {
    $window.history.back();
  };

  $scope.deleteSkp = function (id) {
    console.log("deletemutasi");
    var isconfirm = confirm("Ingin Menghapus Data");
    if (isconfirm) {
      $http
        .post("/skp/deleteSkp", {
          id_skp: id,
        })
        .then(
          function successCallback(data) {
            $scope.closeModal();
            console.log("ini dellete");
            $scope.changeTahun();
          },
          function errorCallback(response) {
            console.log(response);
          }
        );
    }
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

  $scope.AtasanPejPen = function (string) {
    console.log($scope.statusAtasanpejpen);
    if (string == "Bupati") {
      console.log("bupati");
      $scope.checkAtasanPejpen = false;
      $scope.nipAtasanpejpen = null;
    } else if (string == "PNS") {
      $scope.checkAtasanPejpen = true;
      console.log("pns");
    } else {
      $scope.checkAtasanPejpen = true;
      console.log("null");
    }
  };

  $scope.checkAtasanPejpen = true;
  $scope.statusAtasanPejPen = function (string) {
    if (string == "Bupati") {
      $scope.checkAtasanPejpen = false;
      $scope.nipAtasanpejpen = null;
    } else if (string == "PNS") {
      $scope.checkAtasanPejpen = true;
    }
  };
});
