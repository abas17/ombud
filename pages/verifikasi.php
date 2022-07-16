<?php
if (isset($_SESSION['hasil'])) {
    if ($_SESSION['hasil']) {
?>
        <div class="card-alert card gradient-45deg-green-teal">
            <div class="card-content white-text">
                <p>
                    <i class="material-icons">check</i> <?php echo $_SESSION['pesan'] ?>
                </p>
            </div>
            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    <?php
    } else {
    ?>
        <div class="card-alert card gradient-45deg-red-pink">
            <div class="card-content white-text">
                <p>
                    <i class="material-icons">error</i> <?php echo $_SESSION['pesan'] ?>
                </p>
            </div>
            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
<?php
    }
    unset($_SESSION['hasil']);
    unset($_SESSION['pesan']);
}
?>
<?php
$sqlDurasi = "WHERE durasi=durasi";
$status = "any";
$sqlVerifikasi = "AND verifikasi=verifikasi";
$verifikasi = "any";
if (isset($_POST['btnCari'])) {
    $status = $_POST['durasi'];
    if ($_POST['durasi'] == 'any') $sqlDurasi = "WHERE durasi=durasi";
    if ($_POST['durasi'] == 'Proses') $sqlDurasi = "WHERE durasi='Proses'";
    if ($_POST['durasi'] == 'Berhenti') $sqlDurasi = "WHERE durasi='Berhenti'";
    if ($_POST['durasi'] == 'Selesai') $sqlDurasi = "AND durasi='Selesai'";

    $verifikasi = $_POST['verifikasi'];
    if ($_POST['verifikasi'] == 'any') $sqlVerifikasi = "AND verifikasi=verifikasi";
    if ($_POST['verifikasi'] == 'Belum Lengkap') $sqlVerifikasi = "AND verifikasi='Belum Lengkap'";
    if ($_POST['verifikasi'] == 'Memenuhi Syarat') $sqlVerifikasi = "AND verifikasi='Memenuhi Syarat'";
    if ($_POST['verifikasi'] == 'Berhenti') $sqlVerifikasi = "AND verifikasi='Berhenti'";
    if ($_POST['verifikasi'] == 'Tidak Memenuhi Syarat dan Tidak Lengkap') $sqlVerifikasi = "AND verifikasi='Tidak Memenuhi Syarat dan Tidak Lengkap'";
}

?>
<div class="pt-3 pb-2" id="breadcrumbs-wrapper">
    <div class="col s12 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Verifikasi</span></h5>
    </div>
</div>
<!-- users list start -->
<section class="users-list-wrapper section">
    <div class="users-list-filter">
        <div class="card-panel">
            <div class="row">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
                    <div class="col s12 m6 l3">
                        <label for="users-list-status">Status</label>
                        <div class="input-field">
                            <select class="form-control" id="durasi" name="durasi">
                                <option value="any" selected>Any</option>
                                <option value="Proses">Proses</option>
                                <option value="Berhenti">Berhenti</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <label for="users-list-status">Status Verifikasi</label>
                        <div class="input-field">
                            <select class="form-control" id="verifikasi" name="verifikasi">
                                <option value="any" selected>Any</option>
                                <option value="Belum Lengkap">Belum Lengkap</option>
                                <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                <option value="Berhenti">Berhenti</option>
                                <option value="Tidak Memenuhi Syarat dan Tidak Lengkap">Tidak Memenuhi Syarat dan Tidak Lengkap</option>
                            </select>
                        </div>
                    </div>
                    <div class="col s12 m6 l3 display-flex align-items-center show-btn right">
                        <a href="pages/cetak/cetak_verifikasi.php?status=<?php echo $status ?>&&verifikasi=<?php echo $verifikasi ?>" target="blank" class="btn btn-block waves-effect waves-light border-round z-depth-4">
                            <i class="material-icons">picture_as_pdf</i>
                            <span class="hide-on-small-only">Export to PDF</span>
                        </a>
                    </div>
                    <div class="col s12 m6 l3 display-flex align-items-center show-btn right">
                        <button type="submit" name="btnCari" class="btn btn-block indigo waves-effect waves-light z-depth-4">Show</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="users-list-datatable" class="table" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Tipe Laporan</th>
                                <th>No Agenda</th>
                                <th>Tanggal Agenda</th>
                                <th>Pelapor</th>
                                <th>Terlapor</th>
                                <th>Kantor</th>
                                <th>Status</th>
                                <th>Durasi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $database = new Database();
                            $db = $database->getConnection();
                            $selectSql = "SELECT * FROM registrasi_lap_masyarakat r 
                                JOIN pelapor p ON r.id_reg=p.id_pel
                                JOIN terlapor t ON p.id_pel=t.id_ter $sqlDurasi $sqlVerifikasi ORDER BY id_reg desc";
                            $stmt = $db->prepare($selectSql);
                            $stmt->execute();
                            $no = 1;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['tipe_laporan'] ?></td>
                                    <td><?php echo $row['no_agenda'] ?></td>
                                    <td><?php echo tgl_indo($row['tgl_agenda']) ?></td>
                                    <td><?php echo $row['nama_pelapor'] ?></td>
                                    <td><?php echo $row['nama_terlapor'] ?></td>
                                    <td>KANTOR PERWAKILAN <?php echo $row['perwakilan'] ?></td>
                                    <td><?php echo $row['verifikasi'] ?></td>
                                    <td><?php echo $row['durasi'] ?></td>
                                    <td>
                                        <a href="?page=verifikasi-edit&id=<?php echo $row['id_reg'] ?>"><i class="material-icons">edit</i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
        </div>
    </div>
</section>
<!-- users list ends -->

<?php include 'partials/scripts.php'; ?>