<?php require_once("../controller/script.php");

// Ambil nama dari request POST
$nama = valid($conn, $_POST['nama']);

// Query untuk mengambil data penduduk berdasarkan nama
$query = "SELECT nik, jenis_kelamin, tempat_lahir, tanggal_lahir, agama, pendidikan, jenis_pekerjaan, status_perkawinan, status_hub_keluarga, kewarganegaraan, nama_ayah, nama_ibu, id_rt, id_rw, id_desa FROM penduduk WHERE nama_lengkap LIKE '%$nama%'";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
  // Ambil data dari hasil query
  $data = mysqli_fetch_assoc($result);

  // Kirim data sebagai respons JSON
  echo json_encode($data);
} else {
  // Jika data tidak ditemukan, kirim respons kosong
  echo json_encode([]);
}
