$scope.updatePegawai = function () {
  if ($scope.role == 2) {
    $scope.nipformatcheck = true;
  }
  if ($scope.nipformatcheck == true) {
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
            $scope.getDetail($scope.id_pegawai);
          } else {
            $scope.error = true;
            $scope.errorMessage = data.data.errortext;
            alert("Gagal Menyimpan Data");
          }
        },
        function errorCallback(response) {
          $scope.error = true;
          $scope.errorMessage = "Gagal Mengubah Data";
          alert("Gagal Mengubah Data");
          console.log(response);
        }
      );
  } else {
    alert("Gagal Mengubah Data");
    $scope.error = true;
    $scope.errorMessage = "Format NIP Salah";
  }
};
