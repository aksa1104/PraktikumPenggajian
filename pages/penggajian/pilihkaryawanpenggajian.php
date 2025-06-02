<div id="top" class="row mb-3">
  <div class="col">
    <h3>Pilih Karyawan</h3>
  </div>
  <div class="col">
    <a href="javascript:history.back()" class="btn btn-primary float-end">
      <i class="fa fa-arrow-circle-left"></i>
      Kembali
    </a>
  </div>
</div>

<?php
include "database/connection.php";
if (!isset($connection) || !$connection) {
  echo '<div class="alert alert-danger" role="alert">
    Koneksi database gagal.
  </div>';
  return;
}
$no = 1;
$select_sql = "SELECT K.*, B.nama_bagian FROM karyawan K LEFT JOIN bagian B ON K.bagian_id = B.id";
$result = mysqli_query($connection, $select_sql);
if (!$result) {
  echo '<div class="alert alert-danger" role="alert">' . mysqli_error($connection) . '</div>';
  return;
}
if (mysqli_num_rows($result) == 0) {
  echo '<div class="alert alert-light" role="alert">
    Data kosong
  </div>';
  return;
}
?>

<table class="table bg-white rounded shadow-sm table-hover">
  <thead>
    <tr>
      <th scope="col">NIK</th>
      <th scope="col">Nama Karyawan</th>
      <th scope="col">Bagian</th>
      <th scope="col" class="text-end">Gaji Pokok</th>
      <th scope="col" width="200">Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
      <tr class="align-middle">
        <th scope="row"><?php echo $row['nik'] ?></th>
        <td><?php echo $row['nama'] ?></td>
        <td><?php echo $row['nama_bagian'] ?></td>
        <td class="text-end"><?php echo number_format($row['gaji_pokok']) ?></td>
        <td>
          <a href="?page=penggajiantambah&nik=<?php echo $row['nik'] ?>" class="btn btn-success">
            <i class="fa fa-arrow-circle-right"></i>
            Pilih
          </a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
