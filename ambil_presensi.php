<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'koneksi.php';

// Ambil seluruh data presensi terbaru
$sql = "SELECT id, nisn, nama, kelas, waktu
        FROM presensi
        ORDER BY id DESC";

$result = mysqli_query($koneksi, $sql);

if (!$result) {
    http_response_code(500);
    echo json_encode([
        "error" => "Gagal mengambil data presensi"
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $waktu = strtotime($row['waktu']);

    $data[] = [
        "id"    => (string) $row['id'],
        "nisn"  => (string) $row['nisn'],
        "nama"  => (string) $row['nama'],
        "kelas" => (string) $row['kelas'],
        "waktu" => $waktu !== false
            ? date("H:i:s Y-m-d", $waktu)
            : (string) $row['waktu']
    ];
}

echo json_encode(
    $data,
    JSON_UNESCAPED_UNICODE
);

mysqli_free_result($result);
?>