<?php
include "database/connection.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $judul = mysqli_real_escape_string($connection, $_POST['judul']);
  $tanggal = mysqli_real_escape_string($connection, $_POST['tanggal']);
  $query = "INSERT INTO laporan (judul, tanggal) VALUES ('$judul', '$tanggal')";
  if (mysqli_query($connection, $query)) {
    echo '<div class="alert alert-success">Laporan berhasil ditambah.</div>';
  } else {
    echo '<div class="alert alert-danger">Gagal menambah laporan: ' . mysqli_error($connection) . '</div>';
  }
}
?>
<div class="row mb-3">
  <div class="col">
    <h3>Tambah Laporan</h3>
  </div>
</div>
<form method="post">
  <div class="mb-3">
    <label class="form-label">Judul</label>
    <input type="text" name="judul" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Tanggal</label>
    <input type="date" name="tanggal" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-success">Simpan</button>
  <a href="?page=laporan" class="btn btn-secondary">Kembali</a>
</form>
