<?php
if (isset($_GET['id']) && $_GET['id'] <> '') {
    $database = new Database();
    $db = $database->getConnection();

    $id = $_GET['id'];
    $findSql = "SELECT * FROM registrasi_lap_masyarakat r 
JOIN pelapor p ON r.id_reg=p.id_pel
JOIN terlapor t ON p.id_pel=t.id_ter where id_reg = ?";
    $stmt = $db->prepare($findSql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $row = $stmt->fetch();

    if (isset($row['id_reg'])) {
        if (isset($_POST['button_update'])) {
            $perwakilan = $_SESSION['user']['perwakilan'];
            $db->beginTransaction();
            $updateSql = "UPDATE registrasi_lap_masyarakat SET tgl_agenda = ?, tipe_laporan = ?, cara_penyampaian = ?, no_agenda = ?, no_arsip = ?, 
            substansi = ?, klasifikasi_permasalahan=?, perihal = ?, perwakilan= ? WHERE id_reg = ?";
            $stmt = $db->prepare($updateSql);
            $stmt->bindParam(1, $_POST['tgl_agenda']);
            $stmt->bindParam(2, $_POST['tipe_laporan']);
            $stmt->bindParam(3, $_POST['cara_penyampaian']);
            $stmt->bindParam(4, $_POST['no_agenda']);
            $stmt->bindParam(5, $_POST['no_arsip']);
            $stmt->bindParam(6, $_POST['substansi']);
            $stmt->bindParam(7, $_POST['klasifikasi_permasalahan']);
            $stmt->bindParam(8, $_POST['perihal']);
            $stmt->bindParam(9, $perwakilan);
            $stmt->bindParam(10, $id);
            $stmt->execute();

            $updateSql = "UPDATE pelapor SET identitas_pelapor_rahasia= ?, nama_pelapor= ?, file_ktp= ?, warga_negara= ?, jenis_identitas= ?, nomor_identitas= ?, 
            tempat_lahir= ?, tanggal_lahir= ?, jenis_kelamin= ?, pendidikan_pelapor= ?, status_perkawinan= ?, pekerjaan= ?, alamat_lengkap_pel= ?, provinsi_pel= ?, 
            kabupaten_pel= ?, kecamatan_pel= ?, no_telp= ?, email= ? WHERE id_pel = ?";
            $stmt = $db->prepare($updateSql);
            $stmt->bindParam(1, $_POST['identitas_pelapor_rahasia']);
            $stmt->bindParam(2, $_POST['nama_pelapor']);
            $stmt->bindParam(3, $_POST['file_ktp']);
            $stmt->bindParam(4, $_POST['warga_negara']);
            $stmt->bindParam(5, $_POST['jenis_identitas']);
            $stmt->bindParam(6, $_POST['nomor_identitas']);
            $stmt->bindParam(7, $_POST['tempat_lahir']);
            $stmt->bindParam(8, $_POST['tanggal_lahir']);
            $stmt->bindParam(9, $_POST['jenis_kelamin']);
            $stmt->bindParam(10, $_POST['pendidikan_pelapor']);
            $stmt->bindParam(11, $_POST['status_perkawinan']);
            $stmt->bindParam(12, $_POST['pekerjaan']);
            $stmt->bindParam(13, $_POST['alamat_lengkap_pel']);
            $stmt->bindParam(14, $_POST['provinsi_pel']);
            $stmt->bindParam(15, $_POST['kabupaten_pel']);
            $stmt->bindParam(16, $_POST['kecamatan_pel']);
            $stmt->bindParam(17, $_POST['no_telp']);
            $stmt->bindParam(18, $_POST['email']);
            $stmt->bindParam(19, $id);
            $stmt->execute();

            $updateSql = "UPDATE terlapor SET nama_terlapor= ?, jabatan_terlapor= ?, kelompok_klasifikasi_instansi= ?, klasifikasi_instansi_terlapor= ?, 
            instansi_terlapor= ?, alamat_terlapor= ?, provinsi_ter= ?, kabupaten_ter= ?, kecamatan_ter= ? WHERE id_ter = ?";
            $stmt = $db->prepare($updateSql);
            $stmt->bindParam(1, $_POST['nama_terlapor']);
            $stmt->bindParam(2, $_POST['jabatan_terlapor']);
            $stmt->bindParam(3, $_POST['kelompok_klasifikasi_instansi']);
            $stmt->bindParam(4, $_POST['klasifikasi_instansi_terlapor']);
            $stmt->bindParam(5, $_POST['instansi_terlapor']);
            $stmt->bindParam(6, $_POST['alamat_terlapor']);
            $stmt->bindParam(7, $_POST['provinsi_ter']);
            $stmt->bindParam(8, $_POST['kabupaten_ter']);
            $stmt->bindParam(9, $_POST['kecamatan_ter']);
            $stmt->bindParam(10, $id);

            if ($stmt->execute()) {
                $db->commit();
                $_SESSION['hasil'] = true;
                $_SESSION['pesan'] = "Berhasil ubah data";
            } else {
                $_SESSION['hasil'] = false;
                $_SESSION['pesan'] = "Gagal ubah data";
            }
            echo '<meta http-equiv="refresh" content="0; url=?page=registrasi-laporan">';
        }



?>
        <div class="row">
            <div class="pt-3 pb-1" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Ubah Registrasi Laporan</span></h5>
                        </div>
                        <div class="col s12 m6 l6 right-align-md">
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="?page=home">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="?page=registrasi-laporan">Registrasi Laporan</a>
                                </li>
                                <li class="breadcrumb-item active">Ubah Registrasi Laporan</li>
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
                                    <form method="POST" action="" class="formValidate0" id="formValidate0">
                                        <!-- Laporan -->
                                        <div id="laporan" class="col s12 mt-3">
                                            <p><a>Registrasi Laporan Masuk</a></p>
                                            <div class="col s12">
                                                <input value="<?php echo $row['id_reg'] ?>" type="hidden" id="id" name="id">
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input value="<?php echo $row['tgl_agenda'] ?>" type="date" id="tgl_agenda" name="tgl_agenda">
                                                        <label for="tgl_agenda">Tanggal Agenda</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <div>
                                                            <label for="tipe_laporan">---Tipe Laporan---</label>
                                                        </div>
                                                        <select name="tipe_laporan" id="tipe_laporan" class="select2 browser-default">
                                                            <option value="" disabled selected>---Pilih Tipe Laporan---</option>
                                                            <?php
                                                            $tipelap = $row['tipe_laporan'];
                                                            $selectSql = "SELECT * FROM tipe_laporan";
                                                            $stmt_tipe_laporan = $db->prepare($selectSql);
                                                            $stmt_tipe_laporan->execute();

                                                            while ($row_tipe_laporan = $stmt_tipe_laporan->fetch(PDO::FETCH_ASSOC)) {
                                                                if ($row_tipe_laporan["tipe_lap"] == $tipelap) {
                                                                    echo "<option value='" . $row_tipe_laporan["tipe_lap"] . "' selected>" . $row_tipe_laporan["tipe_lap"] . "</option>";
                                                                } else {
                                                                    echo "<option value='" . $row_tipe_laporan["tipe_lap"] . "'>" . $row_tipe_laporan["tipe_lap"] . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <div>
                                                            <label for="cara_penyampaian">Cara Penyampaian</label>
                                                        </div>
                                                        <select name="cara_penyampaian" id="cara_penyampaian" class="select2 browser-default">
                                                            <option value="" disabled selected>---Pilih Cara Penyampaian---</option>
                                                            <?php
                                                            $cara_pen = $row['cara_penyampaian'];
                                                            $selectSql = "SELECT * FROM cara_penyampaian ORDER BY id_cara_penyampaian";
                                                            $stmt_cara_penyampaian = $db->prepare($selectSql);
                                                            $stmt_cara_penyampaian->execute();

                                                            while ($row_cara_penyampaian = $stmt_cara_penyampaian->fetch(PDO::FETCH_ASSOC)) {
                                                                if ($row_cara_penyampaian["penyampaian"] == $cara_pen) {
                                                                    echo "<option value='" . $row_cara_penyampaian["penyampaian"] . "' selected>" . $row_cara_penyampaian["penyampaian"] . "</option>";
                                                                } else {
                                                                    echo "<option value='" . $row_cara_penyampaian["penyampaian"] . "'>" . $row_cara_penyampaian["penyampaian"] . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input value="<?php echo $row['no_agenda'] ?>" id="no_agenda" name="no_agenda" type="text" class="validate">
                                                    <label for="no_agenda">Nomor Agenda</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input value="<?php echo $row['no_arsip'] ?>" id="no_arsip" name="no_arsip" type="text" class="validate">
                                                    <label for="no_arsip">Nomor Arsip</label>
                                                </div>
                                            </div>

                                            <p><a>Laporan</a></p>
                                            <div class="col s12">
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="substansi">Substansi</label>
                                                    </div>
                                                    <select class="select2 browser-default" name="substansi" id="substansi">
                                                        <option value="" disabled selected>---Pilih Substansi---</option>
                                                        <?php
                                                        $sub = $row['substansi'];
                                                        $selectSql = "SELECT * FROM substansi ORDER BY nama_sub ASC";
                                                        $stmt = $db->prepare($selectSql);
                                                        $stmt->execute();

                                                        while ($rowsub = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            if ($rowsub["id_sub"] == $sub) {
                                                                echo "<option value='" . $rowsub["id_sub"] . "' selected>" . $rowsub["nama_sub"] . "</option>";
                                                            } else {
                                                                echo "<option value='" . $rowsub["id_sub"] . "'>" . $rowsub["nama_sub"] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="klasifikasi_permasalahan">Pokok Permasalahan</label>
                                                    </div>
                                                    <select class="select2 browser-default" name="klasifikasi_permasalahan" id="klasifikasi_permasalahan">
                                                        <option value="" disabled selected>---Pilih Pokok Permasalahan---</option>
                                                        <?php
                                                        $pokper = $row['klasifikasi_permasalahan'];
                                                        $selectSql = "SELECT * FROM klasifikasi_permasalahan WHERE id_sub=? order by nama_klasper";
                                                        $stmt = $db->prepare($selectSql);
                                                        $stmt->bindParam(1, $sub);
                                                        $stmt->execute();
                                                        while ($rowpokper = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            if ($rowpokper["id_klasper"] == $pokper) {
                                                                echo "<option value='" . $rowpokper["id_klasper"] . "' selected>" . $rowpokper["nama_klasper"] . "</option>";
                                                            } else {
                                                                echo "<option value='" . $rowpokper["id_klasper"] . "'>" . $rowpokper["nama_klasper"] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <textarea value="" id="perihal" name="perihal" type="text" class="validate materialize-textarea"><?php echo $row['perihal'] ?></textarea>
                                                    <label for="perihal">Perihal</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pelapor -->
                                        <div id="pelapor" class="col s12 mt-3">
                                            <p><a>Informasi Pelapor</a></p>
                                            <div class="col s12">
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="identitas_pelapor_rahasia">Identitas Pelapor Dirahasiakan</label>
                                                    </div>
                                                    <select name="identitas_pelapor_rahasia">
                                                        <option value="" disabled selected>---Pilih Identitas Pelapor---</option>
                                                        <option value="Rahasia" <?php if ($row['identitas_pelapor_rahasia'] == 'Rahasia') echo 'selected'; ?>>Ya</option>
                                                        <option value="Tidak" <?php if ($row['identitas_pelapor_rahasia'] == 'Tidak') echo 'selected'; ?>>Tidak</option>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input value="<?php echo $row['nama_pelapor'] ?>" id="nama_pelapor" name="nama_pelapor" type="text" class="validate">
                                                    <label for="nama_pelapor">Nama Lengkap</label>
                                                </div>
                                                <div class="row section">
                                                    <div class="col s12 ml-1">
                                                        <p>Upload File KTP Verifikasi Formil</p>
                                                    </div>
                                                    <div class="col s6 m8 right">
                                                        <input name="file_ktp" type="file" width="250" id="input-file-events" class="dropify-event" data-default-file="<?php echo $row['file_ktp'] ?>" />
                                                    </div>
                                                </div>

                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="warga_negara">Warga Negara</label>
                                                    </div>
                                                    <select class="select2 browser-default" name="warga_negara" id="warga_negara">
                                                        <option value="" disabled selected>---Pilih Warga Negara---</option>
                                                        <?php
                                                        $warga_negara = $row['warga_negara'];
                                                        $selectSql = "SELECT * FROM warga_negara ORDER BY id_wn";
                                                        $stmt = $db->prepare($selectSql);
                                                        $stmt->execute();

                                                        while ($rowwg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            if ($rowwg["id_wn"] == $warga_negara) {
                                                                echo "<option value='" . $rowwg["id_wn"] . "' selected>" . $rowwg["pilih_wn"] . "</option>";
                                                            } else {
                                                                echo "<option value='" . $rowwg["id_wn"] . "'>" . $rowwg["pilih_wn"] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="jenis_identitas">Jenis Identitas</label>
                                                    </div>
                                                    <select class="select2 browser-default" name="jenis_identitas" id="jenis_identitas">
                                                        <option value="" disabled selected>---Pilih Jenis Identitas---</option>
                                                        <?php
                                                        $ji = $row['jenis_identitas'];
                                                        $selectSql = "SELECT * FROM jenis_identitas WHERE id_wn=? order by id_ji";
                                                        $stmt = $db->prepare($selectSql);
                                                        $stmt->bindParam(1, $warga_negara);
                                                        $stmt->execute();
                                                        while ($rowji = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            if ($rowji["id_ji"] == $ji) {
                                                                echo '<option value="' . $rowji["id_ji"] . '"selected>' . $rowji["pilih_ji"] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $rowji["id_ji"] . '">' . $rowji["pilih_ji"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input value="<?php echo $row['nomor_identitas'] ?>" id="nomor_identitas" name="nomor_identitas" type="text" class="validate">
                                                    <label for="nomor_identitas">Nomor Identitas</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input value="<?php echo $row['tempat_lahir'] ?>" id="tempat_lahir" name="tempat_lahir" type="text" class="validate">
                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                                    </div>
                                                    <input value="<?php echo $row['tanggal_lahir'] ?>" id="tanggal_lahir" name="tanggal_lahir" type="date" class="validate">
                                                </div>
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                                    </div>
                                                    <select name="jenis_kelamin">
                                                        <option value="" disabled selected>---Pilih Jenis Kelamin---</option>
                                                        <option value="Laki-laki" <?php if ($row['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                                        <option value="Perempuan" <?php if ($row['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="pendidikan_pelapor">Pendidikan Terakhir</label>
                                                    </div>
                                                    <select name="pendidikan_pelapor">
                                                        <option value="" disabled selected>---Pilih Pendidikan Terakhir---</option>
                                                        <option value="SD" <?php if ($row['pendidikan_pelapor'] == 'SD') echo 'selected'; ?>>SD</option>
                                                        <option value="SMP" <?php if ($row['pendidikan_pelapor'] == 'SMP') echo 'selected'; ?>>SMP</option>
                                                        <option value="SMA/Sederajat" <?php if ($row['pendidikan_pelapor'] == 'SMA/Sederajat') echo 'selected'; ?>>SMA/Sederajat</option>
                                                        <option value="D3" <?php if ($row['pendidikan_pelapor'] == 'D3') echo 'selected'; ?>>D3</option>
                                                        <option value="S1" <?php if ($row['pendidikan_pelapor'] == 'S1') echo 'selected'; ?>>S1</option>
                                                        <option value="S2" <?php if ($row['pendidikan_pelapor'] == 'S2') echo 'selected'; ?>>S2</option>
                                                        <option value="S3" <?php if ($row['pendidikan_pelapor'] == 'S3') echo 'selected'; ?>>S3</option>
                                                        <option value="Tidak Sekolah" <?php if ($row['pendidikan_pelapor'] == 'Sekolah') echo 'selected'; ?>>Tidak Sekolah</option>
                                                        <option value="Lainnya" <?php if ($row['pendidikan_pelapor'] == 'Lainnya') echo 'selected'; ?>>Lainnya</option>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="status_perkawinan">Status Perkawinan</label>
                                                    </div>
                                                    <select name="status_perkawinan">
                                                        <option value="" disabled selected>---Pilih Status Perkawinan---</option>
                                                        <option value="Kawin" <?php if ($row['status_perkawinan'] == 'Kawin') echo 'selected'; ?>>Kawin</option>
                                                        <option value="Belum Kawin" <?php if ($row['status_perkawinan'] == 'Belum Kawin') echo 'selected'; ?>>Belum Kawin</option>
                                                        <option value="Cerai Mati" <?php if ($row['status_perkawinan'] == 'Cerai Mati') echo 'selected'; ?>>Cerai Mati</option>
                                                        <option value="Cerai Hidup" <?php if ($row['status_perkawinan'] == 'Cerai Hidup') echo 'selected'; ?>>Cerai Hidup</option>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input value="<?php echo $row['pekerjaan'] ?>" id="pekerjaan" name="pekerjaan" type="text" class="validate">
                                                    <label for="pekerjaan">Pekerjaan</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <textarea value="" id="alamat_lengkap_pel" name="alamat_lengkap_pel" type="text" class="validate materialize-textarea"><?php echo $row['alamat_lengkap_pel'] ?></textarea>
                                                    <label for="alamat_lengkap_pel">Alamat Lengkap</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="provinsi_pel">Provinsi</label>
                                                    </div>
                                                    <select class="select2 browser-default" name="provinsi_pel" id="provinsi_pel">
                                                        <option value="" disabled selected>---Pilih Provinsi---</option>
                                                        <?php
                                                        $prov_pel = $row['provinsi_pel'];
                                                        $selectSql = "SELECT * FROM provinsi ORDER BY nama_prov ASC";
                                                        $stmt = $db->prepare($selectSql);
                                                        $stmt->execute();
                                                        while ($rowprov_pel = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            if ($rowprov_pel["id_prov"] == $prov_pel) {
                                                                echo '<option value="' . $rowprov_pel["id_prov"] . '"selected>' . $rowprov_pel["nama_prov"] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $rowprov_pel["id_prov"] . '">' . $rowprov_pel["nama_prov"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="kabupaten_pel">Kota/Kabupaten</label>
                                                    </div>
                                                    <select class="select2 browser-default" name="kabupaten_pel" id="kabupaten_pel">
                                                        <option value="" disabled selected>---Pilih Kota/Kabupaten---</option>
                                                        <?php
                                                        $kab_pel = $row['kabupaten_pel'];
                                                        $selectSql = "SELECT * FROM kabupaten WHERE id_prov=? order by nama_kab";
                                                        $stmt = $db->prepare($selectSql);
                                                        $stmt->bindParam(1, $prov_pel);
                                                        $stmt->execute();
                                                        while ($rowkab_pel = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            if ($rowkab_pel["id_kab"] == $kab_pel) {
                                                                echo '<option value="' . $rowkab_pel["id_kab"] . '"selected>' . $rowkab_pel["nama_kab"] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $rowkab_pel["id_kab"] . '">' . $rowkab_pel["nama_kab"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="kecamatan_pel">Kecamatan</label>
                                                    </div>
                                                    <select class="select2 browser-default" name="kecamatan_pel" id="kecamatan_pel">
                                                        <option value="" disabled selected>---Pilih Kecamatan---</option>
                                                        <?php
                                                        $kec_pel = $row['kecamatan_pel'];
                                                        $selectSql = "SELECT * FROM kecamatan WHERE id_kab=? ORDER BY nama_kec ASC";
                                                        $stmt = $db->prepare($selectSql);
                                                        $stmt->bindParam(1, $kab_pel);
                                                        $stmt->execute();
                                                        while ($rowkec_pel = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            if ($rowkec_pel["id_kec"] == $kec_pel) {
                                                                echo '<option value="' . $rowkec_pel["id_kec"] . '"selected>' . $rowkec_pel["nama_kec"] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $rowkec_pel["id_kec"] . '">' . $rowkec_pel["nama_kec"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input value="<?php echo $row['no_telp'] ?>" id="no_telp" name="no_telp" type="text" class="validate">
                                                    <label for="no_telp">Nomor Handphone</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input value="<?php echo $row['email'] ?>" id="email" name="email" type="email" class="validate">
                                                    <label for="email">Email</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Terlapor -->
                                        <div id="terlapor" class="col s12 mt-3">
                                            <p><a>Informasi Terlapor</a></p>
                                            <div class="col s12">
                                                <div class="input-field col s12">
                                                    <input value="<?php echo $row['nama_terlapor'] ?>" id="nama_terlapor" name="nama_terlapor" type="text" class="validate">
                                                    <label for="nama_terlapor">Nama Terlapor</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input value="<?php echo $row['jabatan_terlapor'] ?>" id="jabatan_terlapor" name="jabatan_terlapor" type="text" class="validate">
                                                    <label for="jabatan_terlapor">Jabatan Terlapor</label>
                                                </div>

                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="kelompok_klasifikasi_instansi">Kelompok Instansi Terlapor</label>
                                                    </div>
                                                    <select class="select2 browser-default" name="kelompok_klasifikasi_instansi" id="kelompok_klasifikasi_instansi">
                                                        <option value="" disabled selected>---Pilih Kelompok Instansi Terlapor---</option>
                                                        <?php
                                                        $kel_klas = $row['kelompok_klasifikasi_instansi'];
                                                        $selectSql = "SELECT * FROM kelompok_klasifikasi_instansi ORDER BY pilih_kel ASC";
                                                        $stmt = $db->prepare($selectSql);
                                                        $stmt->execute();

                                                        while ($rowkel_klas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            if ($rowkel_klas["id_kel"] == $kel_klas) {
                                                                echo '<option value="' . $rowkel_klas["id_kel"] . '"selected>' . $rowkel_klas["pilih_kel"] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $rowkel_klas["id_kel"] . '">' . $rowkel_klas["pilih_kel"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="klasifikasi_instansi_terlapor">Klasifikasi Instansi Terlapor</label>
                                                    </div>
                                                    <select class="select2 browser-default" name="klasifikasi_instansi_terlapor" id="klasifikasi_instansi_terlapor">
                                                        <option value="" disabled selected>---Pilih Klasifikasi Instansi Terlapor---</option>
                                                        <?php
                                                        $klas_ins = $row['klasifikasi_instansi_terlapor'];
                                                        $selectSql = "SELECT * FROM klasifikasi_instansi_terlapor WHERE id_kel=? order by pilih_ins";
                                                        $stmt = $db->prepare($selectSql);
                                                        $stmt->bindParam(1, $kel_klas);
                                                        $stmt->execute();
                                                        while ($rowklas_ins = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            if ($rowklas_ins["id_ins"] == $klas_ins) {
                                                                echo '<option value="' . $rowklas_ins["id_ins"] . '"selected>' . $rowklas_ins["pilih_ins"] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $rowklas_ins["id_ins"] . '">' . $rowklas_ins["pilih_ins"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input value="<?php echo $row['instansi_terlapor'] ?>" id="instansi_terlapor" name="instansi_terlapor" type="text" class="validate">
                                                    <label for="instansi_terlapor">Instansi Terlapor</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <textarea value="" id="alamat_terlapor" name="alamat_terlapor" type="text" class="validate materialize-textarea"><?php echo $row['alamat_terlapor'] ?></textarea>
                                                    <label for="alamat_terlapor">Alamat Terlapor</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="provinsi_ter">Provinsi</label>
                                                    </div>
                                                    <select class="select2 browser-default" name="provinsi_ter" id="provinsi_ter">
                                                        <option value="" disabled selected>---Pilih Provinsi---</option>
                                                        <?php
                                                        $prov_ter = $row['provinsi_ter'];
                                                        $selectSql = "SELECT * FROM provinsi ORDER BY nama_prov ASC";
                                                        $stmt = $db->prepare($selectSql);
                                                        $stmt->execute();
                                                        while ($rowprov_ter = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            if ($rowprov_ter["id_prov"] == $prov_ter) {
                                                                echo '<option value="' . $rowprov_ter["id_prov"] . '"selected>' . $rowprov_ter["nama_prov"] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $rowprov_ter["id_prov"] . '">' . $rowprov_ter["nama_prov"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="kabupaten_ter">Kota/Kabupaten</label>
                                                    </div>
                                                    <select class="select2 browser-default" name="kabupaten_ter" id="kabupaten_ter">
                                                        <option value="" disabled selected>---Pilih Kota/Kabupaten---</option>
                                                        <?php
                                                        $kab_ter = $row['kabupaten_ter'];
                                                        $selectSql = "SELECT * FROM kabupaten WHERE id_prov=? order by nama_kab";
                                                        $stmt = $db->prepare($selectSql);
                                                        $stmt->bindParam(1, $prov_ter);
                                                        $stmt->execute();
                                                        while ($rowkab_ter = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            if ($rowkab_ter["id_kab"] == $kab_ter) {
                                                                echo '<option value="' . $rowkab_ter["id_kab"] . '"selected>' . $rowkab_ter["nama_kab"] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $rowkab_ter["id_kab"] . '">' . $rowkab_ter["nama_kab"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-field col s12">
                                                    <div>
                                                        <label for="kecamatan_ter">Kecamatan</label>
                                                    </div>
                                                    <select class="select2 browser-default" name="kecamatan_ter" id="kecamatan_ter">
                                                        <option value="" disabled selected>---Pilih Kecamatan---</option>
                                                        <?php
                                                        $kec_ter = $row['kecamatan_ter'];
                                                        $selectSql = "SELECT * FROM kecamatan WHERE id_kab=? ORDER BY nama_kec ASC";
                                                        $stmt = $db->prepare($selectSql);
                                                        $stmt->bindParam(1, $kab_ter);
                                                        $stmt->execute();
                                                        while ($rowkec_ter = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            if ($rowkec_ter["id_kec"] == $kec_ter) {
                                                                echo '<option value="' . $rowkec_ter["id_kec"] . '"selected>' . $rowkec_ter["nama_kec"] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $rowkec_ter["id_kec"] . '">' . $rowkec_ter["nama_kec"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row">
                                                <div class="input-field col s12 pr-7">
                                                    <form method="POST">
                                                        <button type="submit" class="btn btn_succes waves-effect waves-light float-right" name="button_update">
                                                            <i class="material-icons right">send</i></i> Simpan
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'partials/scripts.php'; ?>



<?php
    } else {
        echo '<meta http-equiv="refresh" content="0; url=?page=registrasi-laporan">';
    }
} else {
    echo '<meta http-equiv="refresh" content="0; url=?page=registrasi-laporan">';
}
?>

<script type="text/javascript">
    $("#substansi").change(function() {
        var substansi = $("#substansi").val();
        $.ajax({
            type: 'POST',
            url: "get_pokper.php",
            data: {
                substansi: substansi
            },
            cache: false,
            success: function(msg) {
                $("#klasifikasi_permasalahan").html(msg);
            }
        });
    });


    $("#warga_negara").change(function() {
        var warga = $("#warga_negara").val();
        $.ajax({
            type: 'POST',
            url: "get_identitas.php",
            data: {
                warga: warga
            },
            cache: false,
            success: function(msg) {
                $("#jenis_identitas").html(msg);
            }
        });
    });

    $("#provinsi_pel").change(function() {
        var provinsi = $("#provinsi_pel").val();
        $.ajax({
            type: 'POST',
            url: "get_kabupaten.php",
            data: {
                provinsi: provinsi
            },
            cache: false,
            success: function(msg) {
                $("#kabupaten_pel").html(msg);
            }
        });
    });

    $("#kabupaten_pel").change(function() {
        var kabupaten = $("#kabupaten_pel").val();
        $.ajax({
            type: 'POST',
            url: "get_kecamatan.php",
            data: {
                kabupaten: kabupaten
            },
            cache: false,
            success: function(msg) {
                $("#kecamatan_pel").html(msg);
            }
        });
    });


    $("#kelompok_klasifikasi_instansi").change(function() {
        var klas_ins = $("#kelompok_klasifikasi_instansi").val();
        $.ajax({
            type: 'POST',
            url: "get_klas_ins.php",
            data: {
                klas_ins: klas_ins
            },
            cache: false,
            success: function(msg) {
                $("#klasifikasi_instansi_terlapor").html(msg);
            }
        });
    });

    $("#provinsi_ter").change(function() {
        var provinsi = $("#provinsi_ter").val();
        $.ajax({
            type: 'POST',
            url: "get_kabupaten.php",
            data: {
                provinsi: provinsi
            },
            cache: false,
            success: function(msg) {
                $("#kabupaten_ter").html(msg);
            }
        });
    });

    $("#kabupaten_ter").change(function() {
        var kabupaten = $("#kabupaten_ter").val();
        $.ajax({
            type: 'POST',
            url: "get_kecamatan.php",
            data: {
                kabupaten: kabupaten
            },
            cache: false,
            success: function(msg) {
                $("#kecamatan_ter").html(msg);
            }
        });
    });
</script>