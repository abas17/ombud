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
                        <li class="breadcrumb-item active">Registrasi Laporan Masuk</li>
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
                            <div id="laporan" class="col s12">
                                <form class="row mt-2 mb-2">
                                    <p><a>Registrasi Laporan Masuk</a></p>
                                    <div class="col s12">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input disabled type="date" id="tgl_agenda" name="tgl_agenda">
                                                <label for="tgl_agenda">Tanggal Agenda</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <div>
                                                    <label for="tipe_laporan">---Tipe Laporan---</label>
                                                </div>
                                                <select disabled name="tipe_laporan" class="select2 browser-default">
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
                                                <select disabled name="cara_penyampaian" class="select2 browser-default">
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
                                        <div class="input-field col s12">
                                            <input value="" id="no_agenda" name="no_agenda" type="text" class="validate">
                                            <label for="no_agenda">Nomor Agenda</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input value="" id="no_arsip" name="no_arsip" type="text" class="validate">
                                            <label for="no_arsip">Nomor Arsip</label>
                                        </div>
                                    </div>

                                    <p><a>Laporan</a></p>
                                    <div class="col s12">
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="substansi">Substansi</label>
                                            </div>
                                            <select class="select2 browser-default" name="substansi">
                                                <option value="" disabled selected>---Pilih Substansi---</option>
                                                <?php
                                                $selectSql = "SELECT * FROM substansi ORDER BY id_sub";
                                                $stmt_substansi = $db->prepare($selectSql);
                                                $stmt_substansi->execute();

                                                while ($row_substansi = $stmt_substansi->fetch(PDO::FETCH_ASSOC)) {
                                                    echo '<option value="' . $row_substansi["pilih_substansi"] . '">' . $row_substansi["sub"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="klasifikasi_permasalahan">Pokok Permasalahan</label>
                                            </div>
                                            <select class="select2 browser-default" name="klasifikasi_permasalahan">
                                                <option value="" disabled selected>---Pilih Pokok Permasalahan---</option>

                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <textarea value="" id="perihal" name="perihal" type="text" class="validate materialize-textarea"></textarea>
                                            <label for="perihal">Perihal</label>
                                        </div>

                                    </div>

                                </form>
                            </div>
                            <!-- End Laporan -->

                            <!-- Pelapor -->
                            <div id="pelapor" class="col s12">
                                <form class="row mt-2 mb-2">
                                    <p><a>Informasi Pelapor</a></p>
                                    <div class="col s12">
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="identitas_pelapor_rahasia">Identitas Pelapor Dirahasiakan</label>
                                            </div>
                                            <select name="identitas_pelapor_rahasia">
                                                <option value="" disabled selected>---Pilih Identitas Pelapor---</option>
                                                <option value="1">Ya</option>
                                                <option value="0">Tidak</option>
                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <input value="" id="nama_pelapor" name="nama_pelapor" type="text" class="validate">
                                            <label for="nama_pelapor">Nama Lengkap</label>
                                        </div>


                                        <div class="input-field col s12">
                                            <div>
                                                <label for="warga_negara">Warga Negara</label>
                                            </div>
                                            <select name="warga_negara">
                                                <option value="" disabled selected>---Pilih Warga Negara---</option>
                                                <option value="warga_negara_1">WNI</option>
                                                <option value="warga_negara_2">WNA</option>
                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="jenis_identitas">Jenis Identitas</label>
                                            </div>
                                            <select name="jenis_identitas">
                                                <option value="" disabled selected>---Pilih Jenis Identitas---</option>

                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <input value="" id="nomor_identitas" name="nomor_identitas" type="text" class="validate">
                                            <label for="nomor_identitas">Nomor Identitas</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input value="" id="tempat_lahir" name="tempat_lahir" type="text" class="validate">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                            </div>
                                            <input value="" id="tanggal_lahir" name="tanggal_lahir" type="date" class="validate">
                                        </div>
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                            </div>
                                            <select name="jenis_kelamin">
                                                <option value="" disabled selected>---Pilih Jenis Kelamin---</option>
                                                <option value="jenis_kelamin_1">Laki-laki</option>
                                                <option value="jenis_kelamin_2">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="pendidikan_pelapor">Pendidikan Terakhir</label>
                                            </div>
                                            <select name="pendidikan_pelapor">
                                                <option value="" disabled selected>---Pilih Pendidikan Terakhir---</option>
                                                <option value="pendidikan_1">SD</option>
                                                <option value="pendidikan_2">SMP</option>
                                                <option value="pendidikan_4">D3</option>
                                                <option value="pendidikan_5">S1</option>
                                                <option value="pendidikan_6">S2</option>
                                                <option value="pendidikan_7">S3</option>
                                                <option value="pendidikan_8">Tidak Sekolah</option>
                                                <option value="pendidikan_3">SMA/Sederajat</option>
                                                <option value="pendidikan_9">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="status_perkawinan">Status Perkawinan</label>
                                            </div>
                                            <select name="status_perkawinan">
                                                <option value="" disabled selected>---Pilih Status Perkawinan---</option>
                                                <option value="status_kawin_1">Kawain</option>
                                                <option value="status_kawin_2">Belum Kawin</option>
                                                <option value="status_kawin_4">Cerai Mati</option>
                                                <option value="status_kawin_5">Cerai Hidup</option>
                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <input value="" id="pekerjaan" name="pekerjaan" type="text" class="validate">
                                            <label for="pekerjaan">Pekerjaan</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <textarea value="" id="alamat_lengkap" name="alamat_lengkap" type="text" class="validate materialize-textarea"></textarea>
                                            <label for="alamat_lengkap">Alamat Lengkap</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="prov_pelapor">Provinsi</label>
                                            </div>
                                            <select class="select2 browser-default" name="provinsi" id="provinsi">
                                                <option value="" disabled selected>---Pilih Provinsi---</option>

                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="kab_pelapor">Kota/Kabupaten</label>
                                            </div>
                                            <select class="select2 browser-default" name="kabupaten" id="kabupaten">
                                                <option value="" disabled selected>---Pilih Kota/Kabupaten---</option>

                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="kec_pelapor">Kecamatan</label>
                                            </div>
                                            <select class="select2 browser-default" name="kecamatan" id="kecamatan">
                                                <option value="" disabled selected>---Pilih Kecamatan---</option>

                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <input value="" id="no_telp" name="no_telp" type="text" class="validate">
                                            <label for="no_telp">Nomor Telepon</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input value="" id="email" name="email" type="email" class="validate">
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End Pelapor  -->

                            <!-- Terlapor -->
                            <div id="terlapor" class="col s12">
                                <form class="row mt-2 mb-2">
                                    <p><a>Informasi Terlapor</a></p>
                                    <div class="col s12">
                                        <div class="input-field col s12">
                                            <input value="" id="nama_terlapor" name="nama_terlapor" type="text" class="validate">
                                            <label for="nama_terlapor">Nama Terlapor</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input value="" id="jabatan_terlapor" name="jabatan_terlapor" type="text" class="validate">
                                            <label for="jabatan_terlapor">Jabatan Terlapor</label>
                                        </div>

                                        <div class="input-field col s12">
                                            <div>
                                                <label for="kelompok_klasifikasi_instansi">Kelompok Instansi Terlapor</label>
                                            </div>
                                            <select class="select2 browser-default" name="kelompok_klasifikasi_instansi">
                                                <option value="" disabled selected>---Pilih Kelompok Instansi Terlapor---</option>

                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="klasifikasi_instansi_terlapor">Klasifikasi Instansi Terlapor</label>
                                            </div>
                                            <select class="select2 browser-default" name="klasifikasi_instansi_terlapor">
                                                <option value="" disabled selected>---Pilih Klasifikasi Instansi Terlapor---</option>

                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <input value="" id="instansi_terlapor" name="instansi_terlapor" type="text" class="validate">
                                            <label for="instansi_terlapor">Instansi Terlapor</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <textarea value="" id="alamat_terlapor" name="alamat_terlapor" type="text" class="validate materialize-textarea"></textarea>
                                            <label for="alamat_terlapor">Alamat Terlapor</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="provinsi">Provinsi</label>
                                            </div>
                                            <select class="select2 browser-default" name="provinsi">
                                                <option value="" disabled selected>---Pilih Provinsi---</option>

                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="kab_kota_terlapor">Kota/Kabupaten</label>
                                            </div>
                                            <select class="select2 browser-default" name="kab_kota_terlapor">
                                                <option value="" disabled selected>---Pilih Kota/Kabupaten---</option>

                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <div>
                                                <label for="kec_pelapor">Kecamatan</label>
                                            </div>
                                            <select class="select2 browser-default" name="kec_pelapor">
                                                <option value="" disabled selected>---Pilih Kecamatan---</option>

                                            </select>
                                        </div>
                                </form>
                            </div>
                            <!-- End Terlapor -->
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="input-field col s12 pr-7">
                                    <a href="?page=registrasi-laporan-creates" class="btn cyan waves-effect waves-light right">
                                        <i class="material-icons right">send</i>
                                        <span class="hide-on-small-only">Submit</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php include 'partials/scripts.php'; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: "get_provinsi.php",
            cache: false,
            success: function(msg) {
                $("#provinsi").html(msg);
            }
        });

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
    });
</script>