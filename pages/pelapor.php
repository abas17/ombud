<div class="pt-3 pb-0" id="breadcrumbs-wrapper">
    <div class="col s12 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Pelapor</span></h5>
    </div>
</div>


<!-- invoice list -->
<section class="invoice-list-wrapper section">
    <!-- create invoice button-->
    <!-- Options and filter dropdown button-->
    <div class="invoice-filter-action mr-3">
        <a href="pages/cetak/cetak_pelapor.php" target="blank" class="btn waves-effect waves-light invoice-export border-round z-depth-4">
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
                    <th>Status Rahasia</th>
                    <th>Nama Lengkap</th>
                    <th>Nomor Identitas</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat Lengkap</th>
                    <th>Nomor Telepon</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $database = new Database();
                $db = $database->getConnection();
                $selectSql = "SELECT r.id_reg,r.no_arsip, p.identitas_pelapor_rahasia, p.nama_pelapor, p.nomor_identitas, p.tempat_lahir, p.tanggal_lahir, p.alamat_lengkap_pel, p.no_telp
                                FROM registrasi_lap_masyarakat r
                                join pelapor p ON r.id_reg=p.id_pel ORDER BY id_reg desc";
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
                        <td><?php echo $row['identitas_pelapor_rahasia'] ?></td>
                        <td><?php echo $row['nama_pelapor'] ?></td>
                        <td><?php echo $row['nomor_identitas'] ?></td>
                        <td><?php echo $row['tempat_lahir'] ?></td>
                        <td><?php echo tgl_indo($row['tanggal_lahir']) ?></td>
                        <td><?php echo $row['alamat_lengkap_pel'] ?></td>
                        <td><?php echo $row['no_telp'] ?></td>
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