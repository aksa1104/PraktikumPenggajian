<?php
$dashboard_active = "fw-bold";
$bagian_active = "fw-bold";
$karyawan_active = "fw-bold";
$penggajian_active = "fw-bold";
$laporan_active = "fw-bold";

$page = isset($_GET["page"]) ? $_GET["page"] : "";

switch ($page) {
        case "":
        case "dashboard":
                $dashboard_active = "active";
                break;
        case "bagian":
        case "bagiantambah":
        case "bagianhapus":
                $bagian_active = "active";
                break;
        case "karyawan":
        case "karyawantambah":
        case "karyawanhapus":
                $karyawan_active = "active";
                break;
        case "pilihbulantahunpenggajian":
        case "penggajian":
        case "penggajiantambah":
        case "pilihkaryawanpenggajian":
        case "penggajianhapus":
                $penggajian_active = "active";
                break;
        case "laporan":
        case "laporantambah":
        case "laporanhapus":
        case "laporanubah":
                $laporan_active = "active";
                break;
        default:
                $dashboard_active = "active";
}
?>

<div class="bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i class="fas fa-money-bill me-2"></i>Penggajian
        </div>
        <div class="list-group list-group-flush my-3">
                <a href="?page=dashboard" class="list-group-item list-group-item-action bg-transparent second-text <?php echo $dashboard_active; ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="?page=bagian" class="list-group-item list-group-item-action bg-transparent second-text <?php echo $bagian_active; ?>"><i class="fas fa-building me-2"></i>Bagian</a>
                <a href="?page=karyawan" class="list-group-item list-group-item-action bg-transparent second-text <?php echo $karyawan_active; ?>"><i class="fas fa-users me-2"></i>Karyawan</a>
                <a href="?page=pilihbulantahunpenggajian" class="list-group-item list-group-item-action bg-transparent second-text <?php echo $penggajian_active; ?>"><i class="fas fa-money-bill me-2"></i>Penggajian</a>
                <a href="?page=laporan" class="list-group-item list-group-item-action bg-transparent second-text <?php echo $laporan_active; ?>"><i class="fas fa-file-alt me-2"></i>Laporan</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
        </div>
</div>
