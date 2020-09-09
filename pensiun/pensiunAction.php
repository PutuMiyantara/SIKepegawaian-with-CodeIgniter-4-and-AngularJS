<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sipeg";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// ketika ada tgl pensiun != datenow
$dateNow = date("Y-m-d");
echo $dateNow . "<br>";

$sql = "SELECT id_pegawai, tgl_pensiun FROM tb_pegawai";
if ($result = $conn->query($sql)) {
  while ($obj = $result->fetch_object()) {
    if ($dateNow > $obj->tgl_pensiun) {
      echo $obj->tgl_pensiun . 'true ' . "<br>";
      $sql = "UPDATE tb_user SET status ='2' WHERE id_user='" . $obj->id_pegawai . "'";
      if ($conn->query($sql)) {
        // echo 'berhasil';
      } else {
        die("Connection failed: " . mysqli_connect_error());
      }
    } else {
      echo $obj->tgl_pensiun . 'false ' . "<br>";
      $sql = "UPDATE tb_user SET status ='1' WHERE id_user='" . $obj->id_pegawai . "'";
      if ($conn->query($sql)) {
        // echo 'berhasil';
      } else {
        die("Connection failed: " . mysqli_connect_error());
      }
    }
  }
}

mysqli_close($conn);