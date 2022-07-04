<div class="pt-3 pb-0" id="breadcrumbs-wrapper">
    <div class="col s12 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Verifikasi</span></h5>
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
                <tr>
                    <td></td>
                    <td></td>
                    <td>1</td>
                    <td>Laporan masyarakat</td>
                    <td>010136.2022</td>
                    <td>27 Mei 2022</td>
                    <td>ayu</td>
                    <td>Ketua Pengadlan Agama Pelaihri</td>
                    <td>Kantor Perwakilan Kalimantan Selatan</td>
                    <td>Registrasi</td>
                    <td>31 hari</td>
                    <td>
                        <a href=""><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>1</td>
                    <td>Laporan masyarakat</td>
                    <td>010136.2022</td>
                    <td>27 Mei 2022</td>
                    <td>ayu</td>
                    <td>Ketua Pengadlan Agama Pelaihri</td>
                    <td>Kantor Perwakilan Kalimantan Selatan</td>
                    <td>Registrasi</td>
                    <td>31 hari</td>
                    <td>
                        <a href=""><i class="material-icons">edit</i></a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</section>


<?php include 'partials/scripts.php'; ?>