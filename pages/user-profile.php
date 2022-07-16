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
<?php
$database = new Database();
$db = $database->getConnection();

$id = $_SESSION["user"]['id'];
$findSql = "SELECT * FROM users WHERE id = ?";
$stmt = $db->prepare($findSql);
$stmt->bindParam(1, $id);
$stmt->execute();
$row = $stmt->fetch();

if (isset($row['id'])) {
    if (isset($_POST['button_update'])) {
        $username = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING);
        date_default_timezone_set('Asia/Makassar');
        $ldate = date('Y-m-d H:i:s', time());
        $updateSql = "UPDATE users SET username = ?, nama = ?, email = ?, no_tlp = ?, updationDate = ? WHERE id = ?";
        $stmt = $db->prepare($updateSql);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $_POST['name']);
        $stmt->bindParam(3, $_POST['email']);
        $stmt->bindParam(4, $_POST['no_hp']);
        $stmt->bindParam(5, $ldate);
        $stmt->bindParam(6, $id);
        if ($stmt->execute()) {
            $_SESSION['hasil'] = true;
            $_SESSION['pesan'] = "Berhasil ubah data";
        } else {
            $_SESSION['hasil'] = false;
            $_SESSION['pesan'] = "Gagal ubah data";
        }
        echo '<meta http-equiv="refresh" content="0; url=?page=user-profile">';
    }
    if (isset($_POST['button_update2'])) {
        $oldpassword = filter_input(INPUT_POST, 'oldpswd', FILTER_SANITIZE_STRING);
        $password = password_hash($_POST["cpassword"], PASSWORD_DEFAULT);
        date_default_timezone_set('Asia/Makassar');
        $ldate = date('Y-m-d H:i:s', time());
        if (password_verify($oldpassword, $row["password"])) {
            $updateSql = "UPDATE users SET password = ?, updationDate = ? WHERE id = ?";
            $stmt = $db->prepare($updateSql);
            $stmt->bindParam(1, $password);
            $stmt->bindParam(2, $ldate);
            $stmt->bindParam(3, $id);
            $stmt->execute();
            $_SESSION['hasil'] = true;
            $_SESSION['pesan'] = "Berhasil ubah password";
            echo '<meta http-equiv="refresh" content="0; url=?page=user-profile">';
        } else {
            $_SESSION['hasil'] = false;
            $_SESSION['pesan'] = "Password salah";
            echo '<meta http-equiv="refresh" content="0; url=?page=user-profile">';
        }
    }
    if (isset($_POST['button_update3'])) {
        date_default_timezone_set('Asia/Makassar');
        $ldate = date('Y-m-d H:i:s', time());
        $updateSql = "UPDATE users SET warga_negara= ?, jenis_identitas= ?, nomor_identitas= ?, file_ktp= ?, tempat_lahir= ?, tgl_lahir= ?, jenis_kelamin= ?, pendidikan= ?, 
        status_perkawinan= ?, pekerjaan= ?, alamat= ?, provinsi= ?, kabupaten= ?, kecamatan= ?, updationDate = ? WHERE id = ?";
        $stmt = $db->prepare($updateSql);
        $stmt->bindParam(1, $_POST['warga_negara']);
        $stmt->bindParam(2, $_POST['jenis_identitas']);
        $stmt->bindParam(3, $_POST['nomor_identitas']);
        $stmt->bindParam(4, $_POST['file_ktp']);
        $stmt->bindParam(5, $_POST['tempat_lahir']);
        $stmt->bindParam(6, $_POST['tgl_lahir']);
        $stmt->bindParam(7, $_POST['jenis_kelamin']);
        $stmt->bindParam(8, $_POST['pendidikan']);
        $stmt->bindParam(9, $_POST['status_perkawinan']);
        $stmt->bindParam(10, $_POST['pekerjaan']);
        $stmt->bindParam(11, $_POST['alamat']);
        $stmt->bindParam(12, $_POST['provinsi']);
        $stmt->bindParam(13, $_POST['kabupaten']);
        $stmt->bindParam(14, $_POST['kecamatan']);
        $stmt->bindParam(15, $ldate);
        $stmt->bindParam(16, $id);
        if ($stmt->execute()) {
            $_SESSION['hasil'] = true;
            $_SESSION['pesan'] = "Berhasil ubah data";
        } else {
            $_SESSION['hasil'] = false;
            $_SESSION['pesan'] = "Gagal ubah data";
        }
        echo '<meta http-equiv="refresh" content="0; url=?page=user-profile">';
    }
?>
    <!-- Account settings -->
    <section class="tabs-vertical mt-1 section">
        <div class="row">
            <div class="col l4 s12">
                <!-- tabs  -->
                <div class="card-panel">
                    <ul class="tabs">
                        <li class="tab">
                            <a href="#general">
                                <i class="material-icons">brightness_low</i>
                                <span>General</span>
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#change-password">
                                <i class="material-icons">lock_open</i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#info">
                                <i class="material-icons">error_outline</i>
                                <span> Info</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col l8 s12">
                <!-- tabs content -->
                <div id="general">
                    <div class="card-panel">
                        <div class="display-flex">
                            <div class="media">
                                <img src="" class="border-radius-4" alt="profile image" height="64" width="64">
                            </div>
                            <div class="media-body">
                                <div class="general-action-btn">
                                    <button id="select-files" class="btn indigo mr-2">
                                        <span>Upload new photo</span>
                                    </button>
                                    <button class="btn btn-light-pink">Reset</button>
                                </div>
                                <small>Allowed JPG, GIF or PNG. Max size of 800kB</small>
                                <div class="upfilewrapper">
                                    <input id="upfile" type="file" />
                                </div>
                            </div>
                        </div>
                        <div class="divider mb-1 mt-1"></div>
                        <form class="formValidate" method="POST">
                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field">
                                        <label for="uname">Username</label>
                                        <input type="text" id="uname" name="uname" value="<?php echo $row['username'] ?>" data-error=".errorTxt1">
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <label for="name">Nama Lengkap</label>
                                        <input id="name" name="name" type="text" value="<?php echo $row['nama'] ?>" data-error=".errorTxt2">
                                        <small class="errorTxt2"></small>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <label for="email">E-mail</label>
                                        <input id="email" type="email" name="email" value="<?php echo $row['email'] ?>" data-error=".errorTxt3">
                                        <small class="errorTxt3"></small>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <input value="<?php echo $row['no_tlp'] ?>" id="no_hp" name="no_hp" type="text" required maxlength="16">
                                        <label for="no_hp">No Handphone</label>
                                    </div>
                                </div>
                                <div class="col s12 display-flex justify-content-end form-action">
                                    <button type="submit" name="button_update" class="btn indigo waves-effect waves-light mr-2">
                                        Save changes
                                    </button>
                                    <button type="reset" class="btn btn-light-pink waves-effect waves-light mb-1">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="change-password">
                    <div class="card-panel">
                        <form action="" method="POST" class="formValidate" id="formValidate">
                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="oldpswd" name="oldpswd" type="password" required>
                                        <label for="oldpswd">Old Password</label>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="password" name="password" type="password">
                                        <label for="password">New Password</label>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="cpassword" type="password" name="cpassword">
                                        <label for="cpassword">Retype new Password</label>
                                    </div>
                                </div>
                                <div class="col s12 display-flex justify-content-end form-action">
                                    <button type="submit" name="button_update2" class="btn indigo waves-effect waves-light mr-1">Save changes</button>
                                    <button type="reset" class="btn btn-light-pink waves-effect waves-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="info">
                    <div class="card-panel">
                        <form class="formValidate" id="formValidate" method="POST">
                            <div class="row">
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
                                    <input value="<?php echo $row['nomor_identitas'] ?>" id="nomor_identitas" name="nomor_identitas" type="text" class="validate" maxlength="20">
                                    <label for="nomor_identitas">Nomor Identitas</label>
                                </div>
                                <div class="row section">
                                    <div class="col s12 ml-1">
                                        <p>Upload Foto Identitas</p>
                                    </div>
                                    <div class="col s6 m8 right">
                                        <input name="file_ktp" type="file" width="250" id="input-file-events" class="dropify-event" data-default-file="" />
                                    </div>
                                </div>
                                <div class="input-field col s12">
                                    <input value="<?php echo $row['tempat_lahir'] ?>" id="tempat_lahir" name="tempat_lahir" type="text" class="">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                </div>
                                <div class="input-field col s12">
                                    <div>
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                    </div>
                                    <input value="<?php echo $row['tgl_lahir'] ?>" id="tgl_lahir" name="tgl_lahir" type="date" class="">
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
                                        <label for="pendidikan">Pendidikan Terakhir</label>
                                    </div>
                                    <select name="pendidikan">
                                        <option value="" disabled selected>---Pilih Pendidikan Terakhir---</option>
                                        <option value="SD" <?php if ($row['pendidikan'] == 'SD') echo 'selected'; ?>>SD</option>
                                        <option value="SMP" <?php if ($row['pendidikan'] == 'SMP') echo 'selected'; ?>>SMP</option>
                                        <option value="SMA/Sederajat" <?php if ($row['pendidikan'] == 'SMA/Sederajat') echo 'selected'; ?>>SMA/Sederajat</option>
                                        <option value="D3" <?php if ($row['pendidikan'] == 'D3') echo 'selected'; ?>>D3</option>
                                        <option value="S1" <?php if ($row['pendidikan'] == 'S1') echo 'selected'; ?>>S1</option>
                                        <option value="S2" <?php if ($row['pendidikan'] == 'S2') echo 'selected'; ?>>S2</option>
                                        <option value="S3" <?php if ($row['pendidikan'] == 'S3') echo 'selected'; ?>>S3</option>
                                        <option value="Tidak Sekolah" <?php if ($row['pendidikan'] == 'Sekolah') echo 'selected'; ?>>Tidak Sekolah</option>
                                        <option value="Lainnya" <?php if ($row['pendidikan'] == 'Lainnya') echo 'selected'; ?>>Lainnya</option>
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
                                    <input value="<?php echo $row['pekerjaan'] ?>" id="pekerjaan" name="pekerjaan" type="text" class="">
                                    <label for="pekerjaan">Pekerjaan</label>
                                </div>
                                <div class="input-field col s12">
                                    <textarea value="" id="alamat" name="alamat" type="text" class=" materialize-textarea"><?php echo $row['alamat'] ?></textarea>
                                    <label for="alamat">Alamat Lengkap</label>
                                </div>
                                <div class="input-field col s12">
                                    <div>
                                        <label for="provinsi">Provinsi</label>
                                    </div>
                                    <select class="select2 browser-default" name="provinsi" id="provinsi">
                                        <option value="" disabled selected>---Pilih Provinsi---</option>
                                        <?php
                                        $prov = $row['provinsi'];
                                        $selectSql = "SELECT * FROM provinsi ORDER BY nama_prov ASC";
                                        $stmt = $db->prepare($selectSql);
                                        $stmt->execute();
                                        while ($rowprov = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            if ($rowprov["id_prov"] == $prov) {
                                                echo '<option value="' . $rowprov["id_prov"] . '"selected>' . $rowprov["nama_prov"] . '</option>';
                                            } else {
                                                echo '<option value="' . $rowprov["id_prov"] . '">' . $rowprov["nama_prov"] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-field col s12">
                                    <div>
                                        <label for="kabupaten">Kota/Kabupaten</label>
                                    </div>
                                    <select class="select2 browser-default" name="kabupaten" id="kabupaten">
                                        <option value="" disabled selected>---Pilih Kota/Kabupaten---</option>
                                        <?php
                                        $kab = $row['kabupaten'];
                                        $selectSql = "SELECT * FROM kabupaten WHERE id_prov=? order by nama_kab";
                                        $stmt = $db->prepare($selectSql);
                                        $stmt->bindParam(1, $prov);
                                        $stmt->execute();
                                        while ($rowkab = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            if ($rowkab["id_kab"] == $kab) {
                                                echo '<option value="' . $rowkab["id_kab"] . '"selected>' . $rowkab["nama_kab"] . '</option>';
                                            } else {
                                                echo '<option value="' . $rowkab["id_kab"] . '">' . $rowkab["nama_kab"] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-field col s12">
                                    <div>
                                        <label for="kecamatan">Kecamatan</label>
                                    </div>
                                    <select class="select2 browser-default" name="kecamatan" id="kecamatan">
                                        <option value="" disabled selected>---Pilih Kecamatan---</option>
                                        <?php
                                        $kec = $row['kecamatan'];
                                        $selectSql = "SELECT * FROM kecamatan WHERE id_kab=? ORDER BY nama_kec ASC";
                                        $stmt = $db->prepare($selectSql);
                                        $stmt->bindParam(1, $kab);
                                        $stmt->execute();
                                        while ($rowkec = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            if ($rowkec["id_kec"] == $kec) {
                                                echo '<option value="' . $rowkec["id_kec"] . '"selected>' . $rowkec["nama_kec"] . '</option>';
                                            } else {
                                                echo '<option value="' . $rowkec["id_kec"] . '">' . $rowkec["nama_kec"] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col s12 display-flex justify-content-end form-action">
                                    <button type="submit" name="button_update3" class="btn indigo waves-effect waves-light mr-2">Save
                                        changes</button>
                                    <button type="button" class="btn btn-light-pink waves-effect waves-light ">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'partials/scripts.php'; ?>

<?php
} else {
    echo '<meta http-equiv="refresh" content="0; url=?page=home">';
}
?>

<script type="text/javascript">
        $("#provinsi").change(function() {
            var provinsi = $("#provinsi").val();
            $.ajax({
                type: 'POST',
                url: "get_kabupaten.php",
                data: {
                    provinsi: provinsi
                },
                cache: false,
                success: function(msg) {
                    $("#kabupaten").html(msg);
                }
            });
        });

        $("#kabupaten").change(function() {
            var kabupaten = $("#kabupaten").val();
            $.ajax({
                type: 'POST',
                url: "get_kecamatan.php",
                data: {
                    kabupaten: kabupaten
                },
                cache: false,
                success: function(msg) {
                    $("#kecamatan").html(msg);
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
</script>