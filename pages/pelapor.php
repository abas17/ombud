    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="pt-3 pb-1" id="breadcrumbs-wrapper">
            </div>
            <div class="col s12">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Pelapor</span></h5>
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
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>1</td>
                                    <td>0170/LM/XI/2021/BJM</td>
                                    <td><span class="green-text">Tidak Rahasia</span>
                                    </td>
                                    <td>Wanda Nur</td>
                                    <td>6371016512010006</td>
                                    <td>Banjarmasin</td>
                                    <td>2021-12-25</td>
                                    <td>Jl. Tembikar kanan, komplek fadillah perdana</td>
                                    <td>0895606052361</td>
                                    <td>
                                        <a href=""><i class="material-icons">edit</i></a>
                                        <a href=""><i class="material-icons">remove_red_eye</i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>1</td>
                                    <td>0170/LM/XI/2021/BJM</td>
                                    <td><span class="red-text">Rahasia</span>
                                    </td>
                                    <td>Wanda Nur</td>
                                    <td>6371016512010006</td>
                                    <td>Banjarmasin</td>
                                    <td>2021-12-25</td>
                                    <td>Jl. Tembikar kanan, komplek fadillah perdana</td>
                                    <td>0895606052361</td>
                                    <td>
                                        <a href=""><i class="material-icons">edit</i></a>
                                        <a href=""><i class="material-icons">remove_red_eye</i></a>
                                    </td>
                                </tr>

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