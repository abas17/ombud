<div class="pt-3 pb-0" id="breadcrumbs-wrapper">
    <div class="col s12 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Terlapor</span></h5>
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
                    <th>No Arsip</th>
                    <th>Nama Terlapor</th>
                    <th>Kelompok Instansi Terlapor</th>
                    <th>Instansi Terlapor</th>
                    <th>Alamat Terlapor</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $database = new Database();
                $db = $database->getConnection();
                $selectSql = "SELECT r.id_reg, r.no_arsip,t.nama_terlapor,t.kelompok_klasifikasi_instansi,t.instansi_terlapor,t.alamat_terlapor, kki.pilih_kel 
FROM registrasi_lap_masyarakat r JOIN terlapor t ON r.id_reg=t.id_ter
JOIN kelompok_klasifikasi_instansi kki ON t.kelompok_klasifikasi_instansi = kki.id_kel ORDER BY id_reg desc";
                $stmt = $db->prepare($selectSql);
                $stmt->execute();
                $no = 1;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['no_arsip'] ?></td>
                        <td><?php echo $row['nama_terlapor'] ?></td>
                        <td><?php echo $row['pilih_kel'] ?></td>
                        <td><?php echo $row['instansi_terlapor'] ?></td>
                        <td><?php echo $row['alamat_terlapor'] ?></td>
                        <td>
                            <a href=""><i class="material-icons">edit</i></a>
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