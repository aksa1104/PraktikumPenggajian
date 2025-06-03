<?php
include "database/connection.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama_karyawan = mysqli_real_escape_string($connection, $_POST['nama_karyawan']);
  $tanggal = mysqli_real_escape_string($connection, $_POST['tanggal']);
  $alasan = mysqli_real_escape_string($connection, $_POST['alasan']);
  $query = "INSERT INTO pemecatan (nama_karyawan, tanggal, alasan) VALUES ('$nama_karyawan', '$tanggal', '$alasan')";
  if (mysqli_query($connection, $query)) {
    echo '<div class="alert alert-success">Data pemecatan berhasil ditambah.</div>';
  } else {
    echo '<div class="alert alert-danger">Gagal menambah data: ' . mysqli_error($connection) . '</div>';
  }
}
?>
<div class="row mb-3">
  <div class="col">
    <h3>Tambah Pemecatan</h3>
  </div>
</div>
<form method="post">
  <div class="mb-3">
    <label class="form-label">Nama Karyawan</label>
    <input type="text" name="nama_karyawan" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Tanggal</label>
    <input type="date" name="tanggal" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Alasan</label>
    <textarea name="alasan" class="form-control" required></textarea>
  </div>
  <button type="submit" class="btn btn-success">Simpan</button>
  <a href="?page=pemecatan" class="btn btn-secondary">Kembali</a>
</form>
