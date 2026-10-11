<?php
session_start();
include "koneksi.php";

header('Content-Type: application/json');

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = mysqli_prepare(
    $koneksi,
    "SELECT id, username, password, nama
     FROM akun WHERE username = ?"
);

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$akun = mysqli_fetch_assoc($result);

if ($akun && hash('sha256', $password) === $akun['password']) {
    $_SESSION['akun_id'] = $akun['id'];

    echo json_encode([
        "status" => "success",
        "nama" => $akun['nama']
    ]);
} else {
    http_response_code(401);

    echo json_encode([
        "status" => "error",
        "pesan" => "Username atau password salah"
    ]);
}
?>