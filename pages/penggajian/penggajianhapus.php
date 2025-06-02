<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$bulan = isset($_GET['bulan']) ? htmlspecialchars($_GET['bulan']) : '';
$tahun = isset($_GET['tahun']) ? htmlspecialchars($_GET['tahun']) : '';
?>
<div id="top" class="row">
  <div class="col">
    <h3>Hapus Data Penggajian</h3>
  </div>
  <div class="col">
    <a href="?page=penggajian&bulan=<?php echo $bulan ?>&tahun=<?php echo $tahun ?>" class="btn btn-primary float-end">
      <i class="fa fa-arrow-circle-left"></i>
      Kembali
    </a>
  </div>
</div>
<div id="content" class="row mt-3">
  <div class="col">
    <?php
    include "database/connection.php";

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM penggajian WHERE id = ?");
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    if (!$result) {
    ?>
      <div class="alert alert-danger" role="alert">
        <i class="fa fa-exclamation-circle"></i>
        <?php echo $stmt->error ?>
      </div>
    <?php
    } else {
    ?>
      <div class="alert alert-success" role="alert">
        <i class="fa fa-check-circle"></i>
        Hapus data berhasil
      </div>
      <meta http-equiv="refresh" content="2;url=?page=penggajian&bulan=<?= $bulan ?>&tahun=<?= $tahun ?>">
    <?php
    }
    $stmt->close();
    ?>
  </div>
</div>
