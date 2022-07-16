<?php
include '../../database/database.php';
$database = new Database();
$db = $database->getConnection();
$id = $_GET['id'];
$selectSql = "SELECT * FROM registrasi_lap_masyarakat r JOIN pelapor p ON p.id_pel=r.id_reg WHERE id_reg=$id";
$stmt = $db->prepare($selectSql);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
$tgl = "Banjarmasin,  " . date("d F Y");
$tgl_agenda = date_create($row['tgl_agenda']);
?>

<html>

<head>
    <title>Cetak Keterangan Penutupan Laporan</title>
    <link rel="shortcut icon" href="img/Ombudsmanlgsml.png">
    <style type="text/css">
        @page {
            margin: 0;
        }

        body {
            margin: 1cm;
            margin-left: 2cm;
            margin-right: 2cm;
            font-family: "Arial", Times, serif;
        }

        table {
            border-style: double;
            border-width: 3px;
            border-color: white;
        }

        table tr .text2 {
            text-align: right;
            font-size: 13px;
        }

        table tr .text {
            text-align: center;
            font-size: 13px;
        }

        table tr .text3 {
            text-align: justify;
            font-size: 13px;
        }

        table tr td {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <center>
        <table>
            <tr>
                <td><img src="../../app-assets/images/cetak/Ombudsmanlgsml.png" width="150"></td>
                <td>
                    <center>
                        <font size="4"><b>OMBUDSMAN REPUBLIK INDONESIA</b></font><br>
                        <font size="4"><b>PERWAKILAN PROVINSI KALIMANTAN SELATAN</b></font><br>
                        <font size="3">Jl. Letjen. S. Parman No. 57, Kota Banjarmasin 70116</font><br>
                        <font size="3">Telp. (0511) 3367 412, Faks. (0511) 3367 411</font><br>
                        <font size="3">Email : kalsel@ombudsman.go.id, Website : www.ombudsman.go.id</font><br>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <table width="625">
                <tr>
                    <td class="text2"><?php echo $tgl ?></td>
                </tr>
            </table>
        </table>
        <table>
            <tr class="text2">
                <td>Nomer</td>
                <td width="572">: <?php echo $row['no_arsip']; ?></td>
            </tr>
            <tr>
                <td>Sifat</td>
                <td width="564">: Penting</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td width="564">: LAHP</td>
            </tr>
            <tr>
                <td>Hal</td>
                <td width="564">: Penutupan Laporan</td>
            </tr>
        </table>
        <br>
        <table width="625">
            <tr>
                <td>
                    <font size="2">Yth.<br><b><?php echo $row['nama_pelapor']; ?></b><br>di-Tempat</font>
                </td>
            </tr>
        </table>
        <br>
        <table width="625">
            <tr>
                <td class="text3">
                    <font size="2">Bersama ini diberitahukan bahwa Ombudsman Republik Indonesia telah melakukan serangkaian
                        pemeriksaan terhadap laporan Saudara/Saudari dengan Registrasi Nomor <?php echo $row['no_arsip']; ?> tanggal <?php echo date_format($tgl_agenda, "d/m/Y"); ?>,
                        perihal <?php echo $row['perihal']; ?>.
                    </font>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td class="text3">
                    <font size="2">Berkenaan dengan laporan tersebut dan atas dasar persetujuan dalam Rapat Perwakilan Ombudsman RI,
                        Perwakilan Ombudsman RI Provinsi Kalimantan Selatan telah menerbitkan Laporan Akhir Hasil Pemeriksaan
                        (terlampir), yang pada intinya Ombudsman berpendapat bahwa Pelapor telah memperoleh penyelesaian dari Instansi yang dilaporkan.
                    </font>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td class="text3">
                    <font size="2">Demikian kami sampaikan, atas perhatian dan peran aktif Saudara menyampaikan
                        laporan kepada Ombudsman, kami ucapkan terima kasih.
                    </font>
                </td>
            </tr>
        </table>
        <br>
        </table>
        <br>
        <br>
        <table width="625">
            <tr>
                <td width="430"><br><br><br><br></td>
                <td class="text" align="center">Kepala Perwakilan
                    Ombudsman Republik Indonesia
                    Provinsi Kalimantan Selatan
                    <br><br><br><br><br>Hadi Rahman, S.IP, M.PA (Mgmt)
                </td>
            </tr>
        </table>
        <br>
    </center>
    <script>
        window.print();
    </script>
</body>

</html>