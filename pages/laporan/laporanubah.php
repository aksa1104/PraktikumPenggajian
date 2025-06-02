<?php
include "database/connection.php";
if (!isset($_GET['id'])) {
  echo '<div class="alert alert-danger">ID laporan tidak ditemukan.</div>';
  return;
}
$id = intval($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $judul = mysqli_real_escape_string($connection, $_POST['judul']);
  $tanggal = mysqli_real_escape_string($connection, $_POST['tanggal']);
  $query = "UPDATE laporan SET judul='$judul', tanggal='$tanggal' WHERE id=$id";
  if (mysqli_query($connection, $query)) {
    echo '<div class="alert alert-success">Laporan berhasil diubah.</div>';
  } else {
    echo '<div class="alert alert-danger">Gagal mengubah laporan: ' . mysqli_error($connection) . '</div>';
  }
}
$result = mysqli_query($connection, "SELECT * FROM laporan WHERE id=$id");
if (!$result || mysqli_num_rows($result) == 0) {
  echo '<div class="alert alert-danger">Data laporan tidak ditemukan.</div>';
  return;
}
$row = mysqli_fetch_assoc($result);
?>
<div class="row mb-3">
  <div class="col">
    <h3>Ubah Laporan</h3>
  </div>
</div>
<form method="post">
  <div class="mb-3">
    <label class="form-label">Judul</label>
    <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($row['judul']) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Tanggal</label>
    <input type="date" name="tanggal" class="form-control" value="<?= htmlspecialchars($row['tanggal']) ?>" required>
  </div>
  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
  <a href="?page=laporan" class="btn btn-secondary">Kembali</a>
</form>
