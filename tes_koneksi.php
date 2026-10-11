<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "attendly", 3306);

if ($conn) {
    echo "KONEKSI BERHASIL";
} else {
    echo "KONEKSI GAGAL: " . mysqli_connect_error();
}
