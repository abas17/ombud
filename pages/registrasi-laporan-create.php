<?php
$database = new Database();
$db = $database->getConnection();

if (isset($_POST['button_create'])) {
    if (empty($_POST['tgl_agenda']) || empty($_POST['tipe_laporan']) || empty($_POST['cara_penyampaian'])) {
?>
        <div class="card-alert card gradient-45deg-red-pink">
            <div class="card-content white-text">
                <p>
                    <i class="material-icons">error</i> Data wajib diisi dengan lengkap
                </p>
            </div>
            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
<?php
    } else {
        $insertSql = "INSERT INTO registrasi_lap_masyarakat(id_reg,tgl_agenda,tipe_laporan,cara_penyampaian) VALUES (NULL, ?, ?, ?)";
        $stmt = $db->prepare($insertSql);
        $stmt->bindParam(1, $_POST['tgl_agenda']);
        $stmt->bindParam(2, $_POST['tipe_laporan']);
        $stmt->bindParam(3, $_POST['cara_penyampaian']);
        if ($stmt->execute()) {
            $_SESSION['hasil'] = true;
            $_SESSION['pesan'] = "Berhasil membuat data";
        } else {
            $_SESSION['hasil'] = false;
            $_SESSION['pesan'] = "Gagal membuat data";
        }
        echo '<meta http-equiv="refresh" content="0; url=?page=registrasi-laporan-creates&id=">';
    }


    // echo $insertSql;
}
?>

<div class="row">
    <div class="pt-3 pb-1" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Registrasi Laporan</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="?page=home">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="?page=registrasi-laporan">Registrasi Laporan</a>
                        </li>
                        <li class="breadcrumb-item active">Registrasi Laporan Masuk
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="seaction">
    <div class="card">
        <div class="card-content">
            <h4 class="card-title mb-3">Laporan Masuk</h4>
            <form method="POST">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="date" id="tgl_agenda" name="tgl_agenda">
                        <label for="tgl_agenda">Tanggal Agenda</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <div>
                            <label for="tipe_laporan">Tipe Laporan</label>
                        </div>
                        <select name="tipe_laporan" class="select2 browser-default">
                            <option value="" disabled selected>---Pilih Tipe Laporan---</option>
                            <?php
                            $selectSql = "SELECT * FROM tipe_laporan ORDER BY id_tipe_lap";
                            $stmt_tipe_laporan = $db->prepare($selectSql);
                            $stmt_tipe_laporan->execute();

                            while ($row_tipe_laporan = $stmt_tipe_laporan->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row_tipe_laporan["pilih_tipe_lap"] . '">' . $row_tipe_laporan["tipe_lap"] . '</option>';
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
                        <select name="cara_penyampaian" class="select2 browser-default">
                            <option value="" disabled selected>---Pilih Cara Penyampaian---</option>
                            <?php
                            $selectSql = "SELECT * FROM cara_penyampaian ORDER BY id_cara_penyampaian";
                            $stmt_cara_penyampaian = $db->prepare($selectSql);
                            $stmt_cara_penyampaian->execute();

                            while ($row_cara_penyampaian = $stmt_cara_penyampaian->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row_cara_penyampaian["pilih_cara_penyampaian"] . '">' . $row_cara_penyampaian["penyampaian"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="row">
                    <div class="row">
                        <div class="input-field col s12 pr-6">
                            <button type="submit" class="btn btn_succes waves-effect waves-light float-right" name="button_create">
                                <i class="material-icons right">send</i></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>

<?php include 'partials/scripts.php'; ?>