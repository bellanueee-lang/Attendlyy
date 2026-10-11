<?php
include "koneksi.php";

$id = intval($_POST['id'] ?? 0);

if ($id <= 0) {
    echo "ID tidak valid";
    exit;
}

$stmt = mysqli_prepare(
    $koneksi,
    "DELETE FROM presensi WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    echo "Berhasil menghapus presensi";
} else {
    http_response_code(500);
    echo "Gagal menghapus presensi";
}

mysqli_stmt_close($stmt);
?>