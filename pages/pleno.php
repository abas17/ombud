<div class="pt-3 pb-2" id="breadcrumbs-wrapper">
    <div class="col s12 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Pleno</span></h5>
    </div>
</div>
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
                            <?php
                            $database = new Database();
                            $db = $database->getConnection();
                            $selectSql = "SELECT r.id_reg, r.no_agenda, r.tgl_agenda, p.nama_pelapor, t.nama_terlapor, r.perihal FROM registrasi_lap_masyarakat r 
                                            JOIN pelapor p ON r.id_reg=p.id_pel
                                            JOIN terlapor t ON p.id_pel=t.id_ter ORDER BY id_reg desc";
                            $stmt = $db->prepare($selectSql);
                            $stmt->execute();
                            $no = 1;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['no_agenda'] ?></td>
                                    <td><?php echo tgl_indo($row['tgl_agenda']) ?></td>
                                    <td><?php echo $row['nama_pelapor'] ?></td>
                                    <td><?php echo $row['nama_terlapor'] ?></td>
                                    <td><?php echo $row['perihal'] ?></td>
                                    <td>? Laporan Sederhana</td>
                                    <td>? Kantor Perwakilan Kalimantan Selatan</td>
                                    <td>? Terlapor berada di wilayah Kalimantan Selatan</td>
                                    <td>? Berhenti</td>
                                    <td><a href="page-users-edit.html"><i class="material-icons">edit</i></a></td>
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