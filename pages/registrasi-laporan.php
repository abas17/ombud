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
$sqlPeriode = " WHERE tgl_agenda=tgl_agenda";
$awalTgl    = "";
$akhirTgl   = "";
$tglAwal    = date('Y-m') . "-01";
$tglAkhir   = date('Y-m-d');

$sqlDurasi = "AND durasi=durasi";
$status = "any";

$sqlTipeLap = "AND tipe_laporan=tipe_laporan";
$tipelap = "any";

$sqlCapeny = "AND cara_penyampaian=cara_penyampaian";
$capeny = "any";
if (isset($_POST['btnCari'])) {
    $status = $_POST['durasi'];
    if ($_POST['durasi'] == 'any') $sqlDurasi = "AND durasi=durasi";
    if ($_POST['durasi'] == 'Proses') $sqlDurasi = "AND durasi='Proses'";
    if ($_POST['durasi'] == 'Berhenti') $sqlDurasi = "AND durasi='Berhenti'";
    if ($_POST['durasi'] == 'Selesai') $sqlDurasi = "AND durasi='Selesai'";

    $tipelap = $_POST['tipe_laporan'];
    if ($_POST['tipe_laporan'] == 'any') {
        $sqlTipeLap = "AND tipe_laporan=tipe_laporan";
    } else {
        $sqlTipeLap = "AND tipe_laporan='$tipelap'";
    };

    $capeny = $_POST['cara_penyampaian'];
    if ($_POST['cara_penyampaian'] == 'any') {
        $sqlCapeny = "AND cara_penyampaian=cara_penyampaian";
    } else {
        $sqlCapeny = "AND cara_penyampaian='$capeny'";
    };
}

if (isset($_POST['btnTampil'])) {
    $tglAwal    = isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "01-" . date('m-Y');
    $tglAkhir   = isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : date('d-m-Y');
    $sqlPeriode = " where tgl_agenda BETWEEN '" . $tglAwal . "' AND '" . $tglAkhir . "' ";
} else {
    $awalTgl    = "01-" . date('m-Y');
    $akhirTgl   = date('d-m-Y');
}
?>
<div class="pt-3 pb-2" id="breadcrumbs-wrapper">
    <div class="col s12 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Registrasi Laporan</span></h5>
    </div>
</div>
<!-- users list start -->
<section class="users-list-wrapper section">
    <div class="users-list-filter">
        <div class="card-panel">
            <div class="row">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
                    <h7>Periode Tanggal <b><?php echo tgl_indo($tglAwal) ?></b> s/d <b><?php echo tgl_indo($tglAkhir) ?></b></h7>
                    <div class="row">
                        <div class="col s12 m3">
                            <input name="txtTglAwal" required type="date" class="form-control" value="<?php echo $awalTgl ?>">
                        </div>
                        <div class="col s12 m3">
                            <input name="txtTglAkhir" required type="date" class="form-control" value="<?php echo $akhirTgl ?>">
                        </div>
                        <div class="col s12 m3">
                            <button type="submit" name="btnTampil" class="btn btn-block indigo waves-effect waves-light z-depth-4">Cari Dari Tanggal</button>
                        </div>
                        <div class="col s12 m3">
                            <a href="pages/cetak/cetak_registrasi_laporan_tgl.php?awal=<?php echo $tglAwal ?>&&akhir=<?php echo $tglAkhir ?>" target="blank" class="btn btn-block waves-effect waves-light border-round z-depth-4">
                                <i class="material-icons">picture_as_pdf</i>
                                <span class="hide-on-small-only">Cetak Tanggal</span>
                            </a>
                        </div>
                    </div>

                </form>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form2" target="_self">
                    <div class="row">
                        <div class="col s12 m3">
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
                        <div class="col s12 m3">
                            <label for="users-list-status">Tipe Laporan</label>
                            <div class="input-field">
                                <select class="form-control" id="tipe_laporan" name="tipe_laporan">
                                    <option value="any" selected>Any</option>
                                    <option value='Laporan Masyarakat'>Laporan Masyarakat</option>
                                    <option value='Respon Cepat'>Respon Cepat</option>
                                    <option value='Konsultasi Non Laporan'>Konsultasi Non Laporan</option>
                                    <option value='Tembusan'>Tembusan</option>
                                    <option value='Investigasi atas Prakarsa Sendiri'>Investigasi atas Prakarsa Sendiri</option>
                                </select>
                            </div>
                        </div>
                        <div class="col s12 m3 ">
                            <label for="users-list-status">Cara Penyampaian</label>
                            <div class="input-field">
                                <select class="form-control" id="cara_penyampaian" name="cara_penyampaian">
                                    <option value="any" selected>Any</option>
                                    <?php
                                    $database = new Database();
                                    $db = $database->getConnection();
                                    $selectSql = "SELECT * FROM cara_penyampaian ORDER BY id_cara_penyampaian";
                                    $stmt_cara_penyampaian = $db->prepare($selectSql);
                                    $stmt_cara_penyampaian->execute();

                                    while ($row_cara_penyampaian = $stmt_cara_penyampaian->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='" . $row_cara_penyampaian["penyampaian"] . "'>" . $row_cara_penyampaian["penyampaian"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col s12 m3 pt-5">
                            <button type="submit" name="btnCari" class="btn btn-block indigo waves-effect waves-light z-depth-4">Cari</button>
                        </div>
                    </div>

                    <div class="col s12 m3 pt-2 ">
                        <a href="?page=registrasi-laporan-create" class="btn gradient-45deg-cyan-light-green btn-block waves-effect waves-light border-round z-depth-4">
                            <i class="material-icons">add</i>
                            <span class="hide-on-small-only">Tambah</span>
                        </a>
                    </div>
                    <div class="col s12 m3 pt-2 right ">
                        <a href="pages/cetak/cetak_registrasi_laporan.php?status=<?php echo $status ?>&&tipelap=<?php echo $tipelap ?>&&capeny=<?php echo $capeny ?>" target="blank" class="btn btn-block waves-effect waves-light border-round z-depth-4">
                            <i class="material-icons">picture_as_pdf</i>
                            <span class="hide-on-small-only">Cetak Laporan</span>
                        </a>
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
                                <th>Tanggal Agenda</th>
                                <th>No Agenda</th>
                                <th>Tipe Laporan</th>
                                <th>Cara Penyampaian</th>
                                <th>Pelapor</th>
                                <th>Terlapor</th>
                                <th>Instansi Terlapor</th>
                                <th>Perihal</th>
                                <th>Kantor</th>
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
                            JOIN terlapor t ON p.id_pel=t.id_ter $sqlPeriode $sqlDurasi $sqlTipeLap $sqlCapeny ORDER BY id_reg desc";
                            $stmt = $db->prepare($selectSql);
                            $stmt->execute();
                            $no = 1;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo tgl_indo($row['tgl_agenda']) ?></td>
                                    <td><?php echo $row['no_agenda'] ?></td>
                                    <td><?php echo $row['tipe_laporan'] ?></td>
                                    <td><?php echo $row['cara_penyampaian'] ?></td>
                                    <td><?php echo $row['nama_pelapor'] ?></td>
                                    <td><?php echo $row['nama_terlapor'] ?></td>
                                    <td><?php echo $row['instansi_terlapor'] ?></td>
                                    <td><?php echo $row['perihal'] ?></td>
                                    <td>KANTOR PERWAKILAN <?php echo $row['perwakilan'] ?></td>
                                    <td><?php echo $row['durasi'] ?></td>
                                    <td>
                                        <a href="?page=registrasi-laporan-edit&id=<?php echo $row['id_reg'] ?>"><i class="material-icons">edit</i></a>
                                        <a href="?page=registrasi-laporan-view&id=<?php echo $row['id_reg'] ?>"><i class="material-icons">remove_red_eye</i></a>
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