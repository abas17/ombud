<?php
include '../../database/database.php';
include '../../fungsi.php';
$database = new Database();
$db = $database->getConnection();

$tgl = "Banjarmasin,  " . date("d F Y");

?>
<html>
<style>
    @page {
        margin: 0;
    }

    table {
        font-size: 14px;

    }

    table,
    th,
    td {
        border-collapse: collapse;
    }

    thead {
        font-size: 16px;
    }

    .judul h3,
    h2,
    p {
        text-align: center;
        margin: 5px 0 5px 0;
    }

    .form-inline img {

        display: inline-block;
    }

    h2 {
        font-size: 30px;
    }

    .kop tr td {
        text-align: center;
        border: 2px solid white;
        border-collapse: collapse;
    }

    .gambar {
        margin-right: 10px;
    }

    .isi tr td {
        padding-left: 5px;
        padding-right: 5px;
    }

    .ttd {
        text-align: center;
        display: inline-block;
        float: right;
    }
</style>

<title>Cetak Terlapor</title>
<div class='container-fluid'>
    <center>
        <table class='kop' style='width:100%;'>
            <tr>
                <td rowspan='5' align='center'><img src='../../app-assets/images/cetak/Ombudsmanlgsml.png' height='100px'>
                </td>
                <td style='font-size: 20px; font-weight: bold;' align='center'>&nbsp;</td>
            </tr>
            <tr>
                <td style='font-size: 20px; font-weight: bold;'>OMBUDSMAN REPUBLIK INDONESIA PERWAKILAN PROVINSI KALIMANTAN SELATAN</td>
                <td style='font-size: 25px; font-weight: bold;'></td>
            </tr>
            <tr>
                <td style='font-size: 15px;'>Telp. (0511) 3367 412, Faks. (0511) 3367 411</td>
            </tr>
            <tr>
                <td style='font-size: 15px;'>Email : kalsel@ombudsman.go.id, Website : www.ombudsman.go.id</td>
            </tr>
        </table>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
    </center>

    <table width='100%' align='right'>
        <tr>
            <td class="text2"></td>
        </tr>
        <tr>
            <th width='80%'>&nbsp;</th>
            <th align='center'>Banjarmasin, <?php echo tgl_indo(date('Y-m-d')); ?></th>
        </tr>
    </table>

    <div>
        <center>
            <h4>Terlapor<br></h4>
        </center>
        <div>

            <body>
                <center>
                    <table id='page-length-option' border='1' style='width:90%;' class='display'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Arsip</th>
                                <th>Nama Terlapor</th>
                                <th>Kelompok Instansi Terlapor</th>
                                <th>Instansi Terlapor</th>
                                <th>Alamat Terlapor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $database = new Database();
                            $db = $database->getConnection();
                            $selectSql = "SELECT r.id_reg, r.no_arsip,t.nama_terlapor,t.kelompok_klasifikasi_instansi,t.instansi_terlapor,t.alamat_terlapor, kki.pilih_kel 
FROM registrasi_lap_masyarakat r JOIN terlapor t ON r.id_reg=t.id_ter
JOIN kelompok_klasifikasi_instansi kki ON t.kelompok_klasifikasi_instansi = kki.id_kel ORDER BY id_reg desc";
                            $stmt = $db->prepare($selectSql);
                            $stmt->execute();
                            $no = 1;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['no_arsip'] ?></td>
                                    <td><?php echo $row['nama_terlapor'] ?></td>
                                    <td><?php echo $row['pilih_kel'] ?></td>
                                    <td><?php echo $row['instansi_terlapor'] ?></td>
                                    <td><?php echo $row['alamat_terlapor'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </center>


                <script>
                    window.print();
                </script>
            </body>

            <table width='100%' align='right'>

                <tr>
                    <th width='60%'>&nbsp;</th>
                    <th align='center'>&nbsp;</th>
                </tr>
                <tr>
                    <th width='60%'>&nbsp;</th>
                    <th align='center'>&nbsp;</th>
                </tr>
                <tr>
                    <th width='60%'>&nbsp;</th>
                    <th align='center'>&nbsp;</th>
                </tr>
                <tr>
                    <th width='60%'>&nbsp;</th>
                    <th align='center'>Banjarmasin, <?php echo tgl_indo(date('Y-m-d')); ?></th>
                </tr>
                <tr>
                    <th width='60%'>&nbsp;</th>
                    <th align='center'>Mengetahui,</th>
                </tr>
                <tr>
                    <th width='60%'>&nbsp;</th>
                    <th align='center'>Kepala Perwakilan Ombudsman Republik Indonesia Provinsi Kalimantan Selatan</th>
                </tr>
                <tr>
                    <th width='60%'>&nbsp;</th>
                    <th align='center'>&nbsp;</th>
                </tr>
                <tr>
                    <th width='60%'>&nbsp;</th>
                    <th align='center'>&nbsp;</th>
                </tr>
                <tr>
                    <th width='60%'>&nbsp;</th>
                    <th align='center'>&nbsp;</th>
                </tr>
                <tr>
                    <th width='60%'>&nbsp;</th>
                    <th align='center'>&nbsp;</th>
                </tr>
                <tr>
                    <th width='60%'>&nbsp;</th>
                    <th align='center'><b>Hadi Rahman, S.IP, M.PA (Mgmt)</b></th>
                </tr>
            </table>
        </div>
    </div>

</html>