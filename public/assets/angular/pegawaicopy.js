var pegawai = angular.module("pegawai", ["datatables"]);
pegawai.controller("pegawai", function ($scope, $http, $window) {
  // $scope.getPegawai = function (id) {
  //   $http.get("/ajax/pegawai").then(
  //     function (data) {
  //       $scope.datas = data.data;
  //     },
  //     function errorCallback(response) {
  //       console.log(response);
  //     }
  //   );
  // };

  $scope.typePegawai = "3";
  $scope.getPegawai = function (id) {
    if (id != null) {
      typepegawai = id;
    } else {
      typepegawai = $scope.typePegawai;
    }
    $http.get("/pegawai/getPegawai/" + typepegawai).then(
      function (data) {
        console.log(data);
        $scope.datas = data.data;
      },
      function errorCallback(response) {
        console.log(response);
      }
    );
  };

  $scope.typePegawaitypePegawai = function () {
    $scope.jenisPegawai = [
      { value: "1", text: "PNS" },
      { value: "2", text: "Kontrak" },
      { value: "3", text: "All" },
    ];
  };

  $scope.changePegawai = function () {
    $scope.getPegawai($scope.typePegawai);
  };

  $scope.option = function () {
    // ngOptions
    $scope.getGender = ["Laki-Laki", "Perempuan"];
    $scope.getAgama = [
      "Hindu",
      "Islam",
      "Buddha",
      "Kristen",
      "Katolik",
      "Konghucu",
    ];
    $scope.getKawin = ["Sudah Menikah", "Belum Menikah", "Duda", "Janda"];
    $scope.getPendidikan = [
      "SMA Sederajat",
      "Diploma 1 (D1)",
      "Diploma 2 (D2)",
      "Diploma 3 (D3)",
      "Diploma 4 (D4)",
      "Sarjana (S1)",
      "Magister (S2)",
      "Doktor (S3)",
    ];

    $http.get("/pangkat/getPangkat").then(function (data) {
      $scope.gatPangkat = data.data;
    });

    $http.get("/jabatan/getJabatan").then(function (data) {
      $scope.getJabatan = data.data;
    });

    var role_akses = 0;
    $http.get("/pegawai/lastInsertRole").then(function (data) {
      var roles = data.data.role;

      role_akses = roles;
      $scope.hide = roles == 2 ? true : false;
      $scope.nip_required = roles == 2 ? false : true;
      $scope.pangkat_required = roles == 2 ? false : true;
      $scope.jabatan_required = roles == 2 ? false : true;
    });

    $scope.getStatusAtasanpejpen = ["PNS", "Bupati"];
    $scope.getStatuspejpen = ["PNS"];
  };

  // // $scope.insertDataaa = function () {
  // //   if ($scope.nip != null) {
  // //     var nippeg = $scope.nip;
  // //     nippeg = nippeg.replace(/ /g, "");
  // //   }
  // //   var lahir = $scope.tgl_lahir;
  // //   var tglpensiun = $scope.getPensiun(lahir);
  // //   if (lahir != null) {
  // //     console.log("ini", tglpensiun);
  // //     var thn = lahir.getFullYear(),
  // //       bln = lahir.getMonth() + 1,
  // //       tgl = lahir.getDate();
  // //     var tgllahir = thn + "-" + bln + "-" + tgl;
  // //   }
  // //   var fd = new FormData();
  // //   fd.append("nip", nippeg);
  // //   fd.append("nama", $scope.nama);
  // //   fd.append("jns_kelamin", $scope.jns_kelamin);
  // //   fd.append("tgl_lahir", tgllahir);
  // //   fd.append("tmp_lahir", $scope.tmp_lahir);
  // //   fd.append("agama", $scope.agama);
  // //   fd.append("status_kawin", $scope.status_kawin);
  // //   fd.append("jml_anak", $scope.jml_anak);
  // //   fd.append("alamat", $scope.alamat);
  // //   fd.append("pend_terakhir", $scope.pend_terakhir);
  // //   fd.append("tempat_bekerja", $scope.tempat_bekerja);
  // //   fd.append("pangkat", $scope.pangkat);
  // //   fd.append("jabatan", $scope.jabatan);
  // //   fd.append("tgl_pensiun", tglpensiun);
  // //   $http
  // //     .post("/ajax/pegawai/insertData", fd, {
  // //       transformRequest: angular.identity,
  // //       headers: {
  // //         "Content-Type": undefined,
  // //         "Process-Data": false,
  // //       },
  // //     })
  // //     .then(
  // //       function successCallback(data) {
  // //         console.log(data);
  // //         if (data.data.errortext == "") {
  // //           alert(data.data.message);
  // //           // $scope.allStyleError = null;
  // //           $scope.errorMessage = null;
  // //           $scope.myForm.$setUntouched();
  // //           $scope.myForm.$setPristine();
  // //           document.getElementById("myForm").reset();
  // //           // $window.location.href = "/pegawai/";
  // //         } else {
  // //           // $scope.allStyleError = { border: "solid red" };
  // //           $scope.error = true;
  // //           $scope.errorMessage = data.data.errortext;
  // //           alert("Gagal Menyimpan Data");
  // //         }
  // //       },
  // //       function errorCallback(response) {
  // //         console.log("Gagal Menyimpan Data addadaa", response);
  // //       }
  // //     );
  // // };
  $scope.idPegInit = function () {
    $http.get("/pegawai/lastInsert").then(function successCallback(data) {
      $scope.id_pegawai = data.data.id_user;
    });
  };

  $scope.insertData = function () {
    if ($scope.nip != null) {
      var nippeg = $scope.nip;
      nippeg = nippeg.replace(/ /g, "");
    }
    var lahir = $scope.tgl_lahir;
    var tglpensiun = $scope.getPensiun(lahir);
    if (lahir != null) {
      console.log("ini", tglpensiun);
      var thn = lahir.getFullYear(),
        bln = lahir.getMonth() + 1,
        tgl = lahir.getDate();
      var tgllahir = thn + "-" + bln + "-" + tgl;
    }
    if ($scope.jns_kelamin == undefined) {
      $scope.jns_kelamin = null;
    }
    if ($scope.tmp_lahir == undefined) {
      $scope.tmp_lahir = null;
    }
    if ($scope.agama == undefined) {
      $scope.agama = null;
    }
    if ($scope.status_kawin == undefined) {
      $scope.status_kawin = null;
    }
    if ($scope.jml_anak == undefined) {
      $scope.jml_anak = null;
    }
    console.log("id_pegawai ", $scope.id_pegawai);
    $http
      .post("/pegawai/insertData", {
        id_pegawai: $scope.id_pegawai,
        nip: nippeg,
        nama: $scope.nama,
        jns_kelamin: $scope.jns_kelamin,
        tgl_lahir: tgllahir,
        tmp_lahir: $scope.tmp_lahir,
        agama: $scope.agama,
        status_kawin: $scope.status_kawin,
        jumlah_anak: $scope.jml_anak,
        alamat: $scope.alamat,
        pend_terakhir: $scope.pend_terakhir,
        tempat_bekerja: $scope.tempat_bekerja,
        id_pangkat: $scope.pangkat,
        id_jabatan: $scope.jabatan,
        tgl_pensiun: tglpensiun,
      })
      .then(
        function successCallback(data) {
          console.log(data);
          if (data.data.errortext == "") {
            alert(data.data.message);
            // $scope.allStyleError = null;
            $scope.errorMessage = null;
            $scope.myForm.$setUntouched();
            $scope.myForm.$setPristine();
            document.getElementById("myForm").reset();
            $window.location.href = "/pegawai/";
          } else {
            // $scope.allStyleError = { border: "solid red" };
            $scope.error = true;
            $scope.errorMessage = data.data.errortext;
            alert("Gagal Menyimpan Data");
          }
        },
        function errorCallback(response) {
          console.log("Gagal Menyimpan Data addadaa", response);
        }
      );
  };

  $scope.getPensiun = function (tglLahir) {
    var pensiun = 50;
    tglLahir = new Date(tglLahir);
    console.log("getpensiuntgllahir", tglLahir);
    var thn = tglLahir.getFullYear() + pensiun;
    var bln = tglLahir.getMonth() + 1;
    var tgl = tglLahir.getDate();

    var convert = thn + "-" + bln + "-" + tgl;
    console.log("getpensiun", convert);
    return convert;
  };

  $scope.getDetail = function (id) {
    $http.get("/pegawai/getDetail/" + id).then(
      function successCallback(data) {
        $scope.openModal("#detailPegawai");

        if (data.data[0].role == "1") {
          // $scope.hide = false;
          // $scope.editrequired = true;
          // $scope.nip = data.data[0].nip;
          $scope.nip = $scope.nipFormat(data.data[0].nip);
          $scope.pangkat = data.data[0].id_pangkat;
          $scope.jabatan = data.data[0].id_jabatan;
          $scope.tglpensiun = new Date(data.data[0].tgl_pensiun);
          $scope.sisajabatan = $scope.waktuPensiun();
        } else if (data.data[0].role == "2") {
          $scope.hide = true;
          // $scope.editrequired = false;
        }
        $scope.modalTitle = "Detail Pegawai";
        $scope.submitButton = "Edit";
        $scope.actionButton = "Kembali";
        // $scope.error = false;
        // $scope.readOnly = true;
        // $scope.optionDisabled = true;
        $scope.submitButton = "Edit";
        $scope.typeButton = "button";

        $scope.id_pegawai = data.data[0].id_pegawai;
        $scope.nama = data.data[0].nama;
        $scope.jns_kelamin = data.data[0].jns_kelamin;
        $scope.tgl_lahir = new Date(data.data[0].tgl_lahir);
        $scope.tmp_lahir = data.data[0].tmp_lahir;
        $scope.agama = data.data[0].agama;
        $scope.status_kawin = data.data[0].status_kawin;
        $scope.jml_anak = parseInt(data.data[0].jumlah_anak);
        $scope.alamat = data.data[0].alamat;
        $scope.pend_terakhir = data.data[0].pend_terakhir;
        $scope.role = data.data[0].role;
        $scope.tempat_bekerja = data.data[0].tempat_bekerja;
        $scope.foto = "/foto/" + data.data[0].foto;

        // console.log(data.data[0].foto);
      },
      function errorCallback(response) {
        console.log("error", response);
        alert("error");
      }
    );
  };

  $scope.tglLahirChange = function (tglLahir) {
    console.log(tglLahir);
    // console.log(tglLahir.getFullYear());
    var tgl = $scope.getPensiun(tglLahir);

    $scope.tglpensiun = new Date(tgl);
    $scope.sisajabatan = $scope.waktuPensiun();
  };

  $scope.editData = function () {
    var tglpensiun = $scope.getPensiun($scope.tgl_lahir);
    var nip = $scope.nip;
    console.log("nip", nip);
    nippeg = $scope.nipDeformat(nip);
    $http
      .post("/pegawai/updateData/" + $scope.id_pegawai + "/" + $scope.role, {
        nip: nippeg,
        nama: $scope.nama,
        jns_kelamin: $scope.jns_kelamin,
        tgl_lahir: $scope.tgl_lahir,
        tmp_lahir: $scope.tmp_lahir,
        agama: $scope.agama,
        status_kawin: $scope.status_kawin,
        jumlah_anak: $scope.jml_anak,
        alamat: $scope.alamat,
        pend_terakhir: $scope.pend_terakhir,
        tempat_bekerja: $scope.tempat_bekerja,
        id_pangkat: $scope.pangkat,
        id_jabatan: $scope.jabatan,
        tgl_pensiun: tglpensiun,
      })
      .then(
        function successCallback(data) {
          console.log(data);
          if (data.data.errortext == "") {
            alert(data.data.message);
            $scope.errorMessage = null;
            $scope.myForm.$setUntouched();
            $scope.myForm.$setPristine();
            $scope.getDetail($scope.id_pegawai);
            $scope.getPegawai();
          } else {
            $scope.error = true;
            $scope.errorMessage = data.data.errortext;
            $scope.submitButton = "Simpan";
            $scope.actionButton = "Batal";
            $scope.readOnly = false;
            $scope.optionDisabled = false;
            $scope.typeButton = "button";
            $scope.hapusbtn = true;
            $scope.modalTitle = "Edit Pegawai";
            alert("Gagal Menyimpan Data");
          }
        },
        function errorCallback(response) {
          $scope.error = true;
          $scope.errorMessage = "Gagal Mengubah Data";
          alert("Gagal Mengubah Data");
          console.log(response);
          $scope.submitButton = "Simpan";
          $scope.actionButton = "Batal";
          $scope.readOnly = false;
          $scope.optionDisabled = false;
          $scope.typeButton = "button";
          $scope.hapusbtn = true;
          $scope.modalTitle = "Edit Pegawai";
        }
      );
  };

  $scope.waktuPensiun = function () {
    var tanggalpensiun = $scope.tglpensiun;
    var pensiun = [tanggalpensiun.getFullYear(), tanggalpensiun.getMonth() + 1];
    var dateNow = new Date();
    var tglnow = [dateNow.getFullYear(), dateNow.getMonth() + 1];
    if (tglnow[1] > pensiun[1]) {
      pensiun[0] = pensiun[0] - 1;
      pensiun[1] = pensiun[1] + 12;
    }
    var hasil = [pensiun[0] - tglnow[0], pensiun[1] - tglnow[1]];
    var tahun = " Tahun, ",
      bulan = " Bulan",
      hari = " Hari";
    if (hasil[0] == 0) {
      hasil[0] = "";
      tahun = "";
    }
    if (hasil[1] == 0) {
      hasil[1] = "";
      bulan = "";
    }
    console.log("sisa menjabat", (data = hasil[0] + tahun + hasil[1] + bulan));
    return (data = hasil[0] + tahun + hasil[1] + bulan);
  };

  // $scope.btnBackPeg = function () {
  //   $window.location.href = "/user/tambah";
  // };

  // change SKMutasi
  $http.get("/mutasi/getMutasi").then(function (data) {
    console.log("ini dia");
    $scope.skmutasi = data.data;
  });

  $scope.skC = false;
  $scope.skChange = function (string) {
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
    // console.log("output.length", output.length);
    if (output.length > 0) {
      $scope.filterSk = output;
      $scope.notfoundsk = null;
      if (string != null) {
        if (string.toLowerCase() == output[0].no_sk.toLowerCase()) {
          $scope.notfoundsk = null;
          $scope.hidesk = true;
          $scope.no_sk = output[0].no_sk;
          $scope.id_mutasi = output[0].id_mutasi;
          $scope.tgl_mutasi = new Date(output[0].tgl_mutasi);

          $scope.skC = true;
        } else if (
          string.toLowerCase() != output[0].no_sk.toLowerCase &&
          string != null
        ) {
          $scope.notfoundsk = "Pilih Data Dibawah";
          $scope.id_mutasi = null;
          $scope.tgl_mutasi = null;
          $scope.skC = false;
        } else {
          $scope.notfoundsk = "Data Belum Dimasukan";
          $scope.id_mutasi = null;
          $scope.tgl_mutasi = null;
          $scope.skC = false;
        }
      } else {
        $scope.myForm.$setUntouched();
        $scope.myForm.$setPristine();
        $scope.no_sk = null;
        $scope.id_mutasi = null;
        $scope.skC = false;
      }
    } else if (output.length == 0) {
      $scope.hidesk = true;
      $scope.notfoundsk = "Data Tidak Ditemukan";
      $scope.id_mutasi = null;
      $scope.tgl_mutasi = null;
      $scope.skC = false;
    }
    // console.log("skc", $scope.skC);
  };

  $http.get("/ajax/skp/getNameNipPeg").then(function (data) {
    $scope.nipdatas = data.data;
  });
  // change nip
  $scope.namanipC = false;
  $scope.hidenip = true;
  $scope.minnip = false;
  $scope.maxnip = false;
  $scope.nipChange = function (string) {
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
          $scope.namanipC = true;
        } else if (string.toLowerCase() != output[0].nip.toLowerCase()) {
          $scope.nipstyle = null;
          $scope.id_pegawai = null;
          $scope.notfoundnip = "Pilih Data Dibawah";
          $scope.nama = null;
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
        $scope.notfoundnip = "Masukan NIP";
        $scope.namanipC = false;
      }
    } else if (output.length == 0) {
      $scope.id_pegawai = null;
      $scope.nama = null;
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
          $scope.namastyle = null;
          $scope.id_pegawai = output[0].id_pegawai;
          $scope.namanipC = true;
        } else if (string.toLowerCase() != output[0].nama.toLowerCase()) {
          $scope.notfoundnama = "Pilih Data Dibawah";
          $scope.notfoundnip = null;
          $scope.nip = null;
          $scope.id_pegawai = null;
          $scope.namanipC = false;
        } else {
          $scope.myForm.$setUntouched();
          $scope.myForm.$setPristine();
          $scope.notfoundnama = null;
          $scope.namastyle = { border: "solid red" };
          $scope.id_pegawai = null;
          $scope.namanipC = false;
        }
      } else {
        $scope.myForm.$setUntouched();
        $scope.myForm.$setPristine();
        $scope.nip = null;
        $scope.notfoundnama = "Masukan Nama Pegawai";
        $scope.namastyle = { border: "solid red" };
        $scope.id_pegawai = null;
        $scope.namanipC = false;
      }
    } else if (output.length == 0) {
      $scope.nip = null;
      $scope.hidenama = true;
      $scope.notfoundnama = "Data Tidak Ditemukan";
      $scope.namastyle = { border: "solid red" };
      $scope.id_pegawai = null;
      $scope.namanipC = false;
    }
    console.log($scope.namanipC);
  };

  $scope.ctrlNipChange = function (string) {
    var output = [];

    if ($scope.myForm.nip.$error.pattern) {
      $scope.notfoundnip = null;
    } else {
      if (string != null) {
        angular.forEach($scope.nipdatas, function (n) {
          if (n.nip.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
            output.push(n);
          }
        });
        $scope.namastyle = null;
        console.log(output.length);
        if (string.length == 18) {
          if (output.length != 0) {
            if (string.toLowerCase() == output[0].nip.toLowerCase()) {
              $scope.namanipC = true;
            } else {
              $scope.namanipC = false;
            }
          } else {
            $scope.namanipC = false;
          }
        } else if (string.length > 18) {
          $scope.notfoundnip = "Maksimal NIP 18 Karakter";
          $scope.nipstyle = { border: "solid red" };
          $scope.namanipC = false;
        } else if (string.length < 18) {
          $scope.notfoundnip = "Minimal NIP 18 Karakter";
          $scope.nipstyle = { border: "solid red" };
          $scope.namanipC = false;
        } else {
          $scope.namanipC = false;
        }
      }
    }
    console.log($scope.namanipC);
  };
  $scope.ctrlAddNipChange = function (string) {
    var output = [];

    if ($scope.myForm.nip.$error.pattern) {
      $scope.notfoundnip = null;
    } else {
      if (string != null) {
        angular.forEach($scope.nipdatas, function (n) {
          if (n.nip.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
            output.push(n);
          }
        });
        $scope.namastyle = null;
        console.log(output.length);
        if (string.length == 18) {
          if (output.length != 0) {
            if (string.toLowerCase() == output[0].nip.toLowerCase()) {
              $scope.namanipC = true;
            } else {
              $scope.namanipC = false;
            }
          } else {
            $scope.namanipC = false;
          }
        } else if (string.length > 18) {
          $scope.notfoundnip = "Maksimal NIP 18 Karakter";
          $scope.nipstyle = { border: "solid red" };
          $scope.namanipC = false;
        } else if (string.length < 18) {
          $scope.notfoundnip = "Minimal NIP 18 Karakter";
          $scope.nipstyle = { border: "solid red" };
          $scope.namanipC = false;
        } else {
          $scope.namanipC = false;
        }
      }
    }
    console.log($scope.namanipC);
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
    $scope.namanipC = true;
    console.log("fill c", $scope.namanipC);
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

  $scope.optionmutasi = function () {
    $scope.statusMutasi = [
      { value: "1", text: "Internal" },
      { value: "2", text: "Eksternal" },
    ];
  };

  $scope.Mutasi = function (id) {
    console.log(id + "mutasi");
    $http.get("/pegawai/getDetail/" + id).then(
      function successCallback(data) {
        if (data.data[0].role == "1") {
          $scope.openModal("#detailMutasi");
          $scope.modalTitle = "Mutasi Pegawai";
          $scope.submitButton = "Mutasi";
          $scope.actionButton = "Kembali";
          $scope.readOnly = false;
          $scope.optionDisabled = false;
          $scope.submitButton = "Edit";
          $scope.typeButton = "button";
          $scope.hidesk = true;

          $scope.id_pegawai = data.data[0].id_pegawai;
          $scope.nip = data.data[0].nip;
          $scope.nama = data.data[0].nama;
        } else if (data.data[0].role == "2") {
          alert("Bukan Pegawai Negri Sipil(PNS)");
        }
      },
      function errorCallback(response) {
        console.log("gagal get mutasi", response);
      }
    );
  };

  $scope.insertDataMutasi = function () {
    $http
      .post("/mutasi/insertDataMutasi", {
        id_mutasi: $scope.id_mutasi,
        id_pegawai: $scope.id_pegawai,
        unit_tujuan: $scope.unit_tujuan,
        status_mutasi: $scope.status_mutasi,
      })
      .then(
        function successCallback(data) {
          console.log(data);
          if (data.data.errortext != "") {
            $scope.submitButton = "Simpan";
            $scope.actionButton = "Batal";
            $scope.readOnly = false;
            $scope.optionDisabled = false;
            $scope.typeButton = "button";
            $scope.hapusbtn = true;
            $scope.modalTitle = "Edit Pegawai";
            $scope.error = true;
            $scope.errorMessage = data.data.errortext;
            alert("Gagal Menyimpan Data");
          } else if (data.data.nipunique == "false") {
            $scope.submitButton = "Simpan";
            $scope.actionButton = "Batal";
            $scope.readOnly = false;
            $scope.optionDisabled = false;
            $scope.typeButton = "button";
            $scope.hapusbtn = true;
            $scope.modalTitle = "Edit Pegawai";
            $scope.error = true;
            $scope.errorMessage =
              "Data Pegawai Sudah Terdapat Pada " + $scope.no_sk;
            alert("Gagal Menyimpan Data");
          } else {
            alert(data.data.message);
            $scope.error = false;
            $scope.errorMessage = null;
            $scope.myForm.$setUntouched();
            $scope.myForm.$setPristine();
            $scope.id_mutasi = $scope.id_pegawai = $scope.no_sk = $scope.unit_tujuan = $scope.status_mutasi = null;

            $window.location.href = "/pegawai/";
          }
        },
        function errorCallback(response) {
          $scope.submitButton = "Simpan";
          $scope.actionButton = "Batal";
          $scope.readOnly = false;
          $scope.optionDisabled = false;
          $scope.typeButton = "button";
          $scope.hapusbtn = true;
          $scope.modalTitle = "Edit Pegawai";
          alert("Gagal Menyimpan Data");
          console.log(response);
        }
      );
  };

  // if (data.data == "b") {
  //   alert("Berhasil Menyimpan Data");
  //   $scope.closeModal("#detailMutasi");
  //   $scope.typePegawai = "3";
  //   $scope.getPegawai();
  //   $scope.pegawaiUnique = null;
  //   $scope.no_sk = null;
  //   $scope.nip = null;
  //   $scope.nama = null;
  //   $scope.id_mutasi = null;
  //   $scope.id_pegawai = null;
  //   $scope.unit_tujuan = null;
  //   $scope.status_mutasi = null;
  //   $scope.myForm.$setUntouched();
  //   $scope.myForm.$setPristine();
  // } else {
  //   alert("Gagal Menyimpan Data");
  //   $scope.pegawaiUnique =
  //     "Pegawai Sudah Terdapat pada " + $scope.no_sk;
  // }

  $scope.toDetailMutasi = function () {
    var id_pegawai = $scope.id_pegawai;
    console.log(id_pegawai);
    $window.location.href = "/pegawai/detailMutasi/" + id_pegawai;
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
      },
      function errorCallback(response) {}
    );
  };

  $scope.actionbtnMutasi = function (id) {
    if ($scope.actionButton == "Kembali") {
      $scope.closeModal("#detailMutasi");
    } else {
      $scope.submitButton = "Edit";
      $scope.actionButton = "Kembali";
      $scope.readOnly = true;
      $scope.hide = true;
      $scope.optionDisabled = true;
      $scope.typeButton = "submit";
      $scope.error = false;
      $scope.errorMessage = null;
      $scope.myForm.$setUntouched();
      $scope.myForm.$setPristine();
      $scope.getDetailMutasi(id);
    }
  };

  $scope.getDetailMutasi = function (id) {
    $http.get("/mutasi/getDetailMutasi/" + id).then(
      function successCallback(data) {
        console.log(data);
        $scope.openModal("#detailMutasi");
        $scope.modalTitle = "Detail Mutasi";
        $scope.submitButton = "Edit";
        $scope.actionButton = "Kembali";
        $scope.readOnly = true;
        $scope.typeButton = "button";
        $scope.hapusbtn = false;
        $scope.hidesk = true;

        $scope.id_pegawai = data.data[0].id_pegawai;
        $scope.id_mutasi = data.data[0].id_mutasi;
        $scope.id_mutasi_pegawai = data.data[0].id_mutasi_pegawai;
        $scope.no_sk = data.data[0].no_sk;
        $scope.nip = $scope.nipFormat(data.data[0].nip);
        $scope.nama = data.data[0].nama;
        $scope.unit_tujuan = data.data[0].unit_tujuan;
        $scope.status_mutasi = data.data[0].status_mutasi;
        $scope.tgl_mutasi = new Date(data.data[0].tgl_mutasi);
      },
      function errorCallback(response) {
        console.log(response);
      }
    );
  };

  $scope.deleteMutasi = function (id, id_pegawai) {
    var idpeg = $window.location.href;
    var res = idpeg.split("/");
    var id_pegawai = res[5];
    var tmp_bekerja_sebelumnya = prompt("Tempat Tugas: ");
    if (tmp_bekerja_sebelumnya && tmp_bekerja_sebelumnya != null) {
      $scope.error = false;
      $scope.errorMessage = null;
      $http
        .post("/mutasi/deleteMutasi", {
          id_mutasi_pegawai: id,
          id_pegawai: id_pegawai,
          tmp_bekerja_sebelumnya: tmp_bekerja_sebelumnya,
        })
        .then(
          function successCallback(data) {
            console.log(data);
            alert("Data Berhasil Dihapus");
            $scope.closeModal("#detailMutasi");
            $scope.getRiwayatMutasi(id_pegawai);
          },
          function errorCallback(response) {
            console.log(response);
          }
        );
    } else if (tmp_bekerja_sebelumnya && tmp_bekerja_sebelumnya == null) {
      $scope.error = true;
      $scope.errorMessage = "Data Tempat Kerja Kosong";
    }
  };

  // $scope.toDetailSKP = function (id_pegawai) {
  //   var id_pegawai = $scope.idpegawai;
  //   console.log(id_pegawai);
  //   $window.location.href = "/pegawai/detailSKP/" + id_pegawai;
  // };

  // $scope.getRiwayatSKP = function () {
  //   var id = $window.location.href;
  //   var res = id.split("/");
  //   var id_pegawai = res[res.length - 1];
  //   $http
  //     .post("/ajax/pegawai/detail", {
  //       id: id_pegawai,
  //     })
  //     .then(
  //       function successCallback(data) {
  //         $scope.namapegawaiSKP = data.data[0].nama;
  //       },
  //       function errorCallback(response) {
  //         console.log(response);
  //       }
  //     );
  //   $http
  //     .post("/ajax/skp/getRiwayatSKP", {
  //       id_pegawai: id_pegawai,
  //     })
  //     .then(
  //       function successCallback(data) {
  //         $scope.datas = data.data;
  //       },
  //       function errorCallback(response) {}
  //     );
  // };

  // $scope.AddSKP = function () {
  //   var id = $window.location.href;
  //   var res = id.split("/");
  //   var id_pegawai = res[res.length - 1];
  //   $window.location.href = "/skp/tambah/" + id_pegawai;
  // };

  $scope.addMutasi = function () {
    var id = $window.location.href;
    var res = id.split("/");
    var id_pegawai = res[5];
    console.log(id_pegawai);
    $window.location.href =
      "/mutasi/tambahMutasi/" + id_pegawai + "/" + "pegawai";
  };

  $scope.updateMutasi = function () {
    // var id = $window.location.href;
    // var res = id.split("/");
    // var id_pegawai = res[5];
    // console.log(id_pegawai + "aaa");
    $http
      .post("/mutasi/updateDataMutasi/" + $scope.id_mutasi_pegawai, {
        id_mutasi: $scope.id_mutasi,
        id_pegawai: $scope.id_pegawai,
        unit_tujuan: $scope.unit_tujuan,
        status_mutasi: $scope.status_mutasi,
      })
      .then(
        function successCallback(data) {
          console.log(data);
          if (data.data.errortext != "") {
            console.log("if");
            $scope.submitButton = "Simpan";
            $scope.actionButton = "Batal";
            $scope.readOnly = false;
            $scope.optionDisabled = false;
            $scope.typeButton = "button";
            $scope.hapusbtn = true;
            $scope.modalTitle = "Edit Mutasi";
            $scope.error = true;
            $scope.errorMessage = data.data.errortext;
            alert("Gagal Menyimpan Data");
          } else if (data.data.nipunique == "false") {
            console.log("else if");
            $scope.submitButton = "Simpan";
            $scope.actionButton = "Batal";
            $scope.readOnly = false;
            $scope.optionDisabled = false;
            $scope.typeButton = "button";
            $scope.hapusbtn = true;
            $scope.modalTitle = "Edit Mutasi";
            $scope.error = true;
            $scope.errorMessage =
              "NIP Terdapat Pada No SK Mutasi: " + $scope.no_sk;
            alert("Gagal Menyimpan Data");
          } else {
            console.log("else");
            alert(data.data.message);
            $scope.error = false;
            $scope.errorMessage = null;
            $scope.myForm.$setUntouched();
            $scope.myForm.$setPristine();
            $scope.getRiwayatMutasi();
          }
        },
        function errorCallback(response) {
          alert("error");
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

  // $scope.getDetailSkp = function (id) {
  //   $scope.modalTitle = "Detail SKP";
  //   $scope.submitButton = "Edit";
  //   $scope.actionButton = "Kembali";
  //   console.log("id getDetailskp" + id);
  //   $scope.getDetailDataSkp(id);
  //   $scope.readOnly = true;
  //   $scope.hapusbtn = false;
  // };

  // $scope.getDetailDataSkp = function (id) {
  //   $scope.openModal("#detailSkp");
  //   $http
  //     .post("/ajax/skp/detail", {
  //       id: id,
  //     })
  //     .then(
  //       function successCallback(data) {
  //         $http
  //           .post("/ajax/pegawai/detail", {
  //             id: data.data[0].id_pegawai,
  //           })
  //           .then(
  //             function successCallback(data) {
  //               $scope.namapegawaiSKP = data.data[0].nama;
  //               $scope.id_pegawai = data.data[0].id_pegawai;
  //               $scope.nip = data.data[0].nip;
  //               $scope.nama = data.data[0].nama;
  //             },
  //             function errorCallback(response) {
  //               alert("error");
  //             }
  //           );
  //         $scope.idskp = data.data[0].id_skp;
  //         $scope.idpegawai = data.data[0].id_pegawai;
  //         $scope.nip = data.data[0].nip;
  //         $scope.nama = data.data[0].nama;
  //         $scope.namaAtasanpejpen = data.data[0].nama_atasan_pejpen;
  //         $scope.nipAtasanpejpen = data.data[0].nip_atasan_pejpen;
  //         $scope.statusAtasanpejpen = data.data[0].status_atasan_pejpen;
  //         $scope.namaPejpen = data.data[0].nama_pejpen;
  //         $scope.nipPejpen = data.data[0].nip_pejpen;
  //         $scope.statusPejpen = data.data[0].status_pejpen;
  //         $scope.tahunskp = parseInt(data.data[0].tahun_skp);
  //         $scope.nilaiskp = parseInt(data.data[0].nilai_skp);
  //         $scope.nilaipelayanan = parseInt(data.data[0].nilai_pelayanan);
  //         $scope.nilaiintegritas = parseInt(data.data[0].nilai_integritas);
  //         $scope.nilaikomitmen = parseInt(data.data[0].nilai_komitmen);
  //         $scope.nilaidisiplin = parseInt(data.data[0].nilai_disiplin);
  //         $scope.nilaikerjasama = parseInt(data.data[0].nilai_kerjasama);
  //         $scope.nilaikepemimpinan = parseInt(data.data[0].nilai_kepemimpinan);
  //       },
  //       function errorCallback(response) {
  //         alert("error");
  //         console.log(response);
  //         console.log("ini error");
  //       }
  //     );
  // };

  // $scope.editDataSkp = function () {
  //   console.log("data id skp edit dataskp" + $scope.idskp);
  //   if ($scope.idskp != null) {
  //     $scope.namanipC = true;
  //   }
  //   if ($scope.namanipC == true) {
  //     $http
  //       .post("/ajax/skp/update", {
  //         id_skp: $scope.idskp,
  //         id_pegawai: $scope.id_pegawai,
  //         nama_atasan_pejpen: $scope.namaAtasanpejpen,
  //         nip_atasan_pejpen: $scope.nipAtasanpejpen,
  //         status_atasan_pejpen: $scope.statusAtasanpejpen,
  //         nama_pejpen: $scope.namaPejpen,
  //         nip_pejpen: $scope.nipPejpen,
  //         status_pejpen: $scope.statusPejpen,
  //         tahun_skp: $scope.tahunskp,
  //         nilai_skp: $scope.nilaiskp,
  //         nilai_pelayanan: $scope.nilaipelayanan,
  //         nilai_integritas: $scope.nilaiintegritas,
  //         nilai_komitmen: $scope.nilaikomitmen,
  //         nilai_disiplin: $scope.nilaidisiplin,
  //         nilai_kerjasama: $scope.nilaikerjasama,
  //         nilai_kepemimpinan: $scope.nilaikepemimpinan,
  //       })
  //       .then(
  //         function successCallback(data) {
  //           if (data.data == "gagal") {
  //             alert("Gagal Menyimpan Data");
  //             $scope.uniquetahun =
  //               "Tahun " +
  //               $scope.tahunskp +
  //               " Sudah Terdapat Pada NIP: " +
  //               $scope.nip;
  //           } else {
  //             alert("Berhasil Menyimpan Data");
  //             $scope.getDetailSkp($scope.idskp);
  //             $scope.getRiwayatSKP();
  //             $scope.myForm.$setUntouched();
  //             $scope.myForm.$setPristine();
  //             $scope.uniquetahun = null;
  //           }
  //         },
  //         function errorCallback(response) {
  //           alert("Gagal Mengubah Data");
  //           console.log(response);
  //         }
  //       );
  //   } else {
  //     console.log("NIP Dan nama kosong");
  //   }
  // };

  // $scope.deleteSkp = function (id) {
  //   var isconfirm = confirm("Ingin Menghapus Data");
  //   if (isconfirm) {
  //     $http
  //       .post("/ajax/skp/deleteSkp", {
  //         id_skp: id,
  //       })
  //       .then(
  //         function successCallback(data) {
  //           $scope.closeModal("#detailSkp");
  //           $scope.getRiwayatSKP();
  //           console.log("ini dellete");
  //         },
  //         function errorCallback(response) {
  //           console.log(response);
  //         }
  //       );
  //   }
  // };

  // $scope.actionbtnSkp = function (id) {
  //   if ($scope.actionButton == "Kembali") {
  //     $scope.closeModal("#detailSkp");
  //   } else {
  //     $scope.submitButton = "Edit";
  //     $scope.actionButton = "Kembali";
  //     $scope.readOnly = true;
  //     $scope.hide = true;
  //     $scope.typeButton = "submit";
  //     $scope.hapusbtn = false;
  //     $scope.getDetailSkp(id);
  //   }
  // };

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

  $scope.nipTglLahir = function (nip) {
    // console.log("nipTglLahir ", nip);
    nip = nip;
    if (nip != null) {
      var nip = $scope.nipDeformat(nip);
      // nip = nip.replace(/ /g, "");
      if (nip.length > 18) {
        $scope.maxnip = true;
        $scope.nipstyle = { border: "solid red" };
      } else if (nip.length < 18) {
        $scope.minnip = true;
        $scope.nipstyle = { border: "solid red" };
      } else {
        $scope.nipstyle = null;
        $scope.maxnip = $scope.minnip = false;
        nip = nip;
        console.log(nip);
        thn = nip.substring(0, 4);
        bln = nip.substring(4, 6);
        tgl = nip.substring(6, 8);
        jnsKelamin = nip.substring(14, 15);
        if (bln <= 12) {
          birthday = thn + "-" + bln + "-" + tgl;
          $scope.tglLahirChange(birthday);
          console.log("birday" + birthday);
          $scope.tgl_lahir = new Date(birthday);
        } else {
          $scope.errorNip = true;
          $scope.tgl_lahir = null;
        }
        if (jnsKelamin == 1) {
          $scope.jns_kelamin = "Laki-Laki";
        } else if (jnsKelamin == 2) {
          $scope.jns_kelamin = "Perempuan";
        }
      }
    }
  };

  // $scope.namaku = function (nama) {
  //   console.log(nama);
  // };
});
