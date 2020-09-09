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

$dateNow = date("Y-m-d");
// var_dump($dateNow);

$sql = "SELECT * FROM tb_pegawai
WHERE tgl_pensiun='" . $dateNow . "'";
// echo $dateNow;
if ($result = $conn->query($sql)) {
  while ($obj = $result->fetch_object()) {
    echo $obj->tgl_pensiun;
    $sql = "UPDATE tb_user SET status ='2' WHERE id_user='" . $obj->id_pegawai . "'";
    if ($conn->query($sql)) {
      echo 'berhasil';
    } else {
      die("Connection failed: " . mysqli_connect_error());
    }
  }
}

mysqli_close($conn);