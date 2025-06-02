<div id="top" class="row mb-3">
  <div class="col">
    <h3>Penggajian</h3>
  </div>
  <div class="col">
    <a href="#" class="btn btn-success float-end">
      <i class="fa fa-plus-circle"></i>
    </a>
    Tambah
    <div class="col">
      <a href="?page=pilihbulantahunpenggajian" class="btn btn-primary float-end">
        <i class="fa fa-arrow-circle-left"></i>
        Kembali
      </a>
    </div>
  </div>
</div>
<div id="content" class="row mb-3">
  <div class="col">
    <?php
    include "database/connection.php";

    $no = 1;
    $bulan = $_GET["bulan"];
    $tahun = $_GET["tahun"];

    $select_sql = "";
    if ($bulan == "Semua") {
      if ($tahun == "Semua") {
        $select_sql = "SELECT P.*, K.nama FROM penggajian P
    LEFT JOIN karyawan K ON P.karyawan_nik = K.nik";
      } else {
        $select_sql = "SELECT P.*, K.nama FROM penggajian P
    LEFT JOIN karyawan K ON P.karyawan_nik = K.nik WHERE P.tahun = '$tahun'";
      }
    } else {
      if ($tahun == "Semua") {
        $select_sql = "SELECT P.*, K.nama FROM penggajian P
    LEFT JOIN karyawan K ON P.karyawan_nik = K.nik WHERE P.bulan = '$bulan'";
      } else {
        $select_sql = "SELECT P.*, K.nama FROM penggajian P
    LEFT JOIN karyawan K ON P.karyawan_nik = K.nik WHERE P.bulan = '$bulan' AND P.tahun = '$tahun'";
      }
    }

    echo "<pre>QUERY: $select_sql</pre>";

    $result = mysqli_query($connection, $select_sql);
    if (!$result) {
    ?>
      <div class="alert alert-danger" role="alert">
        <?php echo mysqli_error($connection); ?>
      </div>
    <?php
      return;
    }
    if (mysqli_num_rows($result) == 0) {
    ?>
      <div class="alert alert-warning" role="alert">
        Data dengan tahun <b><?php echo $tahun; ?></b> dan bulan <b><?php echo $bulan; ?></b> masih kosong.
        <a href="?page=penggajiantambah&bulan=<?php echo $bulan; ?>&tahun=<?php echo $tahun; ?>" class="btn btn-success btn-sm ms-2">
          Input Data Penggajian
        </a>
      </div>
    <?php
      return;
    }
    ?>
    <table class="table bg-white rounded shadow-sm table-hover">
      <thead>
        <tr>
          <th scope="col">NIK</th>
          <th scope="col">Nama Karyawan</th>
          <th scope="col">Bulan</th>
          <th scope="col">Tahun</th>
          <th class="text-end" scope="col">Gaji Dibayar</th>
          <th scope="col" width="200">Opsi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr class="align-middle">
            <th scope="row"><?php echo $row["karyawan_nik"] ?></th>
            <td><?php echo $row["nama"]; ?></td>
            <td><?php echo $row["bulan"]; ?></td>
            <td><?php echo $row["tahun"]; ?></td>
            <td class="text-end"><?php echo number_format($row["gaji_bayar"]) ?></td>
            <td>
              <a href="?page=editpenggajian&id=<?php echo $row["id"]; ?>" class="btn btn-warning btn-sm">
                <i class="fa fa-pencil-alt"></i>
              </a>
              <a href="?page=hapuspenggajian&id=<?php echo $row["id"] ?>&bulan=<?= $bulan ?>&tahun=<?= $tahun ?>" onclick="javascript:return confirm('Yakin ingin menghapus data ini?');" class="btn btn-danger">
                <i class="fa fa-trash"></i>
                Hapus
              </a>

            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <?php
    echo "<pre>Jumlah data: " . mysqli_num_rows($result) . "</pre>";
    ?>
  </div>
</div>
