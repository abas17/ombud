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
$sqlDurasi = "AND durasi=durasi";
$status = "any";
if (isset($_POST['btnCari'])) {
    $status = $_POST['durasi'];
    if ($_POST['durasi'] == 'any') $sqlDurasi = "AND durasi=durasi";
    if ($_POST['durasi'] == 'Proses') $sqlDurasi = "AND durasi='Proses'";
    if ($_POST['durasi'] == 'Berhenti') $sqlDurasi = "AND durasi='Berhenti'";
    if ($_POST['durasi'] == 'Selesai') $sqlDurasi = "AND durasi='Selesai'";
}

?>
<div class="pt-3 pb-2" id="breadcrumbs-wrapper">
    <div class="col s12 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Laporan Selesai</span></h5>
    </div>
</div>
<!-- users list start -->
<section class="users-list-wrapper section">
    <div class="users-list-filter">
        <div class="card-panel">
            <div class="row">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
                    <div class="col s12 m6">
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
                    <div class="col s12 m3 display-flex align-items-center show-btn right">
                        <a href="pages/cetak/cetak_laporan_selesai.php?status=<?php echo $status ?>" target="blank" class="btn btn-block waves-effect waves-light border-round z-depth-4">
                            <i class="material-icons">picture_as_pdf</i>
                            <span class="hide-on-small-only">Export to PDF</span>
                        </a>
                    </div>
                    <div class="col s12 m3 display-flex align-items-center show-btn right">
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
                                <th>No Agenda</th>
                                <th>No Arsip</th>
                                <th>Durasi</th>
                                <th>Pelapor</th>
                                <th>Terlapor</th>
                                <th>Substansi</th>
                                <th>Perihal</th>
                                <th>Status Rahasia</th>
                                <th>Tanggal Penutupan Laporan</th>
                                <th>Pendapat Ditutup</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $database = new Database();
                            $db = $database->getConnection();
                            $selectSql = "SELECT * FROM registrasi_lap_masyarakat r 
                                JOIN pelapor p ON r.id_reg=p.id_pel
                                JOIN terlapor t ON p.id_pel=t.id_ter
                                JOIN substansi s ON r.substansi=s.id_sub where kewenangan_ombudsman='Kewenangan Ombudsman' $sqlDurasi ORDER BY id_reg desc";
                            $stmt = $db->prepare($selectSql);
                            $stmt->execute();
                            $no = 1;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['no_agenda'] ?></td>
                                    <td><?php echo $row['no_arsip'] ?></td>
                                    <td><?php echo $row['durasi'] ?></td>
                                    <td><?php echo $row['nama_pelapor'] ?></td>
                                    <td><?php echo $row['nama_terlapor'] ?></td>
                                    <td><?php echo $row['nama_sub'] ?></td>
                                    <td><?php echo $row['perihal'] ?></td>
                                    <td><?php echo $row['identitas_pelapor_rahasia'] ?></td>
                                    <td><?php echo tgl_indo($row['tanggal_penutupan']) ?></td>
                                    <td><?php echo $row['pilihan_pendapat_tutup'] ?></td>
                                    <td>
                                        <a href="?page=laporan-selesai-edit&id=<?php echo $row['id_reg'] ?>"><i class="material-icons">edit</i></a>
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