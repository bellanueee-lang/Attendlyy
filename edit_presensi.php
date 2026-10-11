<?php
include "koneksi.php";

header('Content-Type: text/plain; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit("Metode tidak diizinkan");
}

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$kelas = isset($_POST['kelas']) ? trim($_POST['kelas']) : '';

if ($id <= 0 || $nama === '' || $kelas === '') {
    http_response_code(400);
    exit("ID, nama, atau kelas kosong");
}

$stmt = mysqli_prepare(
    $koneksi,
    "UPDATE presensi SET nama = ?, kelas = ? WHERE id = ?"
);

if (!$stmt) {
    http_response_code(500);
    exit("Gagal menyiapkan query");
}

mysqli_stmt_bind_param($stmt, "ssi", $nama, $kelas, $id);

if (mysqli_stmt_execute($stmt)) {
    echo "Berhasil";
} else {
    http_response_code(500);
    echo "Gagal mengedit data";
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>