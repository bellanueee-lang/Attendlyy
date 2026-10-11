<?php
mysqli_report(MYSQLI_REPORT_OFF);

$koneksi = mysqli_init();
mysqli_options($koneksi, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

if (!mysqli_real_connect(
    $koneksi,
    "127.0.0.1",
    "root",
    "",
    "attendly",
    3306
)) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>