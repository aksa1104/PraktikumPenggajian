<?php
include "database/connection.php";
if (!isset($_GET['id'])) {
  echo '<div class="alert alert-danger">ID pemecatan tidak ditemukan.</div>';
  return;
}
$id = intval($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama_karyawan = mysqli_real_escape_string($connection, $_POST['nama_karyawan']);
  $tanggal = mysqli_real_escape_string($connection, $_POST['tanggal']);
  $alasan = mysqli_real_escape_string($connection, $_POST['alasan']);
  $query = "UPDATE pemecatan SET nama_karyawan='$nama_karyawan', tanggal='$tanggal', alasan='$alasan' WHERE id=$id";
  if (mysqli_query($connection, $query)) {
    echo '<div class="alert alert-success">Data pemecatan berhasil diubah.</div>';
  } else {
    echo '<div class="alert alert-danger">Gagal mengubah data: ' . mysqli_error($connection) . '</div>';
  }
}
$result = mysqli_query($connection, "SELECT * FROM pemecatan WHERE id=$id");
if (!$result || mysqli_num_rows($result) == 0) {
  echo '<div class="alert alert-danger">Data pemecatan tidak ditemukan.</div>';
  return;
}
$row = mysqli_fetch_assoc($result);
?>
<div class="row mb-3">
  <div class="col">
    <h3>Ubah Pemecatan</h3>
  </div>
</div>
<form method="post">
  <div class="mb-3">
    <label class="form-label">Nama Karyawan</label>
    <input type="text" name="nama_karyawan" class="form-control" value="<?= htmlspecialchars($row['nama_karyawan']) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Tanggal</label>
    <input type="date" name="tanggal" class="form-control" value="<?= htmlspecialchars($row['tanggal']) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Alasan</label>
    <textarea name="alasan" class="form-control" required><?= htmlspecialchars($row['alasan']) ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
  <a href="?page=pemecatan" class="btn btn-secondary">Kembali</a>
</form>
