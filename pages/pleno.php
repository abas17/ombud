<!-- BEGIN: Page Main-->
<div id="main">
    <div class="row">
        <div class="pt-3 pb-1" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Pleno</span></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <!-- users list start -->
                <section class="users-list-wrapper section">
                    <div class="users-list-filter">
                        <div class="card-panel">
                            <div class="row">
                                <form>
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-verified">Verified</label>
                                        <div class="input-field">
                                            <select class="form-control" id="users-list-verified">
                                                <option value="">Any</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-role">Role</label>
                                        <div class="input-field">
                                            <select class="form-control" id="users-list-role">
                                                <option value="">Any</option>
                                                <option value="User">User</option>
                                                <option value="Staff">Staff</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-status">Status</label>
                                        <div class="input-field">
                                            <select class="form-control" id="users-list-status">
                                                <option value="">Any</option>
                                                <option value="Active">Active</option>
                                                <option value="Close">Close</option>
                                                <option value="Banned">Banned</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3 display-flex align-items-center show-btn">
                                        <button type="submit" class="btn btn-block indigo waves-effect waves-light">Show</button>
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
                                                <th>Nomor Agenda</th>
                                                <th>Tanggal Agenda</th>
                                                <th>Pelapor</th>
                                                <th>Terlapor</th>
                                                <th>Perihal</th>
                                                <th>Klasifikasi Laporan</th>
                                                <th>Menolak/Lanjutkan</th>
                                                <th>Alasan</th>
                                                <th>Durasi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>1</td>
                                                <td>12312312</td>
                                                <td>30/04/2019</td>
                                                <td>Dimas</td>
                                                <td>PDAM</td>
                                                <td>Dugaan tidak memberikan pelayanan oleh PDAM </td>
                                                <td>Laporan Sederhana</td>
                                                <td>Kantor Perwakilan Kalimantan Selatan</td>
                                                <td>Terlapor berada di wilayah Kalimantan Selatan</td>
                                                <td>Berhenti</td>
                                                <td><a href="page-users-edit.html"><i class="material-icons">edit</i></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>1</td>
                                                <td>12312312</td>
                                                <td>30/04/2019</td>
                                                <td>Dimas</td>
                                                <td>PDAM</td>
                                                <td>Dugaan tidak memberikan pelayanan oleh PDAM </td>
                                                <td>Laporan Sederhana</td>
                                                <td>Ditolak</td>
                                                <td>Subtansi laporan yang dilaporkan dalam proses pengadilan</td>
                                                <td>Berhenti</td>
                                                <td><a href="page-users-edit.html"><i class="material-icons">edit</i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- datatable ends -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users list ends -->

                <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i class="material-icons">add</i></a>
                    <ul>
                        <li><a href="css-helpers.html" class="btn-floating blue"><i class="material-icons">help_outline</i></a></li>
                        <li><a href="cards-extended.html" class="btn-floating green"><i class="material-icons">widgets</i></a></li>
                        <li><a href="app-calendar.html" class="btn-floating amber"><i class="material-icons">today</i></a></li>
                        <li><a href="app-email.html" class="btn-floating red"><i class="material-icons">mail_outline</i></a></li>
                    </ul>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
</div>
<!-- END: Page Main-->

<?php include 'partials/scripts.php'; ?>