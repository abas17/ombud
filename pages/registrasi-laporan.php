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
<div class="pt-3 pb-0" id="breadcrumbs-wrapper">
    <div class="col s12 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Registrasi Laporan</span></h5>
    </div>
</div>

<!-- invoice list -->
<section class="invoice-list-wrapper section">
    <!-- create invoice button-->
    <!-- Options and filter dropdown button-->
    <div class="invoice-filter-action mr-3">
        <a href="#" class="btn waves-effect waves-light invoice-export border-round z-depth-4">
            <i class="material-icons">picture_as_pdf</i>
            <span class="hide-on-small-only">Export to PDF</span>
        </a>
    </div>
    <!-- create invoice button-->
    <div class="invoice-create-btn">
        <a href="?page=registrasi-laporan-create" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
            <i class="material-icons">add</i>
            <span class="hide-on-small-only">Tambah</span>
        </a>
    </div>
    <div class="filter-btn">
        <!-- Dropdown Trigger -->
        <a class='dropdown-trigger btn waves-effect waves-light purple darken-1 border-round' href='#' data-target='btn-filter'>
            <span class="hide-on-small-only">Filter Invoice</span>
            <i class="material-icons">keyboard_arrow_down</i>
        </a>
        <!-- Dropdown Structure -->
        <ul id='btn-filter' class='dropdown-content'>
            <li><a href="#!">Paid</a></li>
            <li><a href="#!">Unpaid</a></li>
            <li><a href="#!">Partial Payment</a></li>
        </ul>
    </div>
    <div class="responsive-table">
        <table class="invoice-data-table white border-radius-4 pt-1" width="100%">
            <thead>
                <tr>
                    <!-- data table responsive icons -->
                    <th></th>
                    <!-- data table checkbox -->
                    <th></th>
                    <th>No</th>
                    <th>Tanggal Agenda</th>
                    <th>No Agenda</th>
                    <th>Tipe Laporan</th>
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
                $selectSql = "SELECT r.id_reg,r.tgl_agenda,r.no_agenda,r.tipe_laporan,p.nama_pelapor,t.nama_terlapor,t.instansi_terlapor,r.perihal 
                FROM registrasi_lap_masyarakat r LEFT JOIN pelapor p ON r.id_reg=p.id_pel LEFT JOIN terlapor t ON p.id_pel=t.id_ter ORDER BY id_reg desc";
                $stmt = $db->prepare($selectSql);
                $stmt->execute();
                $no = 1;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo tgl_indo($row['tgl_agenda']) ?></td>
                        <td><?php echo $row['no_agenda'] ?></td>
                        <td><?php echo $row['tipe_laporan'] ?></td>
                        <td><?php echo $row['nama_pelapor'] ?></td>
                        <td><?php echo $row['nama_terlapor'] ?></td>
                        <td><?php echo $row['instansi_terlapor'] ?></td>
                        <td><?php echo $row['perihal'] ?></td>
                        <td></td>
                        <td><?php $durasi = new DateTime($row['tgl_agenda']);
                            $today = new DateTime();
                            $diff = $today->diff($durasi);
                            echo $diff->d;
                            echo " Hari";
                            ?>
                        </td>
                        <td>
                            <a href="?page=registrasi-laporan-edit&id=<?php echo $row['id_reg'] ?>"><i class="material-icons">edit</i></a>
                            <a href=""><i class="material-icons">remove_red_eye</i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'partials/scripts.php'; ?>