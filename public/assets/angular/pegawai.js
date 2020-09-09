sikepegawaian.controller("pegawai", function (
  $scope,
  $http,
  $window,
  $location,
  $timeout
) {
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

    $scope.datapangkat = function () {
      $http.get("/pangkat/getPangkat").then(function (data) {
        console.log(data.data);
        $scope.gatPangkat = data.data;
      });
    };

    $scope.datajabatan = function () {
      $http.get("/jabatan/getJabatan").then(function (data) {
        $scope.getJabatan = data.data;
      });
    };

    //

    $scope.getStatusAtasanpejpen = ["PNS", "Bupati"];
    $scope.getStatuspejpen = ["PNS"];
  };

  $scope.idPegInit = function () {
    $http.get("/pegawai/lastInsert").then(function successCallback(data) {
      $scope.id_pegawai = data.data.id_user;
    });
  };

  $scope.insertData = function () {
    $scope.success = $scope.error = false;
    $scope.nipformatcheck = true;
    if ($scope.nipformatcheck == true) {
      nippeg = $scope.nipDeformat($scope.nip);
      var lahir = $scope.tgl_lahir;
      var tglpensiun = $scope.getPensiun(lahir);
      if (lahir != null) {
        console.log("ini", tglpensiun);
        var thn = lahir.getFullYear(),
          bln = lahir.getMonth() + 1,
          tgl = lahir.getDate();
        var tgllahir = thn + "-" + bln + "-" + tgl;
      }
      $http
        .post("/pegawai/insertData", {
          id_pegawai: $scope.id_pegawai,
          nip: nippeg,
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
          tgl_pensiun: tglpensiun,
          nama: $scope.nama,
        })
        .then(
          function successCallback(data) {
            console.log("insert data pegawai", data);
            if (data.data.errortext == "") {
              $scope.error = false;
              $scope.formPegawai.$setUntouched();
              $scope.formPegawai.$setPristine();
              document.getElementById("formTambahPegawai").reset();
              $window.location.href = "/pegawai/";
            } else {
              $scope.message = data.data.errortext;
              $scope.error = true;
            }
          },
          function errorCallback(response) {
            $scope.error = true;
            $scope.message = "Gagal Menyimpan data";
            console.log("Gagal Menyimpan Data", response);
          }
        );
    } else {
      $scope.error = true;
      $scope.message = "Format NIP Salah";
    }
  };

  $scope.detailPeg = function (id) {
    $scope.getDetail(id);
    $scope.openModal("#detailPeg");
  };

  $scope.getDetail = function (id) {
    $scope.setDefault();
    console.log(id);
    $http.get("/pegawai/getDetail/" + id).then(
      function successCallback(data) {
        $scope.openModal("#detailPegawai");
        $scope.modalTitle = "Detail Pegawai";
        $scope.error = false;
        $scope.submitButton = "Edit";
        $scope.typeButton = "button";

        $scope.nip = data.data[0].nip;
        $scope.nip = $scope.nipFormat(data.data[0].nip);
        $scope.pangkat = data.data[0].id_pangkat;
        $scope.jabatan = data.data[0].id_jabatan;
        $scope.tglpensiun = new Date(data.data[0].tgl_pensiun);
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
        $scope.email = data.data[0].email;
        $scope.sisajabatan = $scope.waktuPensiun();

        $scope.peg_nama = $scope.nama;
        $scope.peg_tempat_bekerja = $scope.tempat_bekerja;
        $scope.peg_nip = $scope.nip;
        $scope.peg_tgl_pensiun = data.data[0].tgl_pensiun;
      },
      function errorCallback(response) {
        console.log("error", response);
        alert("error");
      }
    );
  };

  $scope.setDefault = function () {
    $scope.nipformatcheck = true;
    $scope.maxnip = $scope.minnip = false;
    $scope.errorNip = $scope.nipstyle = null;
    $scope.error = $scope.success = false;
    $scope.nip = $scope.nama = $scope.jns_kelamin = $scope.tgl_lahir = $scope.tmp_lahir = $scope.agama = $scope.status_kawin = $scope.jml_anak = $scope.alamat = $scope.pend_terakhir = $scope.tempat_bekerja = $scope.pangkat = $scope.jabatan = $scope.tglpensiun = null;
  };

  $scope.nipformatcheck = true;
  $scope.nipTglLahir = function (nip) {
    $scope.jns_kelamin = $scope.tgl_lahir = $scope.tglpensiun = $scope.sisajabatan = null;
    nip = nip;
    if (nip != null) {
      var nip = $scope.nipDeformat(nip);
      $scope.nipstyle = null;
      // nip = nip.replace(/ /g, "");
      if (nip.length > 18) {
        $scope.maxnip = true;
      } else if (nip.length < 18) {
        $scope.minnip = true;
      } else if (nip.length == 18) {
        $scope.nipstyle = null;
        $scope.maxnip = $scope.minnip = false;
        nip = nip;
        console.log(nip);
        thn = nip.substring(0, 4);
        bln = nip.substring(4, 6);
        tgl = nip.substring(6, 8);
        jnsKelamin = nip.substring(14, 15);
        console.log("bulan: :: " + bln);
        if (bln <= 12) {
          birthday = thn + "-" + bln + "-" + tgl;
          $scope.tglLahirChange(birthday);
          console.log("birday" + birthday);
          $scope.tgl_lahir = new Date(birthday);
          $scope.errorNip = null;
          $scope.nipstyle = null;
          if (jnsKelamin == 1) {
            $scope.jns_kelamin = "Laki-Laki";
            $scope.nipstyle = null;
            $scope.nipformatcheck = true;
          } else if (jnsKelamin == 2) {
            $scope.jns_kelamin = "Perempuan";
            $scope.nipstyle = null;
            $scope.nipformatcheck = true;
          } else {
            $scope.errorNip = "Format NIP Salah";
            $scope.tglpensiun = $scope.tgl_lahir = $scope.jns_kelamin = null;
            $scope.nipstyle = { border: "solid red" };
            $scope.nipformatcheck = false;
          }
        } else {
          $scope.errorNip = "Format NIP Salah";
          $scope.tgl_lahir = null;
          $scope.tglpensiun = null;
          $scope.nipstyle = { border: "solid red" };
          $scope.nipformatcheck = false;
        }
      }
    } else {
      $scope.nipstyle = null;
    }
  };

  $scope.tglLahirChange = function (tglLahir) {
    if (tglLahir != null) {
      console.log("ini" + tglLahir);
      tglLahir = new Date(tglLahir);
      console.log(tglLahir.getFullYear());
      var tgl = $scope.getPensiun(tglLahir);
      $scope.tglpensiun = new Date(tgl);
      $scope.sisajabatan = $scope.waktuPensiun();
    } else {
      $scope.tglpensiun = null;
      $scope.sisajabatan = null;
    }
  };

  $scope.getPensiun = function (tglLahir) {
    if (tglLahir != undefined) {
      var pensiun = 58;
      tglLahir = new Date(tglLahir);
      console.log("getpensiuntgllahir", tglLahir);
      var thn = tglLahir.getFullYear() + pensiun;
      var bln = tglLahir.getMonth() + 1;
      var tgl = tglLahir.getDate();
      var convert = thn + "-" + bln + "-" + tgl;
      console.log("getpensiun", convert);
      return convert;
    } else {
      return "";
    }
  };

  $scope.updateData = function () {
    $scope.nipformatcheck = true;
    if ($scope.nipformatcheck == true) {
      var tglpensiun = $scope.getPensiun($scope.tgl_lahir);
      var nip = $scope.nip;
      // console.log("nip", nip);
      nippeg = $scope.nipDeformat(nip);
      $http
        .post("/pegawai/updateData/" + $scope.id_pegawai, {
          nip: nippeg,
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
          nama: $scope.nama,
        })
        .then(
          function successCallback(data) {
            console.log(data);
            if (data.data.errortext == "") {
              $scope.getPegawai();
              $scope.detailPeg($scope.id_pegawai);
              $scope.formPegawai.$setUntouched();
              $scope.formPegawai.$setPristine();
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
            $scope.message = "Gagal Mengubah Data";
            console.log(response);
          }
        );
    } else {
      $scope.error = true;
      $scope.message = "Format NIP Salah";
    }
  };

  $scope.waktuPensiun = function () {
    var tanggalpensiun = $scope.tglpensiun;
    if (tanggalpensiun != null) {
      var pensiun = [
        tanggalpensiun.getFullYear(),
        tanggalpensiun.getMonth() + 1,
      ];
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
      console.log(
        "sisa menjabat",
        (data = hasil[0] + tahun + hasil[1] + bulan)
      );
      return (data = hasil[0] + tahun + hasil[1] + bulan);
    } else {
      return null;
    }
  };

  // change SKMutasi
  $scope.skC = false;
  $scope.skChange = function (string) {
    $http.get("/mutasi/getMutasi").then(function (data) {
      console.log("ini dia");
      $scope.skmutasi = data.data;
    });
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
        $scope.formMutasi.$setUntouched();
        $scope.formMutasi.$setPristine();
        $scope.no_sk = null;
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

  $scope.setDefaultMutasi = function () {
    $scope.success = $scope.error = false;
    $scope.hidesk = $scope.hidenip = $scope.hidenama = true;
    $scope.pegawaiUnique = $scope.notfoundnip = $scope.pegawaiUnique = $scope.notfoundnama = $scope.nipstyle = $scope.notfoundsk = null;
    $scope.nama = $scope.tgl_mutasi = $scope.unit_tujuan = $scope.status_mutasi = $scope.no_sk = null;
    $scope.formMutasi.$setUntouched();
    $scope.formMutasi.$setPristine();
  };

  $scope.Mutasi = function (id) {
    $scope.setDefaultMutasi();
    $scope.maxnip = $scope.minnip = false;
    $scope.errorNip = $scope.nipstyle = null;
    console.log(id + "mutasi");
    $http.get("/pegawai/getDetail/" + id).then(
      function successCallback(data) {
        $scope.openModal("#mutasiPeg");
        $scope.modalTitle = "Mutasi Pegawai";
        $scope.hidesk = true;
        $scope.id_pegawai = data.data[0].id_pegawai;
        $scope.nip = data.data[0].nip;
        $scope.nama = data.data[0].nama;
        $scope.unit_asal = data.data[0].tempat_bekerja;
      },
      function errorCallback(response) {
        console.log("gagal get mutasi", response);
      }
    );
  };

  $scope.Skp = function (id) {
    $scope.setDefaultSkp();
    $http.get("/pegawai/getDetail/" + id).then(
      function successCallback(data) {
        $scope.openModal("#insertSkpPeg");
        $scope.modalTitle = "Tambah Data SKP";
        $scope.submitButton = "Simpan";
        $scope.actionButton = "Kembali";
        $scope.hidesk = true;
        $scope.id_pegawai = data.data[0].id_pegawai;
        $scope.nip = data.data[0].nip;
        $scope.nama = data.data[0].nama;
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
        unit_asal: $scope.unit_asal,
        unit_tujuan: $scope.unit_tujuan,
        status_mutasi: $scope.status_mutasi,
      })
      .then(
        function successCallback(data) {
          console.log(data);
          if (data.data.errortext != "") {
            $scope.success = false;
            $scope.error = true;
            $scope.message = data.data.errortext;
          } else if (data.data.nipunique == "false") {
            $scope.success = false;
            $scope.error = true;
            $scope.message = "Data Pegawai Sudah Terdapat Pada " + $scope.no_sk;
          } else {
            $scope.closeModal("#mutasiPeg");
            $scope.formMutasi.$setUntouched();
            $scope.formMutasi.$setPristine();
            $scope.id_mutasi = $scope.id_pegawai = $scope.no_sk = $scope.unit_tujuan = $scope.status_mutasi = null;
            $scope.getPegawai($scope.typePegawai);
            $scope.error = false;
            $scope.message = data.data.message;
            $scope.successMutasiSkp = true;
            $timeout(function () {
              $scope.successMutasiSkp = false;
            }, 10000);
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

  $scope.toDetailMutasi = function () {
    var id_pegawai = $scope.id_pegawai;
    console.log(id_pegawai);
    $window.location.href = "/pegawai/detailMutasi/" + id_pegawai;
  };

  $scope.toDetailSKP = function (id_pegawai) {
    // var id_pegawai = $scope.idpegawai;
    console.log(id_pegawai);
    $window.location.href = "/pegawai/detailSKP/" + id_pegawai;
  };

  $scope.openModal = function (openM) {
    var modal_popup = angular.element(openM);
    modal_popup.modal("show");
  };

  $scope.closeModal = function (openM) {
    var modal_popup = angular.element(openM);
    modal_popup.modal("hide");
  };

  $scope.setDefaultSkp = function () {
    $scope.error = $scope.success = false;
    // membuat semua field null;
    $scope.formSkp.$setUntouched();
    $scope.formSkp.$setPristine();
    $scope.id_pegawai = $scope.namaAtasanpejpen = $scope.nipAtasanpejpen = $scope.statusAtasanpejpen = $scope.namaPejpen = $scope.nipPejpen = $scope.statusPejpen = $scope.tahunskp = $scope.nilaiskp = $scope.nilaipelayanan = $scope.nilaiintegritas = $scope.nilaikomitmen = $scope.nilaidisiplin = $scope.nilaikerjasama = $scope.nilaikepemimpinan = null;
  };

  $scope.ratarataSkp = function () {
    hasil =
      ($scope.nilaipelayanan +
        $scope.nilaiintegritas +
        $scope.nilaikomitmen +
        $scope.nilaidisiplin +
        $scope.nilaikerjasama +
        $scope.nilaikepemimpinan) /
      6;
    $scope.nilaiskp = Number(hasil.toFixed(2));
    console.log($scope.nilaiskp);
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
    if (nip != null) {
      nippeg = nip.replace(/ /g, "");
      return nippeg;
    }
  };

  $scope.insertDataSkp = function () {
    if ($scope.statusAtasanpejpen == "Bupati") {
      var statusatasan = 1;
    } else {
      var statusatasan = 2;
    }
    $http
      .post("/skp/insertDataSkp/" + statusatasan, {
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
              $scope.formSkp.$setUntouched();
              $scope.formSkp.$setPristine();
              $scope.uniquetahun = null;
              $scope.closeModal("#insertSkpPeg");
              $scope.error = false;
              $scope.message = data.data.message;
              $scope.successMutasiSkp = true;
              $timeout(function () {
                $scope.successMutasiSkp = false;
              }, 10000);
            } else {
              $scope.error = true;
              $scope.message = data.data.skpunique + $scope.tahunskp;
            }
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

  $scope.checkAtasanPejpen = true;
  $scope.statusAtasanPejPen = function (string) {
    if (string == "Bupati") {
      $scope.checkAtasanPejpen = false;
      $scope.nipAtasanpejpen = null;
    } else if (string == "PNS") {
      $scope.checkAtasanPejpen = true;
    }
  };

  $scope.getDataPensiun = function () {
    $http.get("/pegawai/getdataPensiun/").then(
      function (data) {
        $scope.datas = data.data;
      },
      function errorCallback(response) {
        console.log(response);
      }
    );
  };

  $scope.chartDataPeg = function () {
    $http.get("/pegawai/getLengthPeg").then(
      function (data) {
        console.log(data);
        $scope.dataPeg = data.data;
      },
      function errorCallback(response) {
        console.log(response);
      }
    );
  };

  $scope.chartDataPesan = function () {
    var d = document.getElementById("dataPesan");
    $http.get("/pegawai/getLengthPesan").then(
      function (data) {
        console.log(data);
        dataTerkirim = data.data.pesanTerkirim;
        dataAllPesan = data.data.allPesan;
        dataPersen = (dataTerkirim / dataAllPesan) * 100;
        $scope.datapesanTerkirim = data.data.pesanTerkirim;
        d.style.width = dataPersen + "%";
      },
      function errorCallback(response) {
        console.log(response);
      }
    );
  };

  $scope.chartSKP = function () {
    $http.get("/pegawai/getChartSkp").then(function (data) {
      var dataPeg = data.data.tidakMengirim;
      var dataSkp = data.data.mengirim;
      var tahun = data.data.tahun;
      $scope.labelskp = ["Mengupload", "Tidak Mengupload"];
      $scope.dataskp = [dataSkp, dataPeg];
      $scope.tahun_skp = tahun;
      $scope.colorsskp = [
        {
          backgroundColor: ["rgba(0, 255, 46, 0.2)"],
          pointBackgroundColor: ["rgba(0, 255, 46, 1)"],
          borderColor: ["rgba(159,204,0, 0.2)", "rgba(159,204,0, 0.2)"],
          pointBorderColor: ["rgba(159,204,0, 0.2)", "rgba(159,204,0, 0.2)"],
          pointHoverBorderColor: [
            "rgba(159,204,0, 0.2)",
            "rgba(159,204,0, 0.2)",
          ],
        },
        {
          backgroundColor: ["rgba(255, 0, 0, 0.2)"],
          pointBackgroundColor: ["rgba(255, 0, 0, 1)"],
          borderColor: ["rgba(159,204,0, 0.2)", "rgba(159,204,0, 0.2)"],
          pointBorderColor: ["rgba(159,204,0, 0.2)", "rgba(159,204,0, 0.2)"],
          pointHoverBorderColor: [
            "rgba(159,204,0, 0.2)",
            "rgba(159,204,0, 0.2)",
          ],
        },
        "rgba(250,109,33,0.5)",
        "#9a9a9a",
        "rgb(233,177,69)",
      ];
    });
  };

  $scope.chartPensiun = function () {
    $http.get("/pegawai/getChartPensiun").then(function (data) {
      var data = data.data.jumlahPensiun;
      var jumlahPensiun = [];
      $scope.labels = Object.keys(data);
      console.log(data);
      for (index in data) {
        jumlahPensiun.push(data[index]);
      }
      $scope.data = jumlahPensiun;
    });
  };
});
