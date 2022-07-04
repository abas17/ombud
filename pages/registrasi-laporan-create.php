<?php
$database = new Database();
$db = $database->getConnection();
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
            <form>
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
                            <a href="#" class="btn cyan waves-effect waves-light right simpan">
                                <i class="material-icons right">send</i>
                                <span class="hide-on-small-only">Submit</span>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>

<?php include 'partials/scripts.php'; ?>
<script>
    $('.simpan').click(function() {
        swal({
            title: "Anda Yakin ingin melakukan registrasi laporan baru?",
            text: "Pastikan data yang Anda isi sudah benar",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Batal',
                delete: 'Simpan'
            }
        }).then(function(willDelete) {
            if (willDelete) {
                swal({
                    title: 'Tersimpan',
                    icon: "success",
                }).then(function() {
                    window.location = "?page=registrasi-laporan-creates";
                });
            } else {
                swal({
                    title: 'Dibatalkan',
                    icon: "error",
                });
            }
        });
    })
</script>