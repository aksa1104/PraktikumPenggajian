<div id="top" class="row mb-3">
  <div class="col">
    <h3>Tambah Data Penggajian</h3>
  </div>
  <div class="col">
    <a href="page/kelihkaryawanpenggajian" class="btn btn-primary float-end">
      <i class="fa fa-arrow-circle-left"></i>
      Kembali
    </a>
  </div>
</div>

<div id="pesan" class="row mb-3">
  <div class="col">
    <?php
    include "database/connection.php";

    if (isset($_POST['simpan_button'])) {
      $karyawan_nik = $_POST['karyawan_nik'];
      $bulan_select = $_POST['bulan_select'];
      $tahun = $_POST['tahun'];
      $gaji_pokok = $_POST['gaji_pokok'];

      // Use prepared statement for checking existing data
      $checksql = "SELECT * FROM penggajian WHERE karyawan_nik = ? AND bulan = ? AND tahun = ?";
      $stmt = mysqli_prepare($connection, $checksql);
      mysqli_stmt_bind_param($stmt, "sss", $karyawan_nik, $bulan_select, $tahun);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if (mysqli_num_rows($result) > 0) {
    ?>
        <div class="alert alert-danger" role="alert">
          <i class="fas fa-exclamation-circle"></i>
          Data gaji untuk bulan <?= htmlspecialchars($bulan_select) ?> tahun <?= htmlspecialchars($tahun) ?> sudah ada
        </div>
        <?php
      } else {
        // Use prepared statement for insert
        $sql = "INSERT INTO penggajian (karyawan_nik, bulan, tahun, gaji_pokok) VALUES (?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt_insert, "ssss", $karyawan_nik, $bulan_select, $tahun, $gaji_pokok);
        $insert = mysqli_stmt_execute($stmt_insert);
        if (!$insert) {
        ?>
          <div class="alert alert-danger" role="alert">
            <i class="fas fa-times-circle"></i>
            <?php echo mysqli_error($connection) ?>
          </div>
        <?php
        } else {
        ?>
          <div class="alert alert-success" role="alert">
            <i class="fas fa-check-circle"></i>
            Data berhasil disimpan
          </div>
    <?php
        }
      }
    }
    // Ambil data karyawan setelah proses simpan atau jika halaman dibuka
    $nik = isset($_GET['nik']) ? $_GET['nik'] : '';
    // Use prepared statement for selecting karyawan
    $sql = "SELECT * FROM karyawan WHERE nik = ?";
    $stmt_karyawan = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt_karyawan, "s", $nik);
    mysqli_stmt_execute($stmt_karyawan);
    $result = mysqli_stmt_get_result($stmt_karyawan);
    if (mysqli_num_rows($result) == 0) {
      echo "<meta http-equiv='refresh' content='0;url=?page=nilai&karyawan=penggajian'>";
      exit;
    }
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt_karyawan);
    ?>
  </div>
</div>
<div id="inputan" class="row mb-3">
  <div class="col">
    <div class="card px-3">
      <div class="row">
        <div class="col-md-6 mb-3 mt-3">
          <label for="karyawan_nik" class="form-label">NIK</label>
          <input type="text" class="form-control" value="<?php echo $row['nik'] ?>" readonly>
        </div>
        <div class="col-md-6 mb-3 mt-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" value="<?php echo $row['nama'] ?>" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="tanggal_mulai" class="form-label">Tanggal Mulai Bekerja</label>
          <input type="text" class="form-control" value="<?php echo $row['tanggal_mulai'] ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
          <input type="text" class="form-control" value="<?php echo $row['gaji_pokok'] ?>" readonly>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="status_karyawan" class="form-label">Status Karyawan</label>
          <input type="text" class="form-control" value="<?php echo $row["status_karyawan"] ?> " readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="bagian_id" class="form-label">Bagian</label>
          <?php
          $selectSQL = "SELECT * FROM bagian WHERE id = " . $row["bagian_id"];
          $result_bagian = mysqli_query($connection, $selectSQL);
          if (!$result_bagian) {
          ?>
            <div class="alert alert-danger" role="alert">
              <?php echo mysqli_error($connection) ?>
            </div>
          <?php
            return;
          }
          if (mysqli_num_rows($result_bagian) == 0) {
          ?>
            <div class="alert alert-light" role="alert">
              Data kosong
            </div>
          <?php
            return;
          }
          $row_bagian = mysqli_fetch_assoc($result_bagian);
          ?>
          <input type="text" class="form-control" value="<?php echo $row_bagian["nama"] ?>" readonly>
          <?php
          ?>
        </div>
      </div>
    </div>
    <div class="card px-3 mt-3">
      <form action="" method="post">
        <input type="hidden" name="karyawan_nik" value="<?= $row["nik"] ?>">
        <input type="hidden" name="gaji_pokok" value="<?= $row["gaji_pokok"] ?>">
        <div class="mb-3 mt-3">
          <label for="bulan_select" class="form-Label">Bulan</label>
          <select class="form-select" aria-label="Default select example" name="bulan_select">
            <option value="" selected>--- Pilih Bulan ---</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="tahun" class="form-label">Tahun</label>
          <input type="text" class="form-control" id="tahun" name="tahun" required maxlength="4">
        </div>
        <div class="col mb-3">
          <button class="btn-success" type="submit" name="simpan_button">
            <i class="fas fa-save"></i>
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
