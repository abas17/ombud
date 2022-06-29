    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="pt-3 pb-1" id="breadcrumbs-wrapper">
            </div>
            <div class="col s12">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Registrasi Laporan Masuk</span></h5>
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

                                $selectSql = "SELECT * FROM Prov";
                                $stmt = $db->prepare($selectSql);
                                $stmt->execute();

                                $no = 1;
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $row['nama_prov'] ?></td>
                                        <td>12312312</td>
                                        <td>Laporan masyarakat</td>
                                        <td>Ryan</td>
                                        <td>PDAM</td>
                                        <td>BUMN</td>
                                        <td>tidak memberikan pelayanan</td>
                                        <td>ombudsman kalsel</td>
                                        <td>2</td>
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
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>
    <!-- END: Page Main-->




    <?php include 'partials/scripts.php'; ?>