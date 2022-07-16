<?php
if (isset($_GET['id']) && $_GET['id'] <> '') {
    $database = new Database();
    $db = $database->getConnection();

    $id = $_GET['id'];
    $findSql = "SELECT * FROM registrasi_lap_masyarakat r 
JOIN pelapor p ON r.id_reg=p.id_pel
JOIN terlapor t ON p.id_pel=t.id_ter
JOIN substansi s ON s.id_sub=r.substansi
JOIN klasifikasi_permasalahan k ON k.id_klasper=r.klasifikasi_permasalahan
JOIN warga_negara w on w.id_wn=p.warga_negara 
JOIN jenis_identitas j on j.id_ji=p.jenis_identitas 
JOIN provinsi prv on prv.id_prov=p.provinsi_pel 
JOIN kabupaten kab on kab.id_kab=p.kabupaten_pel
JOIN kecamatan kec on kec.id_kec=p.kecamatan_pel
JOIN kelompok_klasifikasi_instansi kel on kel.id_kel=t.kelompok_klasifikasi_instansi
JOIN klasifikasi_instansi_terlapor klas on klas.id_ins=t.klasifikasi_instansi_terlapor
where id_reg = ?";
    $stmt = $db->prepare($findSql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $row = $stmt->fetch();

    if (isset($row['id_reg'])) {
        if (isset($_POST['button_update'])) {
            $status = 'Pleno';
            if ($_POST['kewenangan_ombudsman'] == 'Kewenangan Ombudsman') {
                $durasi = 'Proses';
            } else {
                $durasi = 'Berhenti';
            }
            $petugas_pleno = $_SESSION['user']['nama'];
            $updateSql = "UPDATE registrasi_lap_masyarakat SET tgl_pleno = ?, kewenangan_ombudsman = ?, status = ?, alasan = ?, durasi = ?, petugas_pleno = ? WHERE id_reg = ?";
            $stmt = $db->prepare($updateSql);
            $stmt->bindParam(1, $_POST['tgl_pleno']);
            $stmt->bindParam(2, $_POST['kewenangan_ombudsman']);
            $stmt->bindParam(3, $status);
            $stmt->bindParam(4, $_POST['alasan']);
            $stmt->bindParam(5, $durasi);
            $stmt->bindParam(6, $petugas_pleno);
            $stmt->bindParam(7, $id);
            if ($stmt->execute()) {
                $_SESSION['hasil'] = true;
                $_SESSION['pesan'] = "Berhasil ubah data";
            } else {
                $_SESSION['hasil'] = false;
                $_SESSION['pesan'] = "Gagal ubah data";
            }
            echo '<meta http-equiv="refresh" content="0; url=?page=pleno">';
        }


?>
        <div class="row">
            <div class="pt-3 pb-1" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Pleno</span></h5>
                        </div>
                        <div class="col s12 m6 l6 right-align-md">
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="?page=home">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="?page=pleno">Pleno</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <!--Fixed Width Tabs-->
            <div class="row">
                <div class="col s12 m12 l12">
                    <div id="Fixed-width-tabs" class="card card card-default scrollspy">
                        <div class="card-content">
                            <div class="row">
                                <div class="col s12">
                                    <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
                                        <li class="tab"><a class="active" href="#laporan">Laporan</a></li>
                                        <li class="tab"><a href="#pelapor">Pelapor</a></li>
                                        <li class="tab"><a href="#terlapor">Terlapor</a></li>
                                    </ul>
                                </div>
                                <div class="col s12">

                                    <!-- Laporan -->
                                    <div id="laporan" class="col s12 mt-3">
                                        <p><a>Registrasi Laporan Masuk</a></p>
                                        <div class="col s12">
                                            <table class="striped">
                                                <tbody>
                                                    <tr>
                                                        <td>Tanggal Agenda:</td>
                                                        <td><?php echo tgl_indo($row['tgl_agenda']) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tipe Laporan:</td>
                                                        <td><?php echo $row['tipe_laporan'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cara Penyampaian:</td>
                                                        <td><?php echo $row['cara_penyampaian'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nomor Agenda:</td>
                                                        <td><?php echo $row['no_agenda'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nomor Arsip:</td>
                                                        <td><?php echo $row['no_arsip'] ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <p><a>Laporan</a></p>
                                        <div class="col s12">
                                            <table class="striped">
                                                <tbody>
                                                    <tr>
                                                        <td>Substansi:</td>
                                                        <td><?php echo $row['nama_sub'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pokok Permasalahan:</td>
                                                        <td><?php echo $row['nama_klasper'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Perihal:</td>
                                                        <td><?php echo $row['perihal'] ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Pelapor -->
                                    <div id="pelapor" class="col s12 mt-3">
                                        <p><a>Informasi Pelapor</a></p>
                                        <div class="col s12">
                                            <table class="striped">
                                                <tbody>
                                                    <tr>
                                                        <td>Identitas Pelapor Dirahasiakan:</td>
                                                        <td><?php echo $row['identitas_pelapor_rahasia'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Lengkap:</td>
                                                        <td><?php echo $row['nama_pelapor'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Upload File KTP Verifikasi Formil:</td>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Warga Negara:</td>
                                                        <td><?php echo $row['pilih_wn'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jenis Identitas:</td>
                                                        <td><?php echo $row['pilih_ji'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nomor Identitas:</td>
                                                        <td><?php echo $row['nomor_identitas'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tempat Lahir:</td>
                                                        <td><?php echo $row['tempat_lahir'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Lahir:</td>
                                                        <td><?php echo tgl_indo($row['tanggal_lahir']) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jenis Kelamin:</td>
                                                        <td><?php echo $row['jenis_kelamin'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pendidikan Terakhir:</td>
                                                        <td><?php echo $row['pendidikan_pelapor'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status Perkawinan:</td>
                                                        <td><?php echo $row['status_perkawinan'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pekerjaan:</td>
                                                        <td><?php echo $row['pekerjaan'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat Lengkap:</td>
                                                        <td><?php echo $row['alamat_lengkap_pel'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Provinsi:</td>
                                                        <td><?php echo $row['nama_prov'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kota/Kabupaten:</td>
                                                        <td><?php echo $row['nama_kab'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kecamatan:</td>
                                                        <td><?php echo $row['nama_kec'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>No Handphone:</td>
                                                        <td><?php echo $row['no_telp'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email:</td>
                                                        <td><?php echo $row['email'] ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Terlapor -->
                                    <div id="terlapor" class="col s12 mt-3">
                                        <p><a>Informasi Terlapor</a></p>
                                        <div class="col s12">
                                            <table class="striped">
                                                <tbody>
                                                    <tr>
                                                        <td>Nama Terlapor:</td>
                                                        <td><?php echo $row['nama_terlapor'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jabatan Terlapor:</td>
                                                        <td><?php echo $row['jabatan_terlapor'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kelompok Instansi Terlapor:</td>
                                                        <td><?php echo $row['pilih_kel'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Klasifikasi Instansi Terlapor:</td>
                                                        <td><?php echo $row['pilih_ins'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Instansi Terlapor:</td>
                                                        <td><?php echo $row['instansi_terlapor'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat Terlapor:</td>
                                                        <td><?php echo $row['alamat_terlapor'] ?></td>
                                                    </tr>
                                                    <?php
                                                    $database = new Database();
                                                    $db = $database->getConnection();
                                                    $selectSql2 = "SELECT * FROM terlapor ter 
                                                    join provinsi prvt ON prvt.id_prov=ter.provinsi_ter 
                                                    JOIN kabupaten kabt ON kabt.id_kab=ter.kabupaten_ter 
                                                    JOIN kecamatan kect ON kect.id_kec=ter.kecamatan_ter WHERE id_ter=$id";
                                                    $stmt = $db->prepare($selectSql2);
                                                    $stmt->execute();
                                                    while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                        <tr>
                                                            <td>Provinsi:</td>
                                                            <td><?php echo $row2['nama_prov'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kota/Kabupaten:</td>
                                                            <td><?php echo $row2['nama_kab'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kecamatan:</td>
                                                            <td><?php echo $row2['nama_kec'] ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section users-edit">
            <div class="card">
                <div class="card-content">
                    <form id="accountForm" method="POST" action="">
                        <div class="row">
                            <div class="col s12">
                                <!-- users edit account form start -->
                                <div class="row">
                                    <p><a>Pleno</a></p>
                                    <div class="col s12">
                                        <div class="input-field col s12">
                                            <input required value="<?php echo $row['tgl_pleno'] ?>" type="date" id="tgl_pleno" name="tgl_pleno">
                                            <label for="tgl_pleno">Tanggal Pleno</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <p>Kewenangan Ombudsman</p>
                                            <p>
                                                <label>
                                                    <input name="kewenangan_ombudsman" type="radio" <?php if ($row['kewenangan_ombudsman'] == 'Kewenangan Ombudsman') echo 'checked'; ?> value="Kewenangan Ombudsman" />
                                                    <span>Ya</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input name="kewenangan_ombudsman" type="radio" <?php if ($row['kewenangan_ombudsman'] == 'Ditolak') echo 'checked'; ?> value="Ditolak" />
                                                    <span>Tidak</span>
                                                </label>
                                            </p>
                                        </div>
                                        <div class="input-field col s12">
                                            <textarea required value="" id="alasan" name="alasan" type="text" class="validate materialize-textarea"><?php echo $row['alasan'] ?></textarea>
                                            <label for="alasan">Alasan</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- users edit account form ends -->
                            </div>
                            <div class="col s12 display-flex justify-content-end mt-3">
                                <button type="submit" class="btn indigo" name="button_update">
                                    Save changes</button>
                                <button type="button" class="btn btn-light">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- users edit Info form ends -->
                </div>
            </div>
        </div>

        <?php include 'partials/scripts.php'; ?>



<?php
    } else {
        echo '<meta http-equiv="refresh" content="0; url=?page=pleno">';
    }
} else {
    echo '<meta http-equiv="refresh" content="0; url=?page=pleno">';
}
?>