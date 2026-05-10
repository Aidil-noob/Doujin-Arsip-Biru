<?php
$koneksi = mysqli_connect("127.0.0.1","root","aidil1709","doujin_db");
if (!$koneksi) { die("Koneksi gagal"); }

$folder_utama = "data/"; // folder yang berisi semua folder doujin
$ekstensi     = ['jpg','jpeg','png','webp'];

// Scan semua folder di dalam data/
$semua_folder = scandir($folder_utama);

foreach ($semua_folder as $folder) {
  // Lewati . dan ..
  if ($folder == "." || $folder == "..") continue;

  $path = $folder_utama . $folder;

  // Pastikan itu folder, bukan file
  if (!is_dir($path)) continue;

  // Hitung jumlah halaman (file gambar saja)
  $files   = scandir($path);
  $halaman = [];
  foreach ($files as $file) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (in_array($ext, $ekstensi)) {
      $halaman[] = $file;
    }
  }
  $jumlah_halaman = count($halaman);

  // Cek apakah folder ini sudah ada di database (hindari duplikat)
  $cek = mysqli_query($koneksi, "SELECT id FROM doujin WHERE nama_folder='$folder'");
  if (mysqli_num_rows($cek) > 0) {
    echo "⏭️ Dilewati (sudah ada): $folder <br>";
    continue;
  }

  // Insert ke database
  // judul = nama folder dulu, bisa diedit nanti
  $judul  = mysqli_real_escape_string($koneksi, $folder);
  $insert = mysqli_query($koneksi, "
    INSERT INTO doujin (judul, bahasa, jumlah_halaman, nama_folder)
    VALUES ('$judul', 'indonesia', $jumlah_halaman, '$judul')
  ");

  if ($insert) {
    echo "✅ Berhasil diimport: $folder ($jumlah_halaman halaman) <br>";
  } else {
    echo "❌ Gagal: $folder <br>";
  }
}

echo "<br>✅ Selesai!";
?>