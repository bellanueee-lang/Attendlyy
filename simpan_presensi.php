<?php

include "koneksi.php";

$kode = $_POST['nisn'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

$sql = "INSERT INTO presensi (nisn, nama, kelas, waktu)
        VALUES ('$nisn', '$nama', '$kelas', NOW())";

if (mysqli_query($koneksi, $sql)) {
    echo "Presensi berhasil disimpan";
} else {
    echo "Gagal menyimpan presensi: " . mysqli_error($koneksi);
}

?>