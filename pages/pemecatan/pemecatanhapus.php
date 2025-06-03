<?php
include "database/connection.php";
if (!isset($_GET['id'])) {
  echo '<div class="alert alert-danger">ID pemecatan tidak ditemukan.</div>';
  return;
}
$id = intval($_GET['id']);
if (isset($_POST['hapus'])) {
  $query = "DELETE FROM pemecatan WHERE id=$id";
  if (mysqli_query($connection, $query)) {
    echo '<div class="alert alert-success">Data pemecatan berhasil dihapus.</div>';
  } else {
    echo '<div class="alert alert-danger">Gagal menghapus data: ' . mysqli_error($connection) . '</div>';
  }
  echo '<a href="?page=pemecatan" class="btn btn-secondary mt-2">Kembali</a>';
  return;
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
    <h3>Hapus Pemecatan</h3>
    <div class="alert alert-warning">Yakin ingin menghapus data pemecatan <b><?= htmlspecialchars($row['nama_karyawan']) ?></b> tanggal <b><?= htmlspecialchars($row['tanggal']) ?></b>?</div>
    <form method="post">
      <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
      <a href="?page=pemecatan" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>
