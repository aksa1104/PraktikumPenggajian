<?php
include "database/connection.php";
?>
<div class="row mb-3">
  <div class="col">
    <h3>Laporan</h3>
  </div>
  <div class="col">
    <a href="?page=laporantambah" class="btn btn-success float-end">
      <i class="fa fa-plus-circle"></i> Tambah
    </a>
  </div>
</div>
<div class="row mt-3">
  <div class="col">
    <?php
    $result = mysqli_query($connection, "SELECT * FROM laporan");
    if (!$result) {
      echo '<div class="alert alert-danger">' . mysqli_error($connection) . '</div>';
      return;
    }
    if (mysqli_num_rows($result) == 0) {
      echo '<div class="alert alert-light">Data Kosong</div>';
      return;
    }
    ?>
    <table class="table bg-white rounded shadow-sm table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Tanggal</th>
          <th width="200">Opsi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1;
        while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr class="align-middle">
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['judul']) ?></td>
            <td><?= htmlspecialchars($row['tanggal']) ?></td>
            <td>
              <a href="?page=laporanubah&id=<?= $row['id'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Ubah</a>
              <a href="?page=laporanhapus&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i> Hapus</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
